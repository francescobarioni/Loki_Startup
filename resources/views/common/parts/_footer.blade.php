<footer class="footer">
    <div class="container" style="width: 100%">
        <div class="row">
            <div class="col-md-6">
                <h5 style="margin-left: -5px"><i class="fa-solid fa-bolt mr-1"></i>LOKI</h5>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="/xr_vr" title="Go to the XR & VR section">XR & VR</a></li>
                            <li><a href="/why" title="Go to the Why section">Why</a></li>
                            <li><a href="/subscription" title="Go to the Subscriptions section">Subscriptions</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><a href="/marketplace" title="Go to the Marketplace section">Marketplace</a></li>
                            <li><a href="<?= route('vr-plot') ?>" target="_blank" title="Go to the VR Plot section">Loki VR Plot</a></li>
                            <li><a href="/login" title="Go to the Login section">Login</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item"><a href="#" class="nav-link nav-link-social pl-0" target="_blank" title="Follow us on Facebook"><i class="fa fa-facebook fa-lg"></i></a></li>
                    <li class="nav-item"><a href="#" class="nav-link nav-link-social" target="_blank" title="Follow us on Twitter"><i class="fa fa-twitter fa-lg"></i></a></li>
                    <li class="nav-item"><a href="https://github.com/Loki-Dev-Team/Loki" target="_blank" class="nav-link nav-link-social" title="Follow us on Github"><i class="fa fa-github fa-lg"></i></a></li>
                    <li class="nav-item"><a href="#" class="nav-link nav-link-social" target="_blank" title="Follow us on Instagram"><i class="fa fa-instagram fa-lg"></i></a></li>
                </ul>
                <br>
            </div>
            <div class="col-md-6">
                <h5><i class="fa-solid fa-envelope mr-2"></i>CONTACT US</h5>
                <form action="{{route('sendmail')}}" method="POST">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-10">
                            <input name="name" class="form-control" placeholder="Enter your name...">
                        </div>
                        <!--<div class="col-md-10">
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>-->
                    </div>
                    <div class="row form-group">
                        <div class="col-md-10">
                            <textarea name="message" class="form-control" id="exampleMessage" placeholder="Enter your message..."></textarea>
                        </div>
                        <div class="col-md-2" style="margin-top: 33px">
                            <button type="submit" name="send" class="btn btn-secondary" title="Send us an email" style="width: 135%">Send<i class="fa-solid fa-paper-plane ml-1"></i></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>© <script>document.write(new Date().getFullYear())</script> - All rights reserved | Made with <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"><i class="ti-heart text-danger"></i></a> by Loki Dev. Team</p>
            </div>
        </div>
    </div>
</footer>
