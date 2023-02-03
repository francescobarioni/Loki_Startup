<?php
$fullname = Auth::user()->getFullname();
// Get last record of the user
$review = DB::table('rating')->latest()->where('user_id', '=', Auth::user()->id)->first();
$reviewId = $review->id;
$creationDate = date_format(date_create($review->created_at), 'd F Y');
$updateDate = date_format(date_create($review->updated_at), 'd F Y - H:i');
$rating = $review->value;
$description = $review->description;
?>

<div class="text-left user-review">
    <div class="row">
        <div class="col-md-12">
            <p style="margin-left: -3px">Thanks for leaving us your feedback!</p>
        </div>
    </div>
    <h5 class="text-left mb-3" style="margin-left: -3px">Your review:</h5>
    <div class="row">
        <div class="col-md-6">
            <p class="mb-0" style="font-size: 16px">
                <img class="login-icon logged-profile-image" src="<?= Auth::user()->profilePhotoUrl ?>" alt="<?= $fullname ?>" title="<?= $fullname ?>">
                <span style="font-size: 18px"><?= $fullname ?></span>
                <a class="ml-3" href="{{ route('rating.edit', $reviewId) }}" title="Edit review"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a class="ml-2" type="submit" href="{{ route('rating.destroy', ['id' => $reviewId]) }}" title="Delete review" onclick="return confirm('Are you sure you want to delete this review?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </p>
        </div>
        <div class="col-md-6">
            <p class="text-right"><?= $creationDate ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="rating-stars" title="Rating: <?= $rating ?>/5">
                <?php for ($i = 1; $i <= 5; $i++) {
                    if ($rating >= $i) { ?>
                        <i class="fa fa-star checked" aria-hidden="true"></i>
                    <?php } else { ?>
                        <i class="fa fa-star-o checked" aria-hidden="true"></i>
                    <?php }
                } ?>
            </p>
        </div>
    </div>
    <?php if (!empty($description)) { ?>
        <div class="row">
            <div class="col-md-12">
                <p style="margin-bottom: 0"><?= $description ?></p>
            </div>
        </div>
    <?php } ?>
</div>

<hr class="hr-md">
