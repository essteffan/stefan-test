<?php

use Illuminate\Database\Seeder;

class DomainDNS extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domain_dns')->delete();
        DB::table('domain_dns')->insert([
            [
                'id'          => 1,
                'name'        => "Domain 1",
                'domain_id'   => 1,
                'type'        => "AAAA",
                'value'       => "192.168.10.100",
                'created_at'  => \Carbon\Carbon::now(),
            ],
            [
                'id'          => 2,
                'name'        => "Domain 2",
                'domain_id'   => 1,
                'type'        => "SRV",
                'value'       => "192.168.10.101",
                'created_at'  => \Carbon\Carbon::now(),
            ],
            [
                'id'          => 3,
                'name'        => "Domain 3",
                'domain_id'   => 1,
                'type'        => "AAAA",
                'value'       => "192.168.10.103",
                'created_at'  => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
