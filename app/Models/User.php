<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name','email','password','role','kelas_id','avatar_path',
    ];

    protected $hidden = ['password','remember_token'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
