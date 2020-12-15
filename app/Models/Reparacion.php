<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    use HasFactory;

    public function nave(){
    	return $this->belongsTo(Nave::class);
    }

    public function mecanico(){
    	return $this->belongsTo(Mecanico::class);
    }
}
