<?php

namespace App\Models;

use App\Traits\VotableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Parsedown;

class Question extends Model
{
    use VotableTrait;

    protected $fillable = ['title', 'body'];

    protected $appends = [
        'url',
        'created_date',
        'status',
        'body_html',
        'is_favorited',
        'favorites_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // -------------------------------
    // Mutators
    // -------------------------------
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // -------------------------------
    // Accessors
    // -------------------------------
    public function getUrlAttribute()
    {
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            return $this->best_answer_id ? "answered-accepted" : "answered";
        }

        return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
        return Parsedown::instance()->text($this->body);
    }

    // -------------------------------
    // Relationships
    // -------------------------------
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')
            ->withTimestamps();
    }

    // -------------------------------
    // Favorite Helpers
    // -------------------------------
    public function isFavorited()
    {
        return $this->favorites()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }
}
