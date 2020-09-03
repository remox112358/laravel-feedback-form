<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = "feedbacks";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'subject', 'message', 'file'
    ];

    /**
     * Get the feedback author.
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determine scope for feedback find by viewed status.
     *
     * @param $query
     * @param integer $viewed
     * @return \Illuminate\Support\Collection
     */
    public function scopeViewed($query, $viewed)
    {
        return $query->whereViewed($viewed);
    }
}
