<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'percent',
            'value' => 10,
            'expiry_date' => now()->addMonths(3),
        ]);

        Coupon::create([
            'code' => 'FLAT5',
            'type' => 'fixed',
            'value' => 5,
            'expiry_date' => now()->addMonths(1),
        ]);
    }
}
