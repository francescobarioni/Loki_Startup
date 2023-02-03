<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('subscriptions.subscriptions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        //
    }

    /**
     * Payment action
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function payment(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $type = $request->post()['type'];

        if ($type != Subscription::SUBSCRIPTION_TYPE_BRIGHT) {
            $price = Subscription::getSubscriptionPrice()[$type];

            return view('subscriptions.payment', [
                'type' => $type,
                'price' => $price
            ]);
        } else {
            $subscription = new Subscription([
                'user_id' => Auth::user()->id,
                'package_type' => $type,
                'payment_method' => 1,
            ]);

            $subscription->save();

            return view('subscriptions.payment_confirmed', [
                'sub_type' => $type
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => ['required', 'string', 'max:23'],
            'cc_number' => ['required'],
            'expiration' => ['required', 'string'],
            'security_code' => ['required'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'province' => ['required', 'string'],
            'address' => ['required', 'string'],
            'postal_code' => ['required'],
        ]);

        if (!is_null(Auth::user()->subscription)) {
            $subscription = DB::table('subscription')->where('user_id', '=', Auth::user()->id);
            $subscription->update(['package_type' => $request->post('sub_type')]);
        } else {
            $subscription = new Subscription([
                'user_id' => $request->post('user_id'),
                'package_type' => $request->post('sub_type'),
                'payment_method' => 1,
            ]);
            $subscription->save();
        }

        return view('subscriptions/payment_confirmed', [
            'sub_type' => $request->post('sub_type')
        ])->with('success', 'You are now subscribed successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
