<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;
use Illuminate\Support\Collection;

class UserTransformer extends TransformerAbstract
{

	public function transform(User $user)
	{
        $profile = $user->profile()->get();

		return [
			'username' => $user->email,
            'avatar' => $user->avatar(),
            'account_type' => [
                'name' => $user->roles()->lists('name'),
                'description' => $user->roles()->lists('description')
            ],
            'profile_info' => [
                'first_name' => $profile[0]->first_name,
                'last_name' => $profile[0]->last_name,
                'mobile' => $profile[0]->mobile,
                'address' => $profile[0]->address,
                'gravatar' => $profile[0]->gravatar,
                'profile_image_path' => $profile[0]->profile_image_path,
                'created_at' => $profile[0]->created_at
            ],
		];
	}

}
