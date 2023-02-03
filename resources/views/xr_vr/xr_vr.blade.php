@extends('layouts.layout')

@section('title')
    - XR & VR
@endsection

@section('content')
    <?= App\Utility\Utility::getBreadcrumbs() ?>

    <?= view('xr_vr/parts/_xr_vr'); ?>
@endsection
