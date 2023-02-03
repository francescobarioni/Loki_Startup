<?php

$title = isset($marketplace) ? 'Edit item '.$marketplace->title : 'Create new item';
$titleValue = isset($marketplace) ? $marketplace->title : old('title');
$priceValue = isset($marketplace) ? $marketplace->price : old('price');
$descriptionValue = isset($marketplace) ? $marketplace->description : old('description');
$fullDescriptionValue = isset($marketplace) ? $marketplace->full_description : old('full_description');
$imageName = isset($marketplace) ? $marketplace->img_name : 'default.jpg';
$formAction = isset($marketplace) ? route('marketplace.update', $marketplace->id) : route('marketplace.store');
?>


<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <h6 class="title text-left mb-4"><?= $title ?></h6>
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

<form action="<?= $formAction ?>" method="POST" enctype="multipart/form-data">
    @csrf
    <?php if (isset($marketplace)) { ?>
        @method('PUT')
    <?php } ?>
    <div class="row">
        <!-- Title -->
        <div class="col-md-10">
            <div class="form-group">
                <h5 style="text-align: left">Title*</h5>
                <input type="text" name="title" class="form-control" maxlength="50" placeholder="Title..." value="<?= $titleValue ?>" required>
            </div>
        </div>
        <!-- Price -->
        <div class="col-md-2">
            <div class="form-group">
                <h5 style="text-align: left">Price*</h5>
                <input type="number" step="0.01" pattern="[0-9]+(\\.[0-9][0-9]?)?" name="price" class="form-control" placeholder="Price..." value="<?= $priceValue ?>" required>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Image -->
            <div class="col-md-4">
                <div class="form-group">
                    <h5 style="text-align: left">Image:</h5>
                    <input id="imageInput" type="file" class="form-control btn btn-secondary" name="image" style="padding-bottom: 35px">
                    <div id="imagePreviewContainer" class="row">
                        <div class="col-md-12">
                            <img id="imagePreview" class="rounded" src="/img/marketplace/<?= $imageName ?>" style="width: 100%; height: 225px; object-fit: fill">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Short description -->
            <div class="col-md-8">
                <div class="form-group">
                    <h5 style="text-align: left">Short description*</h5>
                    <textarea class="form-control" maxlength="350" style="height:280px" name="description" placeholder="Description..." required><?= $descriptionValue ?></textarea>
                </div>
            </div>
    </div>
    <!-- Full description -->
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h5 style="text-align: left">Full description*</h5>
                <texteditor name="full_description" id="full_description" placeholder="Full description..." required><?= $fullDescriptionValue ?></texteditor>
            </div>
        </div>
    </div>

    <div class="row text-left mt-3">
        <div class="col-md-12">
            <p>Fields marked with * are required.</p>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-12 text-left">
            <a class="btn btn-secondary mr-1" href="{{ route('marketplace.index') }}">Back</a>
            <button type="submit" class="btn btn-primary"><?= isset($marketplace) ? 'Save' : 'Create' ?></button>
        </div>
    </div>

</form>

<!-- Script js -->
<script src="/js/image-preview.js"></script>
