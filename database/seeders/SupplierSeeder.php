<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'nama_perusahaan' => 'PT Nusantara Elektronik',
                'kontak_person' => 'Rizal Saputra',
                'phone' => '081234567890',
                'email' => 'supplier1@example.com',
                'provinsi' => 'Jawa Barat',
                'kota' => 'Bandung',
                'kecamatan' => 'Coblong',
                'alamat' => 'Jl. Dago No. 102, Bandung',
                'status' => 'active',
            ],
            [
                'nama_perusahaan' => 'CV Sumber Teknik',
                'kontak_person' => 'Andi Kurnia',
                'phone' => '081298765432',
                'email' => 'supplier2@example.com',
                'provinsi' => 'DKI Jakarta',
                'kota' => 'Jakarta Selatan',
                'kecamatan' => 'Kebayoran Baru',
                'alamat' => 'Jl. Sudirman No. 45, Jakarta Selatan',
                'status' => 'active',
            ],
            [
                'nama_perusahaan' => 'PT Mega Distribusi',
                'kontak_person' => 'Siti Rahma',
                'phone' => '082112223334',
                'email' => 'supplier3@example.com',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Surabaya',
                'kecamatan' => 'Wonokromo',
                'alamat' => 'Jl. Darmo Indah 33, Surabaya',
                'status' => 'inactive',
            ],
            [
                'nama_perusahaan' => 'UD Anugerah Makmur',
                'kontak_person' => 'Budi Santoso',
                'phone' => '087766554433',
                'email' => 'supplier4@example.com',
                'provinsi' => 'Sumatera Utara',
                'kota' => 'Medan',
                'kecamatan' => 'Medan Baru',
                'alamat' => 'Jl. Gajah Mada No. 12, Medan',
                'status' => 'active',
            ],
            [
                'nama_perusahaan' => 'PT Global Tech Supply',
                'kontak_person' => 'Dewi Lestari',
                'phone' => '089998887776',
                'email' => 'supplier5@example.com',
                'provinsi' => 'Bali',
                'kota' => 'Denpasar',
                'kecamatan' => 'Kuta Selatan',
                'alamat' => 'Jl. Sunset Road No. 88, Bali',
                'status' => 'active',
            ],
        ];

        foreach ($suppliers as $data) {
            Supplier::create($data);
        }
    }
}
