<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $primaryKey = 'item_id';
    public $incrementing = false;
    protected $keyType = 'char';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_name',
        'category_id',
        'item_price',
        'item_quantity'
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_detail')->withPivot('od_quantity', 'od_price');
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
