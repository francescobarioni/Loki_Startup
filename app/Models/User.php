<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Roles
    const ROLE_BASIC_USER = 0;
    const ROLE_ADMIN = 1;
    const ROLE_PLOT_USER = 2;
    const ROLE_PLOT_ADMIN = 3;

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'birthdate',
        'email',
        'password',
        'profile_photo_path',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get corresponding role name
     * @return string[]
     */
    public static function getRoleName()
    {
        return [
            self::ROLE_BASIC_USER => 'Basic User',
            self::ROLE_ADMIN => 'Administrator',
            self::ROLE_PLOT_USER => 'Plot User',
            self::ROLE_PLOT_ADMIN => 'Plot Admin'
        ];
    }

    /**
     * Get User fullname
     * @return string
     */
    public function getFullname()
    {
        return $this->name.' '.$this->surname;
    }

    /**
     * One-to-One relationship
     * @return HasOne
     */
    public function rating()
    {
        return $this->hasOne(Rating::class, 'user_id');
    }

    /**
     * One-to-One relationship
     * @return HasOne
     */
    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'user_id');
    }
}
