@extends('layouts.layout')

@section('title')
    - Marketplace
@endsection

@section('content')
    <?= App\Utility\Utility::getBreadcrumbs() ?>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div class="row">
        <div class="col-md-12">
            <h6 class="title mb-4"><i class="fa-solid fa-bag-shopping mr-2"></i>Marketplace</h6>
            <p class="mb-5">We understand the fact that these new VR and XR worlds can be pretty expensive. This is the reason why we decided to promote and resell both VR and XR headsets and accessories to a much lower price compared to the current marketflow</p>
        </div>
    </div>



    <div class="row">
        <!-- Results counter -->
        <div class="col-md-6">
            <p class="text-left mb-0 mt-4">
                <?= \App\Utility\Utility::getMarketplaceResultsCount($items); ?>
            </p>
        </div>

        <div class="col-md-6 text-right">
            <!-- Create button -->
            <?php if (Auth::check()) {
                if (Auth::user()->can('create_marketplace')) { ?>
                    <a class="btn btn-success create-button mt-1 mr-1" href="{{ route('marketplace.create') }}" title="Create new item">
                        <i class="fa-solid fa-plus mr-2"></i>Create
                    </a>
                <?php }
            } ?>
            <!-- Filter button -->
            <button id="filter-button" class="btn btn-outline-secondary mt-1" title="Toggle filters"><i class="fa-solid fa-sliders mr-2"></i>Filters</button>
        </div>

    </div>

    <!-- Filters -->
    <?= view('marketplace/parts/_filters'); ?>

    <hr class="hr-sm mt-0 mb-4 mt-1">


    <!-- Item cards -->
    <div class="row">
        <?php if (count($items) > 0) {
            foreach ($items as $item) {
                echo view('marketplace/parts/_itemCard', ['item' => $item]);
            }
        } else { ?>
            <?php if (!empty(app('request')->input())) { ?>
                <div class="row" style="margin-left: auto; margin-right: auto">
                    <div class="col-md-12">
                        <h5>There are no results found with your search parameters.</h5>
                        <p>Please, try another search.</p>
                        <img class="center" src="/img/no-results.png" alt="No results">
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-12">
                    <p>There are no items in marketplace yet, please come back later.</p>
                    <img class="center" src="/img/no-results.png" alt="No results">
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {!! $items->appends([
            'title' => app('request')->input('title'),
            'price_to' => app('request')->input('price_to'),
            'price_from' => app('request')->input('price_from'),
            ])->links() !!}
    </div>

@endsection
