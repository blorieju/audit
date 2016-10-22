<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

	public function transform(User $user)
	{
		return [
			'username' => $user->email,
            'avatar' => $user->avatar(),
            'account_type' => [
                'name' => $user->roles()->lists('name'),
                'description' => $user->roles()->lists('description')
            ],
            'profile_info' => $user->profile()->get(),
		];
	}

}
