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
     * The user feedback sending time limit.
     *
     * @var integer
     */
    protected $limitInHours = 24;

    /**
     * Determines the user has administrator role.
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }

    /**
     * Get the user feedbacks.
     *
     * @return void
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    /**
     * Get the user last feedback create time.
     *
     * @return string
     */
    public function getLastFeedbackTime()
    {
        $feedbacks = $this->getFeedbacks();
        $lastFeedback = $feedbacks->orderBy('created_at', 'desc')->first(); 

        return $lastFeedback->created_at ?? false;
    }

    /**
     * Get the user feedback send enable formatted time.
     *
     * @param string $format
     * @return string
     */
    public function getFeedbackSendEnableTime($format = 'H:i d.m.Y')
    {
        if (! $this->getLastFeedbackTime())
            return false;

        $time = new Carbon($this->getLastFeedbackTime());
        $time = $time->addHours($this->limitInHours)->format($format);

        return $time;
    }

    /**
     * Determines the user can send feedback message.
     *
     * @return Carbon
     */
    public function canSend()
    {
        if(! $this->getLastFeedbackTime())
            return true;

        $hours = Carbon::now()->diffInHours($this->getLastFeedbackTime());
        
        return $hours >= $this->limitInHours ? true : false;
    }
}
