<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descargas extends Model
{
    use HasFactory;

    protected $fillable = [
        'archivos_id',
        'user_id'
    ];

    public function archivo()
    {
        return $this->belongsTo(Archivos::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
