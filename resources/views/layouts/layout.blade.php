<!DOCTYPE html>
<html lang="en" id="html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Loki">
    <meta name="author" content="Loki Dev. Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Loki @yield('title')</title>

    <!-- Site Icon -->
    <link rel="icon" href="/img/favicon.png" type="image/x-icon">

    <!-- icons -->
    <link rel="stylesheet" href="/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <!-- Bootstrap + Style css -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Insert the blade containing the TinyMCE configuration and source script -->
    <x-head.tinymce-config/>

</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" class="dark-theme">

    <!-- Navbar -->
    <?= view('common/parts/_navbar'); ?>

    <!-- Theme selector -->
    <?= view('common/parts/_theme-selector'); ?>

    <!-- Header section -->
    @yield('header_content')

    <!-- Video modal -->
    @yield('video_modal')

    <!-- Page content -->
    <div class="container page-container py-0">
        @yield('content')
    </div>

    <!-- Contacts and footer container -->

    <?php
    $hideInDetailMarketplace = null;
    $paddedFooter = null;
    if (Route::getCurrentRoute()->getActionName() == 'App\Http\Controllers\MarketplaceController@show') {
        $hideInDetailMarketplace = 'style="display: none"';
        $paddedFooter = 'style="padding-top: 100px"';
    } ?>
    <hr class="hr-md hr-footer" <?= $hideInDetailMarketplace ?>>

    <div class="overlay"></div>
    <div class="container" <?= $paddedFooter ?>>

        <!-- Footer -->
        <?= view('common/parts/_footer') ?>

    </div>

    <!-- Jquery and Bootstrap  -->
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>--}}

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8= sha256-T+aPohYXbm0fRYDpJLr+zJ9RmYTswGsahAoIsNiMld4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- js cookie -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

    <!-- Font Awesome 6 -->
    <script src="https://kit.fontawesome.com/1c5d729ab7.js" crossorigin="anonymous"></script>

    <!-- bootstrap affix -->
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.affix.js"></script>--}}

    <!-- Script js -->
    <script src="/js/script.js"></script>
    <script src="/js/scrolling.js"></script>
    <script src="/js/rating.js"></script>
    <script src="/js/bootstrap.js"></script>

    <!-- Alert send mail js -->
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>

    <!-- TinyMCE -->
    {{--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>--}}
    {{--<script>tinymce.init({selector:'texteditor'});</script>--}}

</body>
</html>
