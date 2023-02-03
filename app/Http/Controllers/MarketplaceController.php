<?php

namespace App\Http\Controllers;

use App\Models\Marketplace;
use App\Models\PaymentMarket;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MarketplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        // Filters
        $title = $request->input('title');
        $priceFrom = $request->input('price_from');
        $priceTo = $request->input('price_to');

        $items = DB::table('marketplace')
            ->when($title, function($query, $title) {
                $query->where('title', 'like', '%'.$title.'%');
            })
            ->when($priceFrom, function($query, $priceFrom) {
                $query->where('price', '>=', $priceFrom);
            })
            ->when($priceTo, function($query, $priceTo) {
                $query->where('price', '<=', $priceTo);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('marketplace.index', compact('items'))
            ->with('i', (\request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        // Only authorized users in create MarketplacePolicy
        $this->authorize('create', Marketplace::class);

        return view('marketplace.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        // Only authorized users in create MarketplacePolicy
        $this->authorize('create', Marketplace::class);

        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'price' => ['required'],
            'description' => ['required', 'string', 'max:350'],
            'full_description' => ['required']
        ]);

        $item = new Marketplace([
            'title' => $request->post('title'),
            'description' => $request->post('description'),
            'full_description' => $request->post('full_description'),
            'price' => $request->post('price'),
        ]);

        $item['img_name'] = 'default.jpg';
        if ($request->file('image')) {
            // Only allow .jpeg, .jpg and .png file types.
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png'
            ]);
            $image = $request->file('image');
            $imageName = date('Y_m_d_Hi').'_'.$image->getClientOriginalName();
            $image->move(public_path('/img/marketplace'), $imageName);
            $item['img_name'] = $imageName;
        }

        $item->save();

//        Marketplace::create($request->all());

        return redirect()->route('marketplace.show', ['marketplace' => $item])
            ->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Marketplace $marketplace
     * @return Application|Factory|View
     */
    public function show(Marketplace $marketplace)
    {
        return view('marketplace.show', compact('marketplace'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Marketplace $marketplace
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Marketplace $marketplace)
    {
        // Only authorized users in update MarketplacePolicy
        $this->authorize('update', $marketplace);

        return view('marketplace.edit', compact('marketplace'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Marketplace $marketplace
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Marketplace $marketplace)
    {
        // Only authorized users in update MarketplacePolicy
        $this->authorize('update', $marketplace);

        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'full_description' => 'required'
        ]);

        if ($request->file('image')) {
            // Only allow .jpeg, .jpg and .png file types.
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png'
            ]);
            $image = $request->file('image');
            $imageName = date('Y_m_d_Hi').'_'.$image->getClientOriginalName();
            $image->move(public_path('/img/marketplace'), $imageName);
            $marketplace['img_name'] = $imageName;
        }

        $marketplace->update($request->all());

        return redirect()->route('marketplace.show', compact('marketplace'))
            ->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Marketplace $marketplace
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Marketplace $marketplace)
    {
        // Only authorized users in delete MarketplacePolicy
        $this->authorize('delete', $marketplace);

        // Delete image
        $image = $marketplace->img_name;
        if ($image != 'default.jpg') {
            File::delete(public_path('/img/marketplace/') . $marketplace->img_name);
        }

        $marketplace->rating()->delete();
        $marketplace->paymentMarket()->delete();
        $marketplace->delete();

        return redirect()->route('marketplace.index')
            ->with('success', 'Item deleted successfully');
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

        return view('marketplace.payment', [
            'marketplace_id' => $request->post('marketplace_id'),
        ]);
    }

    /**
     * Store Payment action
     * @param Request $request
     * @return Application|Factory|View
     */
    public function storePayment(Request $request)
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

        $paymentMarket = new PaymentMarket([
            'user_id' => $request->post('user_id'),
            'item_id' => $request->post('item_id'),
            'payment_method' => 1,
        ]);

        $paymentMarket->save();

        return view('marketplace/payment_confirmed', [
            'item_id' => $request->post('item_id')
        ])->with('success', 'You are now subscribed successfully.');
    }
}
