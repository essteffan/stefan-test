<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DomaninDNS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_dns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_id')->unsigned();
            $table->string('name');
            $table->enum('type', ['A','AAAA', 'CNAME', 'SRV', 'TXT'])->default("AAAA");
            $table->string('value');
            $table->timestamps();

            $table->foreign('domain_id')->references('id')->on('domain_name')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('domain_dns');
    }
}
