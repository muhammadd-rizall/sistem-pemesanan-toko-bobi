<?php

namespace Database\Seeders;

use App\Models\Diskon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diskonList = [
            [
                'kode_diskon' => 'DISKON10',
                'nilai_diskon' => 10, // 10%
                'tanggal_mulai' => '2025-01-01',
                'tanggal_berakhir' => '2025-12-31',
                'status' => 'active',
            ],
            [
                'kode_diskon' => 'HEMAT50',
                'nilai_diskon' => 50000, // potongan nominal 50.000
                'tanggal_mulai' => '2025-02-01',
                'tanggal_berakhir' => '2025-05-30',
                'status' => 'active',
            ],
            [
                'kode_diskon' => 'PROMO20',
                'nilai_diskon' => 20, // 20%
                'tanggal_mulai' => '2025-01-15',
                'tanggal_berakhir' => '2025-04-15',
                'status' => 'inactive',
            ],
            [
                'kode_diskon' => 'SALE100',
                'nilai_diskon' => 100000, // potongan 100rb
                'tanggal_mulai' => '2025-03-01',
                'tanggal_berakhir' => '2025-08-01',
                'status' => 'active',
            ],
            [
                'kode_diskon' => 'DISKON5',
                'nilai_diskon' => 5, // 5%
                'tanggal_mulai' => '2025-02-10',
                'tanggal_berakhir' => '2025-03-10',
                'status' => 'inactive',
            ],
        ];

        foreach ($diskonList as $d) {
            Diskon::create([
                'kode_diskon' => $d['kode_diskon'],
                'nilai_diskon' => $d['nilai_diskon'],
                'tanggal_mulai' => $d['tanggal_mulai'],
                'tanggal_berakhir' => $d['tanggal_berakhir'],
                'status' => $d['status'],
            ]);
        }
    }
}
