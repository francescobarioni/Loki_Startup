<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    /**
     * Ajax request
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {

        $request->validate([
           'value' => 'required',
//           'description' => 'string'
        ]);

        /*$rating = new Rating([
            'value' => $request->value,
            'description' => $request->description,
            'user_id' => $request->userId,
            'marketplace_id' => $request->marketplaceId
        ]);*/
        $rating = new Rating();
        $rating->value = $request->value;
        $rating->description = $request->description;
        $rating->user_id = $request->userId;
        $rating->marketplace_id = $request->marketplaceId;
        $rating->save();

        return response()->json(['success' => 'Review received']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(Rating $rating)
    {
        // Only authorized users in update RatingPolicy
        $this->authorize('update', $rating);

        return view('rating.edit', compact('rating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Marketplace $marketplace
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Rating $rating)
    {
        // Only authorized users in update RatingPolicy
        $this->authorize('update', $rating);

        $request->validate([
            'value' => 'required',
            'description' => ['string', 'nullable']
        ]);

        $rating->update($request->all());

        return redirect()->to('/marketplace/'.$rating->marketplace_id)
            ->with('success', 'Review updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rating $rating
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $review = Rating::find($id);

        // Only authorized users in delete RatingPolicy
        $this->authorize('delete', $review);

        $review->delete();

        return redirect()->back()
            ->with('success', 'Review deleted successfully');
    }
}
