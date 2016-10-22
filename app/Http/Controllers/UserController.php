<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    public function index(Request $request)
    {
    	return fractal()
    		->item($request->user())
    		->transformWith(new UserTransformer)
    		->toArray();
    }

    public function accountActivation(Request $request)
    {
        $token = $request->get('token');

        try{
            $user = User::where('activation_token', $token)->first();
            if($user->active == 1){
                return response()->json([
                    'confirmation_type' => 'error',
                    'message' => 'Your account is already activated. Try to login now.'
                ]);
            }
            $user->update(['active' => 1]);
        }catch(\Exception $e){
            return response()->json([
                'confirmation_type' => 'error',
                'message' => 'Something wrong in our system, please try again.'
            ]);
        }

        //Redirect user to login and success message
        return response()->json([
            'confirmation_type' => 'success',
            'message' => 'Account Successfully activated, please login.'
        ]);
    }
}
