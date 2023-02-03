<?php
use App\Models\Subscription;

$marketplace = DB::table('marketplace')->where('id', '=', $marketplace_id)->first();

?>

@extends('layouts.layout')

@section('title')
    - Buy <?= $marketplace->title ?>
@endsection

@section('content')

    <?= App\Utility\Utility::getBreadcrumbs() ?>



    <h1>Buy <?= $marketplace->title ?></h1>

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


    <div class="row">

        <!-- Form -->
        <div class="col-md-6">
            <form action="<?= route('marketplace/payment-success') ?>" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to confirm your payment for <?= $marketplace->title ?>?')">
            @csrf
                <div class="form-group">

                    <div class="row">
                        <div class="col-md-12">
                            <p class="mb-1 text-left">Full name*</p>
                            <input class="form-control" id="fullname" name="fullname" maxlength="23" type="text" placeholder="First name..." required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1 text-left">Card Number*</p>
                            <span id="generatecard" style="display: none">generate random</span>
                            <input class="form-control" id="cardnumber" name="cc_number" type="tel" inputmode="numeric"
                                   pattern="[0-9\s]{13,19}" autocomplete="cc-number" placeholder="xxxx xxxx xxxx xxxx" required>
                            <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink">
                            </svg>
                        </div>

                        <div class="col-md-3">
                            <p class="mb-1 text-left">Expiration*</p>
                            <input class="form-control" id="expirationdate" name="expiration" type="text" pattern="(?:0[1-9]|1[0-2])/[0-9]{2}"
                                   inputmode="numeric" placeholder="01/23" required>
                        </div>

                        <div class="col-md-3">
                            <p class="mb-1 text-left">Security Code*</p>
                            <input class="form-control" id="securitycode" name="security_code" type="text" pattern="[0-9]*" inputmode="numeric"
                                   placeholder="000" maxlength="3" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-1 text-left">Country*</p>
                            <input class="form-control" id="country" name="country" maxlength="20" type="text" placeholder="Country..." required>
                        </div>

                        <div class="col-md-4">
                            <p class="mb-1 text-left">City*</p>
                            <input class="form-control" id="city" name="city" maxlength="20" type="text" placeholder="City..." required>
                        </div>

                        <div class="col-md-4">
                            <p class="mb-1 text-left">Province*</p>
                            <input class="form-control" id="province" name="province" maxlength="20" type="text" placeholder="Province..." required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <p class="mb-1 text-left">Address*</p>
                            <input class="form-control" id="address" name="address" maxlength="40" type="text" placeholder="Address..." required>
                        </div>

                        <div class="col-md-4">
                            <p class="mb-1 text-left">Postal code*</p>
                            <input class="form-control" id="postal-code" name="postal_code" maxlength="10" type="number" placeholder="Postal code..." required>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="<?= Auth::user()->id ?>">
                    <input type="hidden" name="item_id" value="<?= $marketplace_id ?>">
                </div>

                <div class="row">
                    <div class="col-md-5 text-left">
                        <a class="btn btn-secondary mr-1" title="Go back to <?= $marketplace->title ?>" href="/marketplace/<?= $marketplace->id ?>">Back</a>
                        <button type="submit" class="btn btn-primary" title="Buy <?= $marketplace->title ?> for $<?= $marketplace->price ?>"><i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i>Buy</button>
                    </div>
                    <div class="col-md-7 text-right mt-1">
                        <span class="badge badge-pill badge-warning" style="font-size: 20px">$<?= $marketplace->price ?></span>
                    </div>
                </div>

            </form>
        </div>

        <!-- Credit card -->
        <div class="col-md-6">
            <?= view('marketplace/parts/_credit-card'); ?>
        </div>

    </div>


    <!-- JS -->
    <script src="/js/payment.js"></script>
    <script defer="" src="https://unpkg.com/imask"></script>

@endsection
