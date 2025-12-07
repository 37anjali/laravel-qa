<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;
   

    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id',
    ];

    /**
     * Automatically generate slug from title
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


    public function getUrlAttribute()
    {
        return  route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute()
    {
         return $this->created_at->diffForHumans();
    }

     public function getStatusAttribute()
     {
        if ($this->answers_count > 0){
            if($this->best_answer_id){
                 return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
     }
public function getBodyHtmlAttribute()
{
    $parsedown = new \Parsedown();
    $parsedown->setSafeMode(true);

    return $parsedown->text($this->body);
}

public function answers()
{
    return $this->hasMany(Answer::class);
}

    /**
     * Define relationship: a question belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }





    public function favorites()
{
    return $this->belongsToMany(User::class,'favorites')->withTimestamps();//, 'question_id','user_id', );
}


public function isFavorited()
{
    return $this->favorites()->where('user_id', auth()->id())->count() > 0;

}

public function getIsFavoritedAttribute()
{
    return $this->isFavorited();
}

public function getFavoritesCountAttribute()
{
    return $this->favorites->count();
}

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
