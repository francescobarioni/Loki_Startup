@extends('layouts.layout')

@section('title')
    - Edit Review
@endsection

@section('content')
    <?= App\Utility\Utility::getBreadcrumbs() ?>

    <?= view('rating/parts/_form', ['rating' => $rating]) ?>
@endsection
