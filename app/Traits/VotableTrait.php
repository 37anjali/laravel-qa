<?php

namespace App\Traits;

use App\Models\User;

trait VotableTrait
{
    // Polymorphic votes relationship
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable')
                    ->withPivot('vote')
                    ->withTimestamps();
    }

    // Query only upvotes
    public function upVotes()
    {
        return $this->votes()->wherePivot('vote', 1);
    }

    // Query only downvotes
    public function downVotes()
    {
        return $this->votes()->wherePivot('vote', -1);
    }
}
