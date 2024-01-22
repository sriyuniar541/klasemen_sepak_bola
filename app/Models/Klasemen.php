<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasemen extends Model
{
    use HasFactory;

    protected $fillable = [
        'klub_id',
        'MA',
        'ME',
        'S',
        'K',
        'GM',
        'GK',
        'poin'

    ];

    protected $table = 'klasemen';

    public function klub()
    {
        return $this->belongsTo(Klub::class);
    }
}
