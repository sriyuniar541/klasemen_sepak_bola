<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Klub;

class Skor extends Model
{
    use HasFactory;

    protected $fillable = [
        'klub_id',
        'skor',
        'klub_id_lawan',
        'skor_lawan',

    ];

    protected $table = 'skor';

    // public function klub()
    // {
    //     return $this->belongsTo(Klub::class);
    // }
     
    public function klub()
    {
        return $this->belongsTo(Klub::class, 'klub_id');
    }

    public function klub_lawan()
    {
        return $this->belongsTo(Klub::class, 'klub_id_lawan');
    }


}
