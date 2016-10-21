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
            'account_type' => $user->roles()->get(),
            'profile_info' => $user->profile()->get(),
		];
	}

}
