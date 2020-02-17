<?php

namespace App\Observers;

use App\User;
use Carbon\Carbon;
use DateTime;


class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function saving(User $user)
    {
        $currentDate = Carbon::now()->toDateString();
        $requestDate = $user->date_of_birth;

        $cu = new DateTime($currentDate);
        $req = new DateTime($requestDate);

        $interval = $cu->diff($req)->y;
        
        $user->age = $interval;
    }
}
