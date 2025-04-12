<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // sesuaikan dengan nama tabel level di database
    protected $primaryKey = 'level_id'; // sesuaikan dengan primary key tabel

    protected $fillable = ['nama_level']; // sesuaikan dengan kolom di tabel m_level
}
