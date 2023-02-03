<?php

use App\Models\Marketplace;
use App\Models\Rating;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('homepage', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', '/');
});

// Marketplace
Breadcrumbs::for('marketplace.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('homepage');
    $trail->push('Marketplace', route('marketplace.index'));
});

Breadcrumbs::for('marketplace.show', function (BreadcrumbTrail $trail, Marketplace $marketplace): void {
    $trail->parent('marketplace.index');
    $trail->push($marketplace->title, route('marketplace.show', $marketplace));
});

Breadcrumbs::for('marketplace.edit', function (BreadcrumbTrail $trail, Marketplace $marketplace): void {
    $trail->parent('marketplace.show', $marketplace);
    $trail->push('Edit', route('marketplace.edit', $marketplace));
});

Breadcrumbs::for('marketplace.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('marketplace.index');
    $trail->push('Create', route('marketplace.create'));
});

// Rating
Breadcrumbs::for('rating.edit', function (BreadcrumbTrail $trail, Rating $rating): void {
    $trail->parent('marketplace.index');
    $trail->push($rating->marketplace->title, '/marketplace/'.$rating->marketplace_id);
    $trail->push('Edit review', route('rating.edit', $rating));
});

// Payment marketplace
Breadcrumbs::for('marketplace/payment', function (BreadcrumbTrail $trail): void {
    $trail->parent('marketplace.index');
    // TODO
    $trail->push('Buy');
});
Breadcrumbs::for('marketplace/payment-success', function (BreadcrumbTrail $trail): void {
    $trail->parent('marketplace.index');
    // TODO
    $trail->push('Buy');
});

// XR VR
Breadcrumbs::for('xr_vr', function (BreadcrumbTrail $trail): void {
    $trail->parent('homepage');
    $trail->push('XR & VR', route('xr_vr'));
});

// Why
Breadcrumbs::for('why', function (BreadcrumbTrail $trail): void {
    $trail->parent('homepage');
    $trail->push('Why', route('why'));
});

// Subscriptions
Breadcrumbs::for('subscriptions', function (BreadcrumbTrail $trail): void {
    $trail->parent('homepage');
    $trail->push('Subscriptions', route('subscriptions'));
});
Breadcrumbs::for('subscription.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('homepage');
    $trail->push('Subscriptions', route('subscription.index'));
});
Breadcrumbs::for('subscription/payment', function (BreadcrumbTrail $trail): void {
    $trail->parent('subscription.index');
    $trail->push('Payment', route('subscription/payment'));
});
Breadcrumbs::for('subscription.store', function (BreadcrumbTrail $trail): void {
    $trail->parent('subscription.index');
    $trail->push('Payment', route('subscription.store'));
});

// Payment
Breadcrumbs::for('payment', function (BreadcrumbTrail $trail): void {
    $trail->parent('subscriptions');
    $trail->push('Payment', route('payment'));
});

// Payment confirmed
Breadcrumbs::for('payment_confirmed', function (BreadcrumbTrail $trail): void {
    $trail->parent('subscriptions');
    $trail->push('Payment', route('payment_confirmed'));
});
