<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'order_id');
    }

    public function getIsReviewedAttribute()
    {
        return $this->review()->exists();
    }





    /**
     * Accessor for formatting the phone number.
     *
     * @return string
     */
    public function getFormattedNoHpAttribute()
    {
        $noHp = $this->attributes['no_hp'];
        $cleaned = preg_replace('/[^0-9]/', '', $noHp);

        // Format with spaces, e.g., 0812 3456 7890
        $formatted = trim(chunk_split($cleaned, 4, ' '));

        return $formatted;
    }
}
