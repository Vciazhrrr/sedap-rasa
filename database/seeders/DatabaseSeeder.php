<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database using Eloquent ORM only.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sedap Rasa',
            'email' => 'admin@sedaprasa.test',
            'email_verified_at' => now(),
            'password' => Hash::make('admin12345'),
        ]);

        $sambalCategory = Category::create([
            'name' => 'Sambal Khas Nusantara',
            'slug' => 'sambal-khas-nusantara',
        ]);

        $olehOlehCategory = Category::create([
            'name' => 'Oleh-Oleh Kering & Renyah',
            'slug' => 'oleh-oleh-kering-renyah',
        ]);

        $hampersCategory = Category::create([
            'name' => 'Paket Hampers & Bundling',
            'slug' => 'paket-hampers-bundling',
        ]);

        $sambalRoa = Product::create([
            'category_id' => $sambalCategory->id,
            'name' => 'Sambal Roa Manado Asli',
            'slug' => 'sambal-roa-manado-asli',
            'description' => 'Sambal khas Manado dari ikan roa asap pilihan yang ditumbuk halus bersama cabai rawit merah, bawang merah, dan rempah autentik tanpa bahan pengawet.',
            'price' => 38000,
            'image' => null,
        ]);

        $sambalBawang = Product::create([
            'category_id' => $sambalCategory->id,
            'name' => 'Sambal Bawang Jawa Spesial',
            'slug' => 'sambal-bawang-jawa-spesial',
            'description' => 'Perpaduan cabai rawit segar dan bawang putih goreng dengan rasa pedas gurih yang pas untuk teman nasi hangat, ayam goreng, maupun bebek.',
            'price' => 28000,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $sambalCategory->id,
            'name' => 'Sambal Matah Bali Segar',
            'slug' => 'sambal-matah-bali-segar',
            'description' => 'Sambal iris khas Bali dengan serai, daun jeruk purut, bawang merah, cabai rawit, dan minyak kelapa murni yang harum menggugah selera.',
            'price' => 32000,
            'image' => null,
        ]);

        $sambalCumi = Product::create([
            'category_id' => $sambalCategory->id,
            'name' => 'Sambal Cumi Asin Pedas',
            'slug' => 'sambal-cumi-asin-pedas',
            'description' => 'Potongan baby cumi asin empuk dimasak perlahan bersama sambal merah kaya rempah. Tahan lama dan praktis dibawa sebagai buah tangan.',
            'price' => 42000,
            'image' => null,
        ]);

        $keripikTempe = Product::create([
            'category_id' => $olehOlehCategory->id,
            'name' => 'Keripik Tempe Sagu Renyah',
            'slug' => 'keripik-tempe-sagu-renyah',
            'description' => 'Keripik tempe tipis berbalut tepung sagu dan bumbu ketumbar bawang, digoreng kering dengan minyak baru hingga super renyah dan tidak berminyak.',
            'price' => 24000,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $olehOlehCategory->id,
            'name' => 'Bawang Goreng Sumenep Premium',
            'slug' => 'bawang-goreng-sumenep-premium',
            'description' => 'Bawang merah Sumenep asli yang diiris seragam dan digoreng keemasan. Renyah tahan lama dalam toples kedap udara, cocok untuk taburan berbagai hidangan.',
            'price' => 35000,
            'image' => null,
        ]);

        Product::create([
            'category_id' => $olehOlehCategory->id,
            'name' => 'Abon Sapi Manis Pedas',
            'slug' => 'abon-sapi-manis-pedas',
            'description' => 'Serat daging sapi pilihan yang dimasak dengan santan, gula aren, dan cabai merah hingga kering sempurna. Gurih, harum, dan bergizi untuk keluarga.',
            'price' => 48000,
            'image' => null,
        ]);

        $hampersTrio = Product::create([
            'category_id' => $hampersCategory->id,
            'name' => 'Hampers Oleh-Oleh Trio Sambal Nusantara',
            'slug' => 'hampers-oleh-oleh-trio-sambal-nusantara',
            'description' => 'Paket eksklusif berisi 3 varian sambal favorit (Sambal Roa, Sambal Bawang, dan Sambal Cumi Asin) dalam kemasan box besek cantik siap kirim sebagai bingkisan.',
            'price' => 115000,
            'image' => null,
        ]);

        Testimonial::create([
            'product_id' => $sambalRoa->id,
            'name' => 'Rina Kusuma',
            'message' => 'Aroma ikan roa asapnya terasa banget, pedasnya nampol tapi tetap gurih. Sudah repeat order ketiga kalinya untuk stok di rumah!',
            'rating' => 5,
        ]);

        Testimonial::create([
            'product_id' => $sambalBawang->id,
            'name' => 'Budi Santoso',
            'message' => 'Sambal bawang paling pas buat anak kos dan keluarga. Tutup botolnya rapat dan aman dikirim ke luar kota.',
            'rating' => 5,
        ]);

        Testimonial::create([
            'product_id' => $sambalCumi->id,
            'name' => 'Dewi Lestari',
            'message' => 'Baby cuminya melimpah dan tidak alot sama sekali. Dimakan pakai nasi putih hangat saja sudah nikmat luar biasa.',
            'rating' => 4,
        ]);

        Testimonial::create([
            'product_id' => $keripikTempe->id,
            'name' => 'Hendra Wijaya',
            'message' => 'Keripiknya super renyah, bumbunya meresap, dan kemasannya rapi. Jadi oleh-oleh wajib tiap pulang kampung.',
            'rating' => 5,
        ]);

        Testimonial::create([
            'product_id' => $hampersTrio->id,
            'name' => 'Siti Rahmawati',
            'message' => 'Kemasan hampersnya elegan dan sangat cocok untuk bingkisan kerabat maupun rekan kantor. Semua varian sambalnya favorit!',
            'rating' => 5,
        ]);
    }
}
