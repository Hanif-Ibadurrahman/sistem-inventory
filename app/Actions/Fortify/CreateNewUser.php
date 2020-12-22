<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'regex:/^([a-z]+)(\.[a-z]+)(\.tik[0-9]+)*@\b(?:(?:mhsw?|tik).pnj.ac.id)+$/i','max:255', 'unique:users'],
            'nip' => ['required', 'numeric', 'min:16', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'nip' => $input['nip'],
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole([2]); // 1 = admin, 2 = member
        return $user;
    }

}
