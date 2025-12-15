<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        PaymentMethod::create([
            'name' => 'QRIS (All E-Wallet)',
            'code' => 'qris',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/Commons_QR_code.png/64px-Commons_QR_code.png',
            'category' => 'e-wallet',
            'admin_fee' => 750,
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Bank BCA',
            'code' => 'bca_va',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/1200px-Bank_Central_Asia.svg.png',
            'category' => 'bank',
            'admin_fee' => 2500,
            'is_active' => true,
        ]);
        
        PaymentMethod::create([
            'name' => 'Dana',
            'code' => 'dana',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg',
            'category' => 'e-wallet',
            'admin_fee' => 1000,
            'is_active' => true,
        ]);
    }
}