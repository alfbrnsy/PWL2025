<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;// implementasi class Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable; 
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Authenticatable implements JWTSubject
{
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    // Tambahkan ini:
    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {   
        return [];
    }


    // use HasFactory;
    
//     protected $fillable = ['username', 'password', 'nama', 'level_id', 'created_at', 'updated_at', 'foto_profil'];
    

//     protected $hidden = ['password']; // jangan di tampilkan saat select

//     protected $casts = ['password' => 'hashed']; // casting password agar otomatis di hash

//     /**
//      * Relasi ke tabel level
//      */
//     public function level(): BelongsTo
//     {
//         return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
//     }

//     /**
//      * Mendapatkan nama role
//      */
//     public function getRoleName(): string
//     {
//         return $this->level->level_nama;
//     }

//     /**
//      * Cek apakah user memiliki role tertentu
//      */
//     public function hasRole($role) : bool
//     {
//         return $this->level->level_kode == $role;
//     }

//     /**
//       * Mendapatkan kode role
//       */
//       public function getRole()
//       {
//           return $this->level->level_kode;
//       }

}