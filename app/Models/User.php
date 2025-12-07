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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // --------------------------
    // Relationships
    // --------------------------

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
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable')->withPivot('vote')->withTimestamps();
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable')->withPivot('vote')->withTimestamps();
    }

    // --------------------------
    // Voting Methods
    // --------------------------

    public function voteQuestion(Question $question, $vote)
    {
        $this->_vote($this->voteQuestions(), $question, $vote);
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $this->_vote($this->voteAnswers(), $answer, $vote);
    }

    private function _vote($relationship, $model, $vote)
    {
        if ($relationship->where('votable_id', $model->id)->exists()) {
            $relationship->updateExistingPivot($model->id, ['vote' => $vote]);
        } else {
            $relationship->attach($model->id, ['vote' => $vote]);
        }

        // Refresh and update vote count
        $model->load('votes');

        $downVotes = (int) $model->downVotes()->sum('vote');
        $upVotes   = (int) $model->upVotes()->sum('vote');

        $model->votes_count = $upVotes + $downVotes;
        $model->save();
    }

    // --------------------------
    // Accessors
    // --------------------------

    public function getUrlAttribute()
    {
        return '#';
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size  = 32;

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s={$size}";
    }
}
