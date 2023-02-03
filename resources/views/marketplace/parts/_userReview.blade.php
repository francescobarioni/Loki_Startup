<?php
$fullname = $review->user->getFullname();
$creationDate = date_format(date_create($review->created_at), 'd F Y');
$updateDate = date_format(date_create($review->updated_at), 'd F Y - H:i');
$rating = $review->value;
$description = $review->description;
?>

<div class="text-left user-review">
    <div class="row">
        <div class="col-md-6">
            <p class="mb-1" style="font-size: 16px; margin-left: -3px">
                <img class="login-icon logged-profile-image" src="<?= $review->user->profilePhotoUrl ?>" alt="<?= $fullname ?>" title="<?= $fullname ?>">
                <span style="font-size: 18px"><?= $fullname ?></span>
                <?php
                if (Auth::check()) {
                    if (Auth::user()->can('update_rating', $review)) { ?>
                        <a class="ml-3" href="{{ route('rating.edit', $review->id) }}" title="Edit review"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <?php }
                    if (Auth::user()->can('delete_rating', $review)) { ?>
                        <a class="ml-2" type="submit" href="{{ route('rating.destroy', ['id' => $review->id]) }}" title="Delete review" onclick="return confirm('Are you sure you want to delete this review?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <?php }
                } ?>
            </p>
        </div>
        <div class="col-md-6">
            <p class="text-right"><?= $creationDate ?></p>
        </div>
    </div>
    <?php if ($review->updated_at > $review->created_at) { ?>
        <div class="row">
            <div class="col-md-12">
                <p style="margin-bottom: 0; font-size: 12px">Review updated at <?= $updateDate ?></p>
            </div>
        </div>
    <?php } ?>
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
