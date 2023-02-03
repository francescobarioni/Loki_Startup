<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rating extends Model
{
    use HasFactory;

    /**
     * Table name
     * @var string
     */
    protected $table = 'rating';

    /**
     * @var string[]
     */
    protected $fillable = [
        'value',
        'description',
        'user_id',
        'marketplace_id'
    ];

    /**
     * One-to-One relationship
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One-to-One relationship
     * @return BelongsTo
     */
    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class);
    }
}
