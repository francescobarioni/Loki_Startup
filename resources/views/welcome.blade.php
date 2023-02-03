@extends('layouts.layout')

@section('title')
    - Home
@endsection

<!-- Header -->
@section('header_content')
    <?= view('welcome/parts/_header'); ?>
@endsection

<!-- Video modal -->
@section('video_modal')
    <?= view('welcome/parts/_video-modal'); ?>
@endsection

<!-- Page content -->
@section('content')
    <!-- Introduction -->
    <?= view('welcome/parts/_intro'); ?>

    <!-- Experience -->
    <?= view('welcome/parts/_experience'); ?>

@endsection



