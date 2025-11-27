<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
        'body',
        'votes_count',
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
        $parsedown = new \Parsedown();
        $parsedown->setSafeMode(true);

        return $parsedown->text($this->body);
    }

    protected static function boot()
    {
        parent::boot();

        // When a new answer is created
        static::created(function ($answer) {
            if ($answer->question) {
                // Increment answers_count column
              $answer->question->increment('answers_count');


            }
        });

        static::deleted(function ($answer) {

            $question = $answer->question;
             $question->decrement('answers_count');
             if($question->best_answer_id === $answer->id){
                $question->best_answer_id = NULL;
                $question->save();
             }
        });
    }

    public function getCreatedDateAttribute()
    {
         return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->id === $this->question->best_answer_id ? 'vote-accepted' : '';
    }
}
