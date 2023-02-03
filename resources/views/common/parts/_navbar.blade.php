<nav class="page-navbar" data-spy="affix" data-offset-top="10">
    <ul class="nav-navbar container">
        <li class="nav-item">
            <a href="/xr_vr" class="nav-link hover-underline-animation" title="XR & VR">XR & VR</a>
        </li>
        <li class="nav-item">
            <a href="/why" class="nav-link hover-underline-animation" title="Why">Why</a>
        </li>
        <li class="nav-item">
            <a href="/subscription" class="nav-link hover-underline-animation" title="Subscriptions">Subscriptions</a>
        </li>
        <li class="nav-item">
            <a href="/" class="nav-link">
                <img class="logo" src="/img/logo.png" alt="Loki" title="Loki Homepage">
            </a>
        </li>
        <li class="nav-item">
            <a href="/marketplace" class="nav-link hover-underline-animation" title="Marketplace">Marketplace</a>
        </li>
        <li class="nav-item">
            <a href="<?= route('vr-plot') ?>" class="nav-link hover-underline-animation" target="_blank" title="VR Plot">VR Plot</a>
        </li>
        <?php
        if (Auth::check()) { ?>
            <li class="nav-item badge badge-pill badge-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-right: 10px; color: white">
                <a class="nav-link hover-underline-animation-logged link-login" style="padding-top: 2px; padding-bottom: 2px" title="<?= Auth::user()->name.' '.Auth::user()->surname ?>">
                    <img class="login-icon logged-profile-image" src="<?= Auth::user()->profilePhotoUrl ?>" alt="<?= Auth::user()->name ?>" style="color: white">
                    <span style="color: white"><?= Auth::user()->name; ?></span>
                </a>
            </li>
            <div class="dropdown-menu text-center" style="width: 174px" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/user/profile" title="Go to user section">My profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item" title="Logout">Logout</button>
                </form>
            </div>
        <?php } else { ?>
            <li class="nav-item badge badge-pill badge-secondary">
                <a href="/login" class="nav-link hover-underline-animation-login link-login" title="Login">
                    <img class="login-icon" src="/img/user-icon.png" alt="login"><span style="color: white">Login</span>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
