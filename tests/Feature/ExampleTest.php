<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_populates_admin_categories_products_and_testimonials(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('users', ['email' => 'admin@sedaprasa.test']);
        $this->assertSame(3, Category::count());
        $this->assertSame(8, Product::count());
        $this->assertSame(5, Testimonial::count());
    }

    public function test_eloquent_relationships_and_cascade_deletes_work(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $testimonial = Testimonial::factory()->create(['product_id' => $product->id, 'rating' => 5]);

        $this->assertTrue($category->products->contains($product));
        $this->assertTrue($product->category->is($category));
        $this->assertTrue($product->testimonials->contains($testimonial));
        $this->assertTrue($testimonial->product->is($product));

        $category->delete();

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
    }

    public function test_single_page_public_home_renders_all_sections_bootstrap_and_logos(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('bootstrap@5.3.3/dist/css/bootstrap.min.css', false)
            ->assertSee('id="hero"', false)
            ->assertSee('id="tentang"', false)
            ->assertSee('id="kategori"', false)
            ->assertSee('id="produk"', false)
            ->assertSee('id="testimoni"', false)
            ->assertSee('id="kontak"', false)
            ->assertSee('Sambal Roa Manado Asli')
            ->assertSee('productModal-');

        $this->assertGreaterThanOrEqual(3, substr_count($response->getContent(), 'images/logo.svg'));
    }

    public function test_public_testimonial_submission_validates_and_stores_data(): void
    {
        $this->seed(DatabaseSeeder::class);
        $product = Product::firstOrFail();

        $this->post(route('testimonials.store'), [
            'product_id' => $product->id,
            'name' => 'Andi Pratama',
            'rating' => 5,
            'message' => 'Sambalnya mantap sekali, pedasnya pas!',
        ])->assertRedirect(route('home').'#testimoni');

        $this->assertDatabaseHas('testimonials', [
            'product_id' => $product->id,
            'name' => 'Andi Pratama',
            'rating' => 5,
        ]);

        $this->post(route('testimonials.store'), [
            'product_id' => $product->id,
            'name' => str_repeat('A', 51),
            'rating' => 6,
            'message' => str_repeat('B', 301),
        ])->assertRedirect(route('home').'#testimoni')
            ->assertSessionHasErrors(['name', 'rating', 'message']);
    }

    public function test_admin_login_logout_dashboard_and_validations(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));

        $this->get(route('login'))
            ->assertOk()
            ->assertSee('images/logo.svg');

        $this->post(route('login.attempt'), [
            'email' => 'admin@sedaprasa.test',
            'password' => 'admin12345',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();

        $admin = User::where('email', 'admin@sedaprasa.test')->firstOrFail();
        $this->actingAs($admin);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Jumlah Kategori')
            ->assertSee('Jumlah Produk')
            ->assertSee('Jumlah Testimoni');

        // Category validation: name required|max:50|unique
        $this->post(route('admin.categories.store'), [
            'name' => 'Sambal Khas Nusantara',
        ])->assertSessionHasErrors('name');

        $this->post(route('admin.categories.store'), [
            'name' => str_repeat('K', 51),
        ])->assertSessionHasErrors('name');

        $this->post(route('admin.categories.store'), [
            'name' => 'Bumbu Dapur',
        ])->assertRedirect(route('admin.categories.index'));

        $category = Category::where('slug', 'bumbu-dapur')->firstOrFail();

        // Product validation: name max:100, category_id exists, price numeric|min:0, description max:1000
        $this->post(route('admin.products.store'), [
            'category_id' => 99999,
            'name' => str_repeat('P', 101),
            'price' => -100,
            'description' => str_repeat('D', 1001),
        ])->assertSessionHasErrors(['category_id', 'name', 'price', 'description']);

        // Product CRUD + Testimonial CRUD
        $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Bumbu Rendang Padang',
            'description' => 'Bumbu rendang rempah lengkap siap masak.',
            'price' => 30000,
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::where('slug', 'bumbu-rendang-padang')->firstOrFail();

        $this->post(route('admin.testimonials.store'), [
            'product_id' => $product->id,
            'name' => 'Lestari',
            'rating' => 4,
            'message' => 'Sangat praktis untuk memasak di rumah.',
        ])->assertRedirect(route('admin.testimonials.index'));

        $this->assertDatabaseHas('testimonials', [
            'product_id' => $product->id,
            'name' => 'Lestari',
        ]);

        // Logout
        $this->post(route('logout'))->assertRedirect(route('home'));
        $this->assertGuest();
    }

    public function test_admin_product_image_upload_replaces_and_deletes_old_files(): void
    {
        Storage::fake('public');
        $this->seed(DatabaseSeeder::class);

        $admin = User::where('email', 'admin@sedaprasa.test')->firstOrFail();
        $category = Category::firstOrFail();
        $this->actingAs($admin);

        $pngBytes = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
        $firstImage = UploadedFile::fake()->createWithContent('first.png', $pngBytes);
        $secondImage = UploadedFile::fake()->createWithContent('second.png', $pngBytes);

        // Invalid extension rejected
        $badFile = UploadedFile::fake()->create('malware.txt', 10, 'text/plain');
        $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Produk Tes Upload',
            'description' => 'Deskripsi produk tes.',
            'price' => 25000,
            'image' => $badFile,
        ])->assertSessionHasErrors('image');

        // Store with valid image
        $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Sambal Matah Kemasan Baru',
            'description' => 'Sambal matah segar.',
            'price' => 35000,
            'image' => $firstImage,
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::where('slug', 'sambal-matah-kemasan-baru')->firstOrFail();
        $oldPath = $product->image;
        $this->assertNotNull($oldPath);
        $this->assertStringStartsWith('products/', $oldPath);
        Storage::disk('public')->assertExists($oldPath);

        // Update replaces old image
        $this->put(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Sambal Matah Kemasan Baru',
            'slug' => 'sambal-matah-kemasan-baru',
            'description' => 'Sambal matah segar diperbarui.',
            'price' => 37000,
            'image' => $secondImage,
        ])->assertRedirect(route('admin.products.index'));

        $product->refresh();
        $newPath = $product->image;
        $this->assertNotSame($oldPath, $newPath);
        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($newPath);

        // Delete removes image
        $this->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));

        Storage::disk('public')->assertMissing($newPath);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_chili_svg_logo_exists(): void
    {
        $logoPath = public_path('images/logo.svg');
        $this->assertFileExists($logoPath);
        $this->assertStringContainsString('<svg', file_get_contents($logoPath));
    }
}
