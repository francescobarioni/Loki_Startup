@extends('layouts.layout')

@section('title')
    - Payment Confirmed
@endsection

@section('content')
    <?= App\Utility\Utility::getBreadcrumbs() ?>

    <div class="row">
        <div class="col-md-12 text-center mt-3 mb-4">
            <img src="/img/checked.png" class="checked-payment-confirmed mb-4 mr-2" alt="checked" height="50px" width="50px">
            <strong style="font-size: 40px">Thank you for your subscription.</strong>
            <p>You are now successfully subscribed to <strong><?= \App\Models\Subscription::getSubscriptionName()[$sub_type] ?></strong> Loki plan. Enjoy your benefits!</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <a href="/" class="btn btn-success" title="Back to homepage">Back to homepage</a>
        </div>
    </div>
@endsection
