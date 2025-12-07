<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationships
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')
                    ->withTimestamps();
    }

    // Votable Polymorphic Relations
    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable')
                    ->withPivot('vote')
                    ->withTimestamps();
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable')
                    ->withPivot('vote')
                    ->withTimestamps();
    }

    // Voting Logic
    public function voteQuestion(Question $question, $vote)
    {
        $existing = $this->voteQuestions()
                         ->where('votable_id', $question->id)
                         ->first();

        if ($existing) {
            $this->voteQuestions()->updateExistingPivot($question->id, ['vote' => $vote]);
        } else {
            $this->voteQuestions()->attach($question->id, ['vote' => $vote]);
        }

        $this->updateQuestionVoteCount($question);
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $existing = $this->voteAnswers()
                         ->where('votable_id', $answer->id)
                         ->first();

        if ($existing) {
            $this->voteAnswers()->updateExistingPivot($answer->id, ['vote' => $vote]);
        } else {
            $this->voteAnswers()->attach($answer->id, ['vote' => $vote]);
        }

        $this->updateAnswerVoteCount($answer);
    }

    // Helpers to update counts
    protected function updateQuestionVoteCount(Question $question)
    {
        $question->load('votes');

        $up = $question->upVotes()->sum('vote');   // votes = 1
        $down = $question->downVotes()->sum('vote'); // votes = -1

        $question->votes_count = $up + $down;
        $question->save();
    }

    protected function updateAnswerVoteCount(Answer $answer)
    {
        $answer->load('votes');

        $up = $answer->upVotes()->sum('vote');
        $down = $answer->downVotes()->sum('vote');

        $answer->votes_count = $up + $down;
        $answer->save();
    }

    // Accessors
    public function getAvatarAttribute()
    {
        return "https://www.gravatar.com/avatar/" 
            . md5(strtolower(trim($this->email))) 
            . "?s=32";
    }

    public function getUrlAttribute()
    {
        return '#';
    }
}
