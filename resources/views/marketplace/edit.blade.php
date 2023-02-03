@extends('layouts.layout')

@section('title')
    - Edit item
@endsection

@section('content')
    <?= App\Utility\Utility::getBreadcrumbs() ?>

    <?= view('marketplace/parts/_form', ['marketplace' => $marketplace]) ?>
@endsection
