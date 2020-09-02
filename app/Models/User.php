<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user last feedback create time.
     *
     * @return void
     */
    public function getLastFeedbackTime()
    {

    }

    /**
     * Determines the user can send feedback message.
     *
     * @return Carbon
     */
    public function canSend()
    {
        var_dump(Carbon::now()->diffInHours($this->created_at));
    }
}
