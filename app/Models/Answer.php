<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'question_id'];

    protected $appends = [
        'body_html',
        'created_date',
        'status',
        'is_best',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    protected static function booted()
    {
        static::created(function ($answer) {
            $answer->question()->increment('answers_count');
        });

        static::deleted(function ($answer) {
            $answer->question()->decrement('answers_count');
        });
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }

    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    public function isBest()
    {
        return $this->question && $this->id === $this->question->best_answer_id;
    }

    // Votes Relationship (Polymorphic)
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable')
                    ->withPivot('vote')
                    ->withTimestamps();
    }

    public function upVotes()
    {
        return $this->votes()->wherePivot('vote', 1);
    }

    public function downVotes()
    {
        return $this->votes()->wherePivot('vote', -1);
    }
}
