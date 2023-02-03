@extends('layouts.layout')

@section('title')
    - Payment Confirmed
@endsection

@section('content')
    <?= App\Utility\Utility::getBreadcrumbs() ?>

    <?php $marketplace = DB::table('marketplace')->where('id', '=', $item_id)->first(); ?>

    <div class="row">
        <div class="col-md-12 text-center mt-3 mb-4">
            <img src="/img/checked.png" class="checked-payment-confirmed mb-4 mr-2" alt="checked" height="50px" width="50px">
            <strong style="font-size: 40px">Thank you for purchasing <?= $marketplace->title ?>.</strong>
        </div>
    </div>

    <p>We have taken charge of your order. <?= $marketplace->title ?> will be sent soon.</p>
    <p>Copy Order ID below to track your shipping.</p>
    <p><strong>ORDER ID: </strong><?= \App\Utility\Utility::generateOrderId() ?></p>
    <p>Remember to leave us a review for this item <a class="payment" href="<?= route('marketplace.show', $marketplace->id) ?>" title="Go to <?= $marketplace->title ?> page">here</a>. You will help us and other users.</p>

    <div class="row">
        <div class="col-md-12 text-center mt-2">
            <a href="/marketplace" class="btn btn-success" title="Back to Marketplace">Back to Marketplace</a>
        </div>
    </div>
@endsection
