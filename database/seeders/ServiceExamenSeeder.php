<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class ServiceExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
        public function run(): void
        {
            DB::table('service_examens')->insert([
                'nomSA' => Str::random(10),
                'emailSA' => Str::random(10) . '@gmail.com',
                
            ]);
        }
    
}
