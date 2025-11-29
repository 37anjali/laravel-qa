<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Question;
use App\Models\User;
use Parsedown;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'question_id'];

    protected $appends = ['body_html', 'created_date', 'status'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors (Laravel 12: use getXxxAttribute)
    |--------------------------------------------------------------------------
    */
    public function getBodyHtmlAttribute()
    {
        return Parsedown::instance()->text($this->body ?? '');
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at?->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->id === $this->question->best_answer_id
            ? 'vote-accepted'
            : '';
    }

    /*
    |--------------------------------------------------------------------------
    | Model Events (Laravel 12)
    |--------------------------------------------------------------------------
    */
    protected static function booted()
    {
        static::created(function ($answer) {
            $answer->question()->increment('answers_count');
        });

        static::deleted(function ($answer) {
            $answer->question()->decrement('answers_count');
        });
    }
}
