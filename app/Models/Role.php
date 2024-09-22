<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $incrementing = false;
    protected $keyType = 'char';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_name',
        'role_description',
    ];

    public $timestamps = false;

    public function users() {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }

    public function scopeSearch($query, $searchTerm) {
        if ($searchTerm) {
            return $query->where(function ($q) use ($searchTerm) {
                $fillable = $this->fillable; // Use self to reference the current model
                
                foreach ($fillable as $field) {
                    $q->orWhere($field, 'LIKE', '%' . $searchTerm . '%');
                }
            });
        }

        return $query; // Return the original query if no search term is provided
    }
}