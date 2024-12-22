<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        $originalData = $user->only(['name', 'email']); // Capture the original data

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }

        // Log the profile update
        Log::info('User profile updated', [
            'user_id' => $user->id,
            'original_data' => $originalData,
            'updated_data' => $user->only(['name', 'email']),
            'ip_address' => request()->ip(),
            'browser' => request()->header('User-Agent'),
            'performed_by' => $user->name, // Since the user is updating their own profile
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $originalData = $user->only(['name', 'email']); // Capture the original data

        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();

        // Log the verified user profile update
        Log::info('Verified user profile updated', [
            'user_id' => $user->id,
            'original_data' => $originalData,
            'updated_data' => $user->only(['name', 'email']),
            'ip_address' => request()->ip(),
            'browser' => request()->header('User-Agent'),
            'performed_by' => $user->name,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
