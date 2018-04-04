<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{

    protected $table = 'domain_name';

    protected $fillable = ["name"];

    public function dns()
    {
        return $this->hasMany('App\DomainDNS');
    }
}
