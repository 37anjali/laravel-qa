<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str; 

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);

    }


    public function getUrlAttribute()
    {
        // return  route("questions.show", $this->id);
        return '#';
    }

             public function answers()
             {
                         return $this->hasMany(Answer::class);
           }

    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


     public function getAvatarAttribute()
{
    $email = strtolower(trim($this->email));
    $hash = md5($email);
    $size = 20;
    return "https://www.gravatar.com/avatar/{$hash}?s=200&d=identicon";
    
}

public function favorites()
{
    return $this->belongsToMany(Question::class,'favorites')->withTimestamps();//, 'user_id', 'question_id');
}

}
