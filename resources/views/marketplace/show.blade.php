@extends('layouts.layout')

@section('title')
    - <?= $marketplace->title ?>
@endsection


@section('content')
    <?php
    // Rating
    $averageReviewsRating = DB::table('rating')->where('marketplace_id', '=', $marketplace->id)->avg('value');
    $countReviews = DB::table('rating')->where('marketplace_id', '=', $marketplace->id)->count();

    // Tooltips
    $tooltip = '';
    if (!Auth::check()) {
        $tooltip = 'data-toggle="tooltip" data-placement="bottom" title="You must be logged in to buy items in marketplace"';
    }
    $reviewTooltip = '';
    if ($countReviews == 0) {
        $reviewTooltip = 'data-toggle="tooltip" data-placement="top" title="'.$marketplace->title.' has no reviews"';
    } else if ($countReviews > 0) {
        $reviewTooltip = 'data-toggle="tooltip" data-placement="top" title="Average users rating: '.round($averageReviewsRating, 1).'/5"';

    }
    ?>

    <?= App\Utility\Utility::getBreadcrumbs() ?>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <!-- Item -->
    <div class="row mt-5">
        <!-- Image -->
        <div class="col-md-6">
            <img class="rounded-lg item-image" src="/img/marketplace/<?=$marketplace->img_name?>" alt="<?=$marketplace->img_name?>">
            <!-- Manage widget -->
            <?php if (Auth::check()) { ?>
                <?php if (Auth::user()->can('update_marketplace') || Auth::user()->can('delete_marketplace')) { ?>
                    <div class="dropdown item-detail-manage">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Manage <?= $marketplace->title ?>">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <!-- Edit -->
                            <?php if (Auth::user()->can('update_marketplace')) { ?>
                                <a class="dropdown-item" href="{{ route('marketplace.edit', $marketplace->id) }}" title="Edit <?=$marketplace->title?>">Edit</a>
                            <?php } ?>
                            <!-- Delete -->
                            <?php if (Auth::user()->can('delete_marketplace')) { ?>
                                <form action="{{ route('marketplace.destroy', $marketplace->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item" type="submit" href="{{ route('marketplace.destroy', $marketplace->id) }}" title="Delete <?=$marketplace->title?>" onclick="return confirm('Are you sure you want to delete <?= $marketplace->title ?>?')">Delete</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <!-- Info -->
        <div class="col-md-6 item-info-box">
            <h1><?= $marketplace->title ?></h1>
            <p class="item-description"><?= $marketplace->description ?></p>
            <div class="row mt-5">
                <!-- Total rating -->
                <div class="col-md-6 stars-container">
                    <p <?= $reviewTooltip ?> class="rating-stars-item mb-0" title="<?= $averageReviewsRating != 0 ? $marketplace->title .' users average rating: '.round($averageReviewsRating, 1).'/5' : $marketplace->title.' has no reviews yet' ?>">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            if ($averageReviewsRating >= $i || $averageReviewsRating >= $i - 0.25) { ?>
                                <i class="fa fa-star checked" aria-hidden="true"></i>
                            <?php } else {
                                if ($averageReviewsRating >= $i - 0.75) { ?>
                                    <i class="fa fa-star-half-o checked" aria-hidden="true"></i>
                                <?php } else { ?>
                                    <i class="fa fa-star-o checked" aria-hidden="true"></i>
                                <?php }
                            }
                        } ?>
                    </p>
                    <?php if ($countReviews == 0) { ?>
                        <p class="mb-2">No reviews</p>
                    <?php } else { ?>
                        <a class="review-link" href="#reviews-anchor" title="Go to review section">
                            <p class="mb-2">
                                <?= $countReviews == 1 ? $countReviews.' review' : $countReviews.' reviews' ?><i class="fa-solid fa-angle-down ml-2"></i>
                            </p>
                        </a>
                    <?php } ?>

                </div>
                <!-- Buy button -->
                <form action="<?= route('marketplace/payment') ?>" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-6 text-right buy-button-container">
                        <div class="item-buy-button">
                            <button type="submit" <?= $tooltip ?> name="marketplace_id" value="<?= $marketplace->id ?>" class="btn btn-primary" style="font-size: 24px" title="Buy <?= $marketplace->title ?> for <?= $marketplace->price ?>$" onclick="return confirm('Are you sure you want to buy <?= $marketplace->title ?>?')">
                                <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
                                <?= $marketplace->price ?>$
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Full description -->
    <?php if (!empty($marketplace->full_description)) { ?>
        <h1 class="mt-5"><i class="fa-regular fa-note-sticky mr-2"></i>Description</h1>
        <hr class="hr-md">
        <div class="row">
            <div class="col-md-12 full-description text-left">
                <?= $marketplace->full_description ?>
            </div>
        </div>
    <?php } ?>

    <!-- Reviews section -->
    <div id="reviews-anchor" class="review-anchor"></div>
    <?= view('/marketplace/parts/_reviews', ['marketplace' => $marketplace]); ?>

    <div class="row">
        <div class="col-md-12 text-left mt-4">
            <a class="btn btn-secondary" href="<?= route('marketplace.index') ?>">Back</a>
        </div>
    </div>


@endsection
