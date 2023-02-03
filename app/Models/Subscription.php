<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    // Subscription types
    const SUBSCRIPTION_TYPE_BRIGHT      = 1;
    const SUBSCRIPTION_TYPE_BRIGHT_PLUS = 2;
    const SUBSCRIPTION_TYPE_VISIONARY   = 3;
    const SUBSCRIPTION_TYPE_MASTERMIND  = 4;

    /**
     * Table name
     * @var string
     */
    protected $table = 'subscription';

    /**
     * @var string[]
     */
    protected $fillable = [
        'package_type',
        'payment_method',
        'user_id'
    ];

    /**
     * Get corresponding monthly price for every subscription type
     * @return array
     */
    public static function getSubscriptionPrice()
    {
        return [
            self::SUBSCRIPTION_TYPE_BRIGHT => 'Free',
            self::SUBSCRIPTION_TYPE_BRIGHT_PLUS => 29.99,
            self::SUBSCRIPTION_TYPE_VISIONARY => 39.99,
            self::SUBSCRIPTION_TYPE_MASTERMIND => 49.99
        ];
    }

    /**
     * Get corresponding name for every subscription type
     * @return array
     */
    public static function getSubscriptionName()
    {
        return [
            self::SUBSCRIPTION_TYPE_BRIGHT => 'Bright',
            self::SUBSCRIPTION_TYPE_BRIGHT_PLUS => 'Bright+',
            self::SUBSCRIPTION_TYPE_VISIONARY => 'Visionary',
            self::SUBSCRIPTION_TYPE_MASTERMIND => 'Mastermind'
        ];
    }

    /**
     * One-to-One relationship
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
