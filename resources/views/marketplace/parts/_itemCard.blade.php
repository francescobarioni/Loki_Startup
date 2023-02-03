<?php
$averageReviewsRating = DB::table('rating')->where('marketplace_id', '=', $item->id)->avg('value');
$countReviews = DB::table('rating')->where('marketplace_id', '=', $item->id)->count();
?>

<div class="col-md-4 card-container mt-1 mb-1">
    <a href="<?= route('marketplace.show', $item->id) ?>" title="See <?= $item->title ?>">
        <img class="rounded card-image" src="img/marketplace/<?= $item->img_name ?>" alt="<?= $item->title ?>">
    </a>

    <!-- Manage widget -->
    <?php if (Auth::check()) { ?>
        <?php if (Auth::user()->can('update_marketplace') || Auth::user()->can('delete_marketplace')) { ?>
            <div class="dropdown item-card-manage">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Manage <?= $item->title ?>">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- Edit -->
                    <?php if (Auth::user()->can('update_marketplace')) { ?>
                        <a class="dropdown-item" href="{{ route('marketplace.edit', $item->id) }}" title="Edit <?=$item->title?>">Edit</a>
                    <?php } ?>
                    <!-- Delete -->
                    <?php if (Auth::user()->can('delete_marketplace')) { ?>
                        <form action="{{ route('marketplace.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="dropdown-item" type="submit" href="{{ route('marketplace.destroy', $item->id) }}" title="Delete <?=$item->title?>" onclick="return confirm('Are you sure you want to delete <?= $item->title ?>?')">Delete</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>


    <div class="row">
        <div class="col-lg-9 text-left">
            <p class="item-description mb-0" style="font-size: 19px">
                <a href="<?= route('marketplace.show', $item->id) ?>" title="See <?= $item->title ?>">
                    <?= $item->title ?>
                </a>
            </p>
        </div>
        <div class="col-lg-3 text-right price">
            <span class="badge badge-price" title="Price: <?= $item->price ?>$"><?= $item->price ?>$</span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-left">
            <p class="rating-stars" style="font-size: 15px" title="<?= $averageReviewsRating != 0 ? $item->title .' users average rating: '.round($averageReviewsRating, 1).'/5' : $item->title.' has no reviews yet' ?>">
                <?php for ($i = 1; $i <= 5; $i++) {
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
                <span title="<?= $countReviews ?> reviews for <?= $item->title ?>">
                    <i class="fa-regular fa-pen-to-square ml-1 mr-1"></i><?= $countReviews ?>
                </span>

            </p>

            <span></span>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-lg-12 text-left item-description">
            <p class="mb-0 short-description">
                <a href="<?= route('marketplace.show', $item->id) ?>" title="See <?= $item->title ?> to read more">
                    <?php if (strlen($item->description) > 90) {
                        echo substr($item->description, 0, 87) . '...';
                    } else {
                        echo $item->description;
                    } ?>
                </a>
            </p>
        </div>
    </div>
    <hr class="hr-sm mt-1">
</div>
