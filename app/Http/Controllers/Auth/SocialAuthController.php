<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    //google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
            $googleUser = Socialite::driver('google')->user();

            $customer = Customer::updateOrCreate(
                [
                    'provider_id' => $googleUser->getId(),
                    'provider' => 'google',
                ],
                [
                    'name' => $googleUser->getName(),
                    'username' => $this->generateUsername($googleUser->getEmail(), $googleUser->getName()),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'provider_token' => $googleUser->token,
                    'provider_refresh_token' => $googleUser->refreshToken,
                    'password' => Hash::make(Str::random(24)),
                    'email_verified_at' => now(),
                ]
            );

            auth()->guard('customer')->login($customer);

            return redirect()->route('customer.dashboard');

    }

    // //facebook
    // public function redirectToFacebook()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function handleFacebookCallback()
    // {

    //         $facebookUser = Socialite::driver('facebook')->user();

    //         $customer = Customer::updateOrCreate(
    //             [
    //                 'provider_id' => $facebookUser->getId(),
    //                 'provider' => 'facebook',
    //             ],
    //             [
    //                 'name' => $facebookUser->getName(),
    //                 'username' => $this->generateUsername($facebookUser->getEmail(), $facebookUser->getName()),
    //                 'email' => $facebookUser->getEmail(),
    //                 'avatar' => $facebookUser->getAvatar(),
    //                 'provider_token' => $facebookUser->token,
    //                 'provider_refresh_token' => $facebookUser->refreshToken,
    //                 'password' => Hash::make(Str::random(24)),
    //                 'email_verified_at' => now(),
    //             ]
    //         );

    //         auth()->guard('customer')->login($customer);

    //         // Redirect ke dashboard customer dengan named route
    //         return redirect()->route('home');
    // }




    /**
     * Generate username unik dari email atau nama
     */
    private function generateUsername($email, $name)
    {
        // Jika email null (beberapa provider tidak memberikan email)
        if (empty($email)) {
            $baseUsername = preg_replace('/[^a-zA-Z0-9]/', '', $name);
        } else {
            // Ambil bagian sebelum @ dari email
            $baseUsername = explode('@', $email)[0];
            $baseUsername = preg_replace('/[^a-zA-Z0-9]/', '', $baseUsername);
        }

        // Jika masih kosong, gunakan random string
        if (empty($baseUsername)) {
            $baseUsername = 'user' . Str::random(8);
        }

        $username = strtolower($baseUsername);
        $originalUsername = $username;
        $counter = 1;

        // Cek apakah username sudah ada, jika ada tambahkan angka
        while (Customer::where('username', $username)->exists()) {
            $username = $originalUsername . $counter;
            $counter++;
        }

        return $username;
    }
}
