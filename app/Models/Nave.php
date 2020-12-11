<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nave extends Model
{
    use HasFactory;

    public function pilotos(){
    	return $this->hasMany(Piloto::class);
    }
}
