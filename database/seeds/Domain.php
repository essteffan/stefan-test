<?php

use Illuminate\Database\Seeder;

class Domains extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domain_name')->delete();
        DB::table('domain_name')->insert([
            [
                'id'          => 1,
                'name'        => "Test Domain 1",
                'created_at'  => \Carbon\Carbon::now(),
            ],
            [
                'id'          => 2,
                'name'        => "Test Domain 2",
                'created_at'  => \Carbon\Carbon::now(),
            ],
            [
                'id'          => 3,
                'name'        => "Test Domain 3",
                'created_at'  => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
