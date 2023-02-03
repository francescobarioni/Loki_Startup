<?php
$allReviews = \App\Models\Rating::orderBy('created_at', 'DESC')->where('marketplace_id', '=', $marketplace->id)->get();

if (Auth::check()) {
    $othersReviews = $allReviews->where('user_id', '!=', Auth::user()->id);
    $loggedUserReview = $allReviews->where('user_id', '=', Auth::user()->id);
}
?>


<!-- Section title -->
<h1 class="mt-4"><i class="fa fa-star-o mr-2" aria-hidden="true"></i>Reviews</h1>
<hr class="hr-md">

<!-- Form -->
<?php
if (Auth::check() && Auth::user()->can('create_rating', $marketplace)) { ?>
    <div id="reviews"></div>
    <h5 id="your-review-title" class="text-left mb-3" style="margin-left: -3px">Your review:</h5>
    <?php if ($loggedUserReview->isEmpty()) { ?>
        <div id="form-review" class="text-left">
            <form id="rating-form">
                @csrf
                <p class="mb-1">Your vote:</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class='rating-stars' style="font-size: 8px; margin-left: -3px">
                            <ul id='stars'>
                                <li class='star' title='Bad' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Decent' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Average' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <p class="mb-1">Description (optional):</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea id="rating-description" class="form-control" name="rating" placeholder="Describe your experience..." rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="user-id" value="<?= Auth::user()->id ?>">
                <input type="hidden" id="marketplace-id" value="<?= $marketplace->id ?>">

                <div class="row">
                    <div class="col-md-12">
                        <button id="review-submit-button" type="submit" class="btn btn-primary mr-3">Submit</button>
                        <div id="review-spinner" class="spinner-border text-primary mt-1" role="status" style="position: absolute; display: none">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </form>
            <hr class="hr-md">
        </div>
    <?php } else {
        if (isset($loggedUserReview)) {
            foreach ($loggedUserReview as $review) {
                echo view('/marketplace/parts/_userReview', ['review' => $review]);
            }
        }
    }
} ?>

<!-- Reviews -->
<?php
if (!Auth::check()) {
    if ($allReviews->isEmpty()) { ?>
        <p>This item has no reviews yet.</p>
    <?php } else {
        foreach ($allReviews as $review) {
            echo view('/marketplace/parts/_userReview', ['review' => $review]);
        }
    }
} else {
    if (!$othersReviews->isEmpty()) {
//        if (Auth::check() && Auth::user()->can('create_rating', $marketplace)) { ?><!---->
{{--            <h5 class="text-left mb-3" style="margin-left: -3px">Other users reviews:</h5>--}}
        <!----><?php //} ?>
    <?php foreach ($othersReviews as $review) {
        echo view('/marketplace/parts/_userReview', ['review' => $review]);
    }
} else if ($allReviews->isEmpty()) { ?>
    <p id="no-reviews">This item has no reviews yet.</p>
<?php }
} ?>
