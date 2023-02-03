@extends('layouts.layout')

@section('title')
    - Why
@endsection

@section('content')
    <?= App\Utility\Utility::getBreadcrumbs() ?>

    <?= view('why/parts/_why'); ?>
@endsection
