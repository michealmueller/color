<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(FollowsTableSeeder::class);
        $this->call(TimelineTableSeeder::class);
    }
}