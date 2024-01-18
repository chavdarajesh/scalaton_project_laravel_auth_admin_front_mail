<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('contact_settings')->insert([
            'static_id' => 1,
            'email' => 'financialadvisory@ankitconsultancy.com',
            'phone' => '+918888888888',
            'location' => 'A108 Adam Street New York, NY 535022 United States',
            'map_iframe' => '<iframe style="border:0; width: 100%; height: 340px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>',
            'timing' => 'Monday To Friday (10am-5pm)
            Saturday and Sunday (By Appointment)',
            'status' => 1,
            'created_at'=>Carbon::now('Asia/Kolkata')
        ]);
    }
}
