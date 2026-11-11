<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio1136 extends Model
{
    use HasFactory;

    protected $table = 'portofolio_1136';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'link_project',
    ];
}
