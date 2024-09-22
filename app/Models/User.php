<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'char';

    protected $fillable = [
        'user_name',
        'user_email',
        'user_pwd',
        'role_id',
    ];

    public $timestamps = true;

    protected $hidden = [
        'user_pwd',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->user_pwd;
    }

    public function getAuthIdentifierName()
    {
        return 'user_email';
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function scopeSearch($query, $searchTerm)
    {
        if ($searchTerm) {
            return $query->where(function ($q) use ($searchTerm) {
                $fillable = $this->fillable;

                foreach ($fillable as $field) {
                    $q->orWhere($field, 'LIKE', '%' . $searchTerm . '%');
                }
            });
        }
        return $query;
    }
}