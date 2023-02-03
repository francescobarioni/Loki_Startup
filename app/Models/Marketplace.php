<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Marketplace extends Model
{
    use HasFactory;

    protected $table = 'marketplace';

    protected $fillable = [
        'title',
        'description',
        'full_description',
        'price',
        'img_name'
    ];

    /**
     * One-to-Many relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rating()
    {
        return $this->hasMany(Rating::class, 'marketplace_id');
    }

    /**
     * One-to-Many relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paymentMarket()
    {
        return $this->hasMany(PaymentMarket::class, 'item_id');
    }
}
