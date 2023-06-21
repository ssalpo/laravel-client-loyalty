<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        option([
            'default_percent' => 0.3,
            'send_birthday_gift_time' => '8:00',
            'birthday_template' => 'Уважаемый #name#, в честь вашего дня рождения, дарим подарок на любые ваши покупки.'
        ]);
    }
}
