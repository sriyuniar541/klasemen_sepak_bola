<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Klub extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama_klub',
        'kota_klub',
    ];

    protected $table = 'klub';

    public function skor()
    {
        return $this->hasMany(Skor::class);
    }

    public function klasement()
    {
        return $this->hasMany(Klasement::class);
    }

      
}
