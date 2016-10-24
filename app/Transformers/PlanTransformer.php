<?php

namespace App\Transformers;

use App\Models\Plan;
use League\Fractal\TransformerAbstract;
use Illuminate\Support\Collection;

class PlanTransformer extends TransformerAbstract
{

    public function transform(Plan $plan)
    {
        return [
            'name' => $plan->name,
            'slug' => $plan->slug,
            'stripe_plan' => $plan->stripe_plan,
            'cost' => $plan->cost,
            'description' => $plan->description,
            'created_at' => $plan->created_at,
        ];
    }

}
