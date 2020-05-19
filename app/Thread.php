<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Thread extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });

        static::addGlobalScope('owner', function ($builder) {
            $builder->with('owner');
        });

        static::addGlobalScope('channel', function ($builder) {
            $builder->with('channel');
        });

        static::created(function ($thread) {
            Activity::create([
                'user_id' => auth()->id(),
                'type' => 'created_' . strtolower((new ReflectionClass($thread))->getShortName()),
                'subject_id' => $thread->id,
                'subject_type' => get_class($thread)
            ]);
        });
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
