<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'char';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_status',
        'order_total',
        'payment_id',
        'order_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id', 'pay_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_detail')->withPivot('od_quantity', 'od_price');
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
