<?php

use App\Channel;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = Channel::all();
        $faker = Faker::create();

        foreach($channels as $channel)
        {
            for($i = 1; $i <= 5; $i++)
            {
                $channel->videos()->create([
                    'title'         => $faker->sentence,
                    'youtube_embed' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/QQS5oEOguRU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    'description'   => $faker->paragraph    
                ]);   
            }
        }
    }
}
