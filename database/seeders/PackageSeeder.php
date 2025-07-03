<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;


class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Package::insert([
        [
            'name' => 'Gratis',
            'slug' => 'gratis',
            'price' => 0,
            'features' => '• Undangan dasar<br>• 1 tema gratis<br>• Terbatas fitur',
        ],
        [
            'name' => 'Premium',
            'slug' => 'premium',
            'price' => 150000,
            'features' => '• Semua tema premium<br>• Undangan full fitur<br>• Statistik dan musik',
        ],
    ]);
    }
}
