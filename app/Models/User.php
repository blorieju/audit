<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Profile;
use App\Events\UserHasRegistered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable;
use App\Transformers\UserTransformer;

class User extends Model implements AuthenticatableContract,
                                    CanResetPasswordContract
{

    use Authenticatable,
        CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','activation_token', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static function storeOrUpdate($request, $args = [])
    {
        //Sign Up User
        if(array_key_exists('sign_up', $args) && $args['sign_up']){
            $user = new User([
                'email' => $request->json('email'),
                'password' => bcrypt($request->json('password')),
            ]);
            $user->save();

            $profile = new Profile();
            $profile->first_name = $request->json('first_name');
            $profile->last_name = $request->json('last_name');
            $profile->mobile = $request->json('mobile');
            $profile->address = $request->json('address');
            $user->profile()->save($profile);

            //User Account Type
            $user->roles()->attach(3);
            //Fire an event to user
            $args = [
                'email_activation' => true
            ];

            try{
                Self::sendEmailToUserByRequest($user, $args);
            }catch (\Exception $e) {
                return response()->json([
                    'confirmation_type' => 'error',
                    'message' => 'Something problem in our Mail server'
                ],500);
            }

        }

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->toArray();
    }

    public function findUserbyEmail($request)
    {
        try{
            $user = Self::where('email',$request)->first();
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        return $user;
    }

    public static function sendEmailToUserByRequest($request, $args = [])
    {
        if(array_key_exists('email_activation', $args) && $args['email_activation'])
        {
            event(new UserHasRegistered($request));
        }
    }

    public function avatar()
    {
        return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?s=35&d=mm';
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','role_user');
    }
}
