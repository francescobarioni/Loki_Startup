<?php
/**
 * DEPRECATED VIEW
 */
?>

@extends('layouts.layout')

@section('title')
    - Login
@endsection

@section('header_content')
    <header class="header">
        <div class="overlay"></div>
        <div class="header-content">
            <div class="form-box">
                <div class="row">
                    <div class="header-text col-md-12">
                        <h2>Login</h2>
                    </div>
                </div>
                <!-- Email or username -->
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-left" style="margin: 0">Email or username:</p>
                        <input class="form-login" placeholder="Your email/username..." type="email">
                    </div>
                </div>
                <!-- Password -->
                <div class="row">
                    <div class="col-md-12 text-left">
                        <p style="margin: 0">Password:</p>
                        <input class="form-login" placeholder="Your password..." type="password">
                        <p>Forgot your password? Click <strong><a href="#">here</a></strong></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" style="width: 30%"><strong>LOGIN</strong></button>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 text-left">
                        <p>If you don't have an account yet, click <strong><a href="#">here</a></strong> to sign up</p>
                    </div>
                </div>

            </div>
        </div>
    </header>
@endsection
