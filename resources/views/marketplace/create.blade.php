@extends('layouts.layout')

@section('title')
    - Create item
@endsection

@section('content')
    <?= App\Utility\Utility::getBreadcrumbs() ?>

    <?= view('marketplace/parts/_form'); ?>
@endsection
