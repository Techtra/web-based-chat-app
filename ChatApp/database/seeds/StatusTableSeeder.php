<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();
       
       Status::create(['status_body' => 'Available']);
       Status::create(['status_body' => 'Out of office']);
       Status::create(['status_body' => 'Off-desk']);
    }
}
