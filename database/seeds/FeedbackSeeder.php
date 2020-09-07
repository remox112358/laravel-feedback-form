<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('feedbacks')->insert([
                'user_id'    => 2,
                'subject'    => 'Тема сообщения #' . $i,
                'message'    => 'Текст сообщения #' . $i,
                'viewed'     => rand(0, 1),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
