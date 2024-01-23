<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Faqs;


use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faqs::truncate();
        $Faqs =  [
            [
                'title' => 'Non consectetur a erat nam at lectus urna duis?',
                'description' => 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.',
                'created_at' => Carbon::now('Asia/Kolkata')
            ],
            [
                'title' => 'Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?',
                'description' => 'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.',
                'created_at' => Carbon::now('Asia/Kolkata')
            ], [
                'title' => ' Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?',
                'description' => 'Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis',
                'created_at' => Carbon::now('Asia/Kolkata')
            ],
            [
                'title' => 'Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?',
                'description' => 'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.',
                'created_at' => Carbon::now('Asia/Kolkata')
            ],
            [
                'title' => 'Tempus quam pellentesque nec nam aliquam sem et tortor consequat?',
                'description' => 'Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in',
                'created_at' => Carbon::now('Asia/Kolkata')
            ],
        ];
        Faqs::insert($Faqs);
    }
}
