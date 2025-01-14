<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation {
    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     */

    // Inspecte les valeurs pour voir si elles sont correctes
    public function update($user, array $input) {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'firstName' => ['string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:255'],
            'biography' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        // Met à jour les valeurs modifiées du profil dans la bd
        foreach ($input as $key => $value) {
            if (array_key_exists($key, $input) && $key != "_method" && $key != "photo") {
                $user->forceFill([
                    $key => $value
                ])->save();
            }

            else if(!array_key_exists($key, $input)) {
                $user->forceFill([
                    $key => $input['']
                ])->save();
            }

            else {
               continue;
            }
        }
    }
}
