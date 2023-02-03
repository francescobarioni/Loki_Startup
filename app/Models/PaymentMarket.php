<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentMarket extends Model
{
    use HasFactory;

    protected $table = 'payment_market';

    protected $fillable = [
        'payment_method',
        'user_id',
        'item_id'
    ];

    /**
     * Relationship
     * @return BelongsTo
     */
    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class);
    }
}
