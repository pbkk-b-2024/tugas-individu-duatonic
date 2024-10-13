<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'char';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_name',
    ];

    public $timestamps = false;

    public function items() {
        return $this->hasMany(Item::class, 'category_id', 'category_id');
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
