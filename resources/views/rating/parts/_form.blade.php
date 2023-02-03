<?php
$checked = 'checked="checked"';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <h6 class="title text-left mb-4">Edit review</h6>
            </div>
        </div>
    </div>
</div>

<?php if ($errors->any()) { ?>
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
<?php } ?>

<form action="<?= route('rating.update', $rating->id) ?>" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- Vote -->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <h5 style="text-align: left">Your vote*</h5>
                <div class="stars-input" style="margin-left: -15px">
                    <input class="star star-5" <?= $rating->value == 5 ? $checked : null ?> id="star-5" type="radio" name="value" value="5"/>
                    <label class="star star-5" for="star-5"></label>
                    <input class="star star-4" <?= $rating->value == 4 ? $checked : null ?> id="star-4" type="radio" name="value" value="4"/>
                    <label class="star star-4" for="star-4"></label>
                    <input class="star star-3" <?= $rating->value == 3 ? $checked : null ?> id="star-3" type="radio" name="value" value="3"/>
                    <label class="star star-3" for="star-3"></label>
                    <input class="star star-2" <?= $rating->value == 2 ? $checked : null ?> id="star-2" type="radio" name="value" value="2"/>
                    <label class="star star-2" for="star-2"></label>
                    <input class="star star-1" <?= $rating->value == 1 ? $checked : null ?> id="star-1" type="radio" name="value" value="1"/>
                    <label class="star star-1" for="star-1"></label>
                </div>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h5 style="text-align: left">Description</h5>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Description..."><?= $rating->description ?></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-left">
            <a class="btn btn-secondary mr-1" href="<?= url()->previous() ?>">Back</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>

</form>
