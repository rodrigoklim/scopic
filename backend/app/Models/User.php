<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'wallet'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function autoBids()
    {
        return $this->hasMany(AutoBid::class, 'user_id', 'id');
    }
    
    public function getWalletAttribute()
    {
        $autobid = file_get_contents(public_path('autobid-'.$this->id.'.env'));
        $config = explode(';',$autobid);
        $amount = explode('=', $config[2]);
        $alert = explode('=', $config[1]);
        $maxAmount = explode('=', $config[0]);

        $response = [
            'amount' => $amount[1],
            'alert' => floatval($maxAmount[1]) -  floatval($maxAmount[1]) * (floatval($alert[1])/100)
        ];
        return $response;
    }
}
