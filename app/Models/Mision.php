<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mision extends Model
{
    use HasFactory;

    public function piloto(){

    	return $this->belongsTo(Piloto::class);

    }

    public function nave(){

    	return $this->belongsTo(Nave::class);

    }
}
