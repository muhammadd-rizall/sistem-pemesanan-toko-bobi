<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    public function definition(): array
    {
        $supplierIds = Supplier::pluck('id')->all();
        $categoryIds = Category::pluck('id')->all();

        // Pastikan folder upload ada
        $path = storage_path('app/public/uploads/produk');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // Generate nama file unik
        $filename = uniqid() . '_' . time() . '.jpg';
        $fullPath = $path . '/' . $filename;

        // Coba buat gambar via faker, fallback ke dummy image
        $generatedImage = $this->faker->image($path, 400, 400, 'technics', false);

        if ($generatedImage && file_exists($path . '/' . $generatedImage)) {
            rename($path . '/' . $generatedImage, $fullPath);
        } else {
            $this->createDummyImage($fullPath);
        }

        $hargaBeli = $this->faker->randomFloat(2, 10000, 500000);
        $margin = $this->faker->numberBetween(30, 100);
        $hargaJual = $hargaBeli + ($hargaBeli * $margin / 100);

        return [
            'supplier_id' => $this->faker->randomElement($supplierIds),
            'category_id' => $this->faker->randomElement($categoryIds),
            'nama_produk' => $this->faker->words(2, true),
            'merek' => $this->faker->company(),
            'deskripsi' => $this->faker->sentence(10),
            'harga_beli' => (float) round($hargaBeli, 2),
            'harga_jual' => (float) round($hargaJual, 2),
            'stok' => $this->faker->numberBetween(0, 100),
            'status' => 'tersedia',
            'gambar_produk' => 'uploads/produk/' . $filename,
        ];
    }

    /**
     * Buat gambar dummy menggunakan GD Library
     */
    private function createDummyImage(string $path): void
    {
        $width = 400;
        $height = 400;
        $image = imagecreatetruecolor($width, $height);

        $bgColor = imagecolorallocate(
            $image,
            rand(100, 255),
            rand(100, 255),
            rand(100, 255)
        );
        imagefill($image, 0, 0, $bgColor);

        $textColor = imagecolorallocate($image, 255, 255, 255);
        $text = "PRODUCT";
        $font = 5;
        $textWidth = imagefontwidth($font) * strlen($text);
        $textHeight = imagefontheight($font);
        imagestring(
            $image,
            $font,
            ($width - $textWidth) / 2,
            ($height - $textHeight) / 2,
            $text,
            $textColor
        );

        imagejpeg($image, $path, 90);
        imagedestroy($image);
    }
}
