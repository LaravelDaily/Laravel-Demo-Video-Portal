<?php

use App\Channel;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 1; $i <= 10; $i++)
        {
            Channel::create([
                'name' => $faker->company
            ]);
        }
    }
}
