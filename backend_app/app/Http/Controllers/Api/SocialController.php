<?php

namespace App\Http\Controllers\Api;

use App\Commons\ApiResponse;
use App\Models\Customer;
use App\Models\SocialAccount;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function loginUrl($social)
    {
        $hostWithHttp = request()->headers->get('referer');
        $redirectUrl = $hostWithHttp . $social."/callback";
        return ApiResponse::response(0, 'success', [
            'url' => Socialite::driver($social)
                ->redirectUrl($redirectUrl)
                ->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function loginCallback($social)
    {
        $hostWithHttp = request()->headers->get('referer');
        $redirectUrl = $hostWithHttp . $social."/callback";
        $socialUser= Socialite::driver($social)->redirectUrl($redirectUrl)->stateless()->user();
        $email = trim($socialUser->getEmail());
        $name = trim($socialUser->getName());
        $user = '';
        if (!empty($email)) {
            $user = \App\Models\User::query()->where('email', $email)->first();
        }
        if (!$user instanceof \App\Models\User) {
            $user = \App\Models\User::create([
                'email' => $email,
                'name' => $name,
            ]);
        }
        $socialAccount = SocialAccount::firstOrNew(
            ['provider_id' => $socialUser->getId(), 'provider' => $social],
            ['provider_name' => $socialUser->getName()]
        );

        $socialAccount->fill(['customer_id' => $user->id])->save();
        if ($user instanceof \App\Models\User){
            $user->avatar = $socialUser->getAvatar(1920);
            $user->save();
            if (!$token = auth('api')->login($user)) {
                return ApiResponse::responseError('Unauthorized');
            }
            $data = [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ];
            return ApiResponse::response(0, 'success', $data);
        }
        return ApiResponse::responseError('Lỗi login');
    }

}