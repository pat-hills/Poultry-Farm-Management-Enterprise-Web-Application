<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function check_if_user_setup_farm($user)
    {
        if ($user->farm_id) {
            return true;
        } else {
            return false;
        }
    }


    public function getUserFarmAccount($user)
    {
          return  $user->farm_account;
    }


    public function saveUser($name, $email, $phone_number, $password, $country_code)
    {
        $this->user->name = $name;
        $this->user->email = $email;
        $this->user->primary_contact = $phone_number;
        $this->user->country_code = $country_code;
        $this->user->password = Hash::make($password);
        $this->user->save();
        return $this->user;
    }
}
