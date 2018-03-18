<?php
namespace App\Policies;
use App\User;
use App\Models\Address;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Address $address)
    {
        return $user->id === $address->user_id ;
    }

    public function delete(User $user, Address $address)
    {
        return $user->id === $address->user_id ;
       
    }
}
