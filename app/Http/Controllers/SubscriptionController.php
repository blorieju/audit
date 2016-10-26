<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Plan;

class SubscriptionController extends Controller
{
    public function index()
    {

    }

    public function create(Request $request)
    {
        $plan = Plan::findOrFail($request->plan);

        if ($request->user()->subscribedToPlan($plan->stripe_plan, 'main')) {
            return response()->json([
	            'confirmation_type' => 'success',
	            'message' => 'Subscribed'
	        ],200);
        }

        if (!$request->user()->subscribed('main')) {
            $request->user()->newSubscription('main', $plan->stripe_plan)->create($request->payment_method_nonce);
        } else {
            $request->user()->subscription('main')->swap($plan->stripe_plan);
        }

        return response()->json([
            'confirmation_type' => 'success',
            'message' => 'Subscribed'
        ],200);
    }

    public function cancel(Request $request)
    {
        $request->user()->subscription('main')->cancel();

        return response()->json([
            'confirmation_type' => 'success',
            'message' => 'Your subscription already cancelled'
        ],200);
    }

     public function resume(Request $request)
    {
        $request->user()->subscription('main')->resume();

        return response()->json([
            'confirmation_type' => 'success',
            'message' => 'Your subscription is already resumed'
        ],200);
    }
}
