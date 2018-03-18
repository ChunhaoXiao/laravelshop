<?php

namespace App\Policies;

use App\User;
use App\Models\Comment ;
use App\Models\OrderProduct ;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user, Comment $comment)
    {
        $count = $user->orderproducts()->where('product_id', $comment->product_id)->count() ;
        return $count > 0;
    }
}
