<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Transformers\PlanTransformer;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::get();
        return fractal()
            ->collection($plans)
            ->transformWith(new PlanTransformer)
            ->toArray();
    }
}
