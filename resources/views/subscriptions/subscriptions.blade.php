<?php

use App\Models\Subscription;

?>

@extends('layouts.layout')

@section('title')
    - Subscriptions
@endsection

@section('content')
    <?= App\Utility\Utility::getBreadcrumbs() ?>

    <?php
    // Buttons
    $subscribeButton1 = 'Subscribe Now';
    $subscribeButton2 = 'Subscribe Now';
    $subscribeButton3 = 'Subscribe Now';
    $subscribeButton4 = 'Subscribe Now';
    $isDisabledButton1 = null;
    $isDisabledButton2 = null;
    $isDisabledButton3 = null;
    $isDisabledButton4 = null;
    $subscriptionType = null;
    if (Auth::check()) {
        if (!is_null(Auth::user()->subscription)) {
            $subscriptionType = Auth::user()->subscription->package_type;
            $subscribeButton1 = 'Upgrade';
            $subscribeButton2 = 'Upgrade';
            $subscribeButton3 = 'Upgrade';
            $subscribeButton4 = 'Upgrade';
            if ($subscriptionType >= Subscription::SUBSCRIPTION_TYPE_BRIGHT) {
                $subscribeButton1 = 'Subscribed';
                $isDisabledButton1 = 'disabled';
            }
            if ($subscriptionType >= Subscription::SUBSCRIPTION_TYPE_BRIGHT_PLUS) {
                $subscribeButton2 = 'Subscribed';
                $isDisabledButton2 = 'disabled';
            }
            if ($subscriptionType >= Subscription::SUBSCRIPTION_TYPE_VISIONARY) {
                $subscribeButton3 = 'Subscribed';
                $isDisabledButton3 = 'disabled';
            }
            if ($subscriptionType >= Subscription::SUBSCRIPTION_TYPE_MASTERMIND) {
                $subscribeButton4 = 'Subscribed';
                $isDisabledButton4 = 'disabled';
            }
        }
    }

    // Tooltip
    $tooltip = '';
    if (!Auth::check()) {
        $tooltip = 'data-toggle="tooltip" data-placement="bottom" title="You must be logged in to subscribe"';
    }
    ?>

    <form action="<?= route('subscription/payment') ?>" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="col-md-10 col-lg-8 m-auto">
            <h6 class="title mb-4"><i class="fa-solid fa-credit-card mr-2"></i>Subscriptions</h6>
            <p class="mb-5">This is what we offer, select the plan that you prefer and jump into the future 💯</p>
        </div>

        <div class="row">

                <!-- Bright Plan -->
                <div class="col-sm-3 bright-plan">
                    <div class="plan-card text-center">
                        <div class="plan-title">
                            <i class="fa fa-solid fa-fire"></i>
                            <h2 style="color: white"><?= Subscription::getSubscriptionName()[Subscription::SUBSCRIPTION_TYPE_BRIGHT] ?></h2>
                        </div>
                        <div class="plan-price">
                            <h4 style="color: white"><?= Subscription::getSubscriptionPrice()[Subscription::SUBSCRIPTION_TYPE_BRIGHT] ?></h4>
                        </div>
                        <div class="plan-options">
                            <ul>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>XR plots client</li>
                                <li class="not-included"><i class="fa fa-times mr-1" aria-hidden="true"></i>XR/VR glasses included</li>
                                <li class="not-included"><i class="fa fa-times mr-1" aria-hidden="true"></i>Creation of XR plots</li>
                                <li class="not-included"><i class="fa fa-times mr-1" aria-hidden="true"></i>Access to VR plots</li>
                            </ul>
                        </div>
                        <button class="<?= $isDisabledButton1 ? 'subscribed' : null ?>" <?= $tooltip ?> type="submit" name="type" value="<?= Subscription::SUBSCRIPTION_TYPE_BRIGHT ?>" title="Subscribe to Bright plan" <?= $isDisabledButton1 ?>><?= $subscribeButton1 ?></button>
                    </div>
                </div>

                <!-- Bright Plus Plan -->
                <div class="col-sm-3 bright-plus-plan">
                    <div class="plan-card text-center">
                        <div class="plan-title">
                            <i class="fa fa-solid fa-lightbulb"></i>
                            <h2 style="color: white"><?= Subscription::getSubscriptionName()[Subscription::SUBSCRIPTION_TYPE_BRIGHT_PLUS] ?></h2>
                        </div>
                        <div class="plan-price">
                            <h4 style="color: white"><sup>$</sup><?= Subscription::getSubscriptionPrice()[Subscription::SUBSCRIPTION_TYPE_BRIGHT_PLUS] ?>/m</h4>
                        </div>
                        <div class="plan-options">
                            <ul>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>XR plots client</li>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>Creation of XR plots</li>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>Google glasses ETP2</li>
                                <li class="not-included"><i class="fa fa-times mr-1" aria-hidden="true"></i>Access to VR plots</li>
                            </ul>
                        </div>
                        <button class="<?= $isDisabledButton2 ? 'subscribed' : null ?>" <?= $tooltip ?> type="submit" name="type" value="<?= Subscription::SUBSCRIPTION_TYPE_BRIGHT_PLUS ?>" title="Subscribe to Bright+ plan" <?= $isDisabledButton2 ?>><?= $subscribeButton2 ?></button>
                    </div>
                </div>

                <!-- Visionary Plan -->
                <div class="col-sm-3 visionary-plan">
                    <div class="plan-card text-center">
                        <div class="plan-title">
                            <i class="fa fa-bolt" aria-hidden="true"></i>
                            <h2 style="color: white"><?= Subscription::getSubscriptionName()[Subscription::SUBSCRIPTION_TYPE_VISIONARY] ?></h2>
                        </div>
                        <div class="plan-price">
                            <h4 style="color: white"><sup>$</sup><?= Subscription::getSubscriptionPrice()[Subscription::SUBSCRIPTION_TYPE_VISIONARY] ?>/m</h4>
                        </div>
                        <div class="plan-options">
                            <ul>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>XR/VR plots client</li>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>Creation of XR plots</li>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>Access to VR plots</li>
                                <li class="not-included"><i class="fa fa-times mr-1" aria-hidden="true"></i>XR/VR headset included</li>
                            </ul>
                        </div>
                        <button class="<?= $isDisabledButton3 ? 'subscribed' : null ?>" <?= $tooltip ?> type="submit" name="type" value="<?= Subscription::SUBSCRIPTION_TYPE_VISIONARY ?>" title="Subscribe to Visionary plan" <?= $isDisabledButton3 ?>><?= $subscribeButton3 ?></button>
                    </div>
                </div>

                <!-- Mastermind Plan -->
                <div class="col-sm-3 mastermind-plan">
                    <div class="plan-card text-center">
                        <div class="plan-title">
                            <i class="fa fa-rocket" aria-hidden="true"></i>
                            <h2 style="color: white"><?= Subscription::getSubscriptionName()[Subscription::SUBSCRIPTION_TYPE_MASTERMIND] ?></h2>
                        </div>
                        <div class="plan-price">
                            <h4 style="color: white"><sup>$</sup><?= Subscription::getSubscriptionPrice()[Subscription::SUBSCRIPTION_TYPE_MASTERMIND] ?>/m</h4>
                        </div>
                        <div class="plan-options">
                            <ul>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>XR/VR plots client</li>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>Creation of XR plots</li>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>Creation of VR plots</li>
                                <li><i class="fa fa-check mr-1" aria-hidden="true"></i>Meta quest pro</li>
                            </ul>
                        </div>
                        <button class="<?= $isDisabledButton4 ? 'subscribed' : null ?>" <?= $tooltip ?> type="submit" name="type" value="<?= Subscription::SUBSCRIPTION_TYPE_MASTERMIND ?>" title="Subscribe to Mastermind plan" <?= $isDisabledButton4 ?>><?= $subscribeButton4 ?></button>
                    </div>
                </div>


        </div>


        <div class="row mt-5">
            <div class="col-md-12">
                <h2><i class="fa fa-spinner mr-2" aria-hidden="true"></i>Our services</h2>
            </div>
        </div>
        <div class="row mt-4 text-left">
            <div class="col-md-12">
                <p><i class="fa-solid fa-caret-right mr-2"></i><strong>XR/VR Meeting Client: </strong> We offer a client with a very friendly UI, for both our XR and VR services, if you want to find out more about the differences in the technologies, check our section <a class="link-blue" href="/xr_vr" title="Go to XR & VR section"> XR & VR</a> 💻</p>
                <p><i class="fa-solid fa-caret-right mr-2"></i><strong>XR/VR Headsets: </strong> For both our packages "Bright+" and "Mastermind" we offer specific headsets. When it comes to XR we will provide you with the "Google glasses enterprise 2" and for the VR we will provide you with the "Metaquest pro". They are both part of the top tier XR/VR headsets currently present on the market 🥽</p>
                <p><i class="fa-solid fa-caret-right mr-2"></i><strong>XR/VR Plots: </strong> With Loki, you can be the owner and creator of your own virtual space, what we call plot! Plots can be created for both XR/VR and they allow the users (in particular for the VR one) to fully customize it and to make it fully unique. Certain packages however will only allow you to join plots of other people instead of creating your own 🌍</p>
                <!-- TODO -->
            </div>
        </div>

    </form>

@endsection
