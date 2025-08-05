<?php

namespace App\Traits;

use App\Models\User;

/**
 * Trait WithReferral
 *
 * This trait provides functionality for handling referral codes, including generating unique codes,
 * retrieving users by referral code, and managing referral counts.
 */
trait WithReferral
{

    /**
     * Generate a unique referral code of a specified length.
     *
     * @return string The generated referral code.
     */
    public function generateCode(): string
    {
        $codeLength = 10;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';

        $code = substr(str_shuffle(str_repeat($characters, 5)), 0, $codeLength);

        return $this->checkAndRegenerate($code);
    }

    /**
     * Check if the generated code already exists; if it does, regenerate it.
     *
     * @param string $code The generated referral code to check.
     * @return string The valid referral code that does not exist in the database.
     */
    private function checkAndRegenerate(string $code): string
    {
        if (User::whereRefCode($code)->exists()) {
            return $this->checkAndRegenerate($this->generate());
        }

        return $code;
    }

    /**
     * Retrieve the user ID associated with a given referral code and increment the referral count.
     *
     * @param string $referralCode The referral code to look up.
     * @return int|null The user ID if found, or null if not found.
     */
    public function getUserIdByReferralCodeAndIncrementCount($referralCode): int|null
    {
        if ($user = User::whereRefCode($referralCode)) {
            $this->incrementRefCount($user->id);
            return $user->id;
        }
        return null;
    }

    /**
     * Get the users referred by a specific user.
     *
     * @param int $userId The ID of the user whose referrals are to be retrieved.
     * @return \Illuminate\Database\Eloquent\Collection The collection of referred users.
     */
    public function getReferredUsers(int $userId)
    {
        return $users = User::whereRefBy($userId)->get();
    }

    /**
     * Increment the referral count for a specified user.
     *
     * @param int $userId The ID of the user whose referral count is to be incremented.
     * @return void
     */
    private function incrementReferralCount(int $userId): void
    {
        User::where('id', $userId)->increment('ref_count');
    }
}
