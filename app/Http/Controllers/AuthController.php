<?php

namespace App\Http\Controllers;

use JWTAuth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Transformers\UserTransformer;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\Auth\RegisterFormRequest;

class AuthController extends Controller
{
    public function signup(RegisterFormRequest $request)
    {
        $args = [
            'sign_up' => true
        ];

        return User::storeOrUpdate($request, $args);
    }

    public function signin(Request $request)
    {
        $credentials = $request->only('email','password');

        $email = $request->get('email');
        $user = User::where('email',$email)->first();

        try{

            //check if user is active
            if($user && $user->active == 0)
            {
                return response()->json([
                    'confirmation_type' => 'error',
                    'message' => 'Your account is not activated.'
                ], 401);
            }

            $token = JWTAuth::attempt($request->only('email', 'password'), [
                'exp' => Carbon::now()->addWeek()->timestamp,
            ]);
        }catch (JWTException $e){
            return response()->json([
                'error' => 'Could not authenticate',
            ], 500);
        }
        if( !$token){
            return response()->json([
                'error' => 'Could not authenticate',
            ], 401);
        }

        return fractal()
            ->item($request->user())
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $token,
             ])
            ->toArray();
    }

    public function signout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'confirmation_type' => 'success',
            'message' => 'Logged out successfully.'
        ]);
    }

}
