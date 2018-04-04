<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DomainDNS extends Model
{
    protected $table = 'domain_dns';

    protected $fillable = ["name", "type", "value", "domain_id"];

    public function domain()
    {
        return $this->belongsTo('App\Domain');
    }
}
