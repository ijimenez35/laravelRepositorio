<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    use HasFactory;

    public function repositorio()
    {
        return $this->belongsTo(Repositorios::class);
    }

    protected $fillable = [
        'name',
        'repositorio_id',
        'user_id'
    ];
    
}
