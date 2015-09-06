<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message', 'user_from', 'user_to'];

    public function userFrom()
    {
        return $this->belongsTo('App\User', 'user_from');
    }

    public function userTo()
    {
        return $this->belongsTo('App\User', 'user_to');
    }

    public function getUsersChat($firstUserId, $secondUserId)
    {
        $messages = self::where(function($query) use($firstUserId, $secondUserId)
        {
            $query->where('user_from', $firstUserId)
                ->where('user_to', $secondUserId);
        })->orWhere(function($query) use($firstUserId, $secondUserId)
        {
            $query->where('user_from', $secondUserId)
                ->where('user_to', $firstUserId);
        })
        ->with('userFrom')
        ->with('userTo')
        ->orderBy('created_at')->get();

        return $messages;
    }

}
