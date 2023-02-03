<form id="filter-form" action="<?= route('marketplace.index') ?>" method="GET" style="display: none">
    <div class="row text-left mt-4">
        <!-- Title -->
        <div class="col-md-6">
            <div class="form-group">
                <input class="form-control filter" type="search" name="title" id="title-filter" value="<?= app('request')->input('title') ?>" placeholder="Title...">
            </div>
        </div>
        <!-- Price from -->
        <div class="col-md-2">
            <div class="form-group">
                <input class="form-control filter" type="number" step="0.01" pattern="[0-9]+(\\.[0-9][0-9]?)?" name="price_from" id="price-from-filter" value="<?= app('request')->input('price_from') ?>" placeholder="Price from...">
            </div>
        </div>
        <!-- Price to -->
        <div class="col-md-2">
            <div class="form-group">
                <input class="form-control filter" type="number" step="0.01" pattern="[0-9]+(\\.[0-9][0-9]?)?" name="price_to" id="price-to-filter" value="<?= app('request')->input('price_to') ?>" placeholder="Price to...">
            </div>
        </div>

        <div class="col-md-2 text-right <!--filter-buttons-->">
            <a class="btn btn-outline-danger mr-1" href="<?= route('marketplace.index') ?>" title="Reset filters"><i class="fa-solid fa-xmark"></i></a>
            <button class="btn btn-primary" type="submit" title="Search" style="padding-left: 9px"><i class="fa-solid fa-magnifying-glass mr-2"></i>Search</button>
        </div>
    </div>
</form>
