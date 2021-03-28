<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" maximum-scale=1,
          user-scalable=no'>
    <link rel="shortcut icon" href="{{ url('img/favicon.png') }}">
    <title>Login | Student Daily Log</title>

    <link href="{{ url('bower_components/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ url('css/style-coreui.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/bima.css') }}" rel="stylesheet">
    <link href="{{ url('css/login.css') }}" rel="stylesheet">
</head>
<body>
<div class="background-image"></div>
<div id="particles-js"></div>
<div class="container">
    <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-10 offset-xs-1 vamiddle">
            <div class="login-card bg-text">
                <div class="card-block">
                    <div class="form-box" id="login-box">
                        <div id="bima-look">
                            <div id="head-look"></div>
                            <div id="hand-look"></div>
                        </div>
                        <h1 class="text-xs-center mt-3 mb-2" style="color: #464646; font-family:'gloss'; ">Daily Logbook </h1>
                        <h5 class="text-xs-center" style="color: #464646; font-family:'Quicksand'; margin-bottom:20px;">
                             Mutaba'ah Harian Santri Albinaa IBS
                        </h5>
                        <form class="form" action="{{ url('/login/santri/process') }}" method="post">
                            {{ csrf_field() }}
                            <div class="input-group mb-1">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control"  style="font-family: Quicksand" name="NIS" placeholder="NIS" required>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control"  style="font-family: Quicksand" name="password" placeholder="Password"
                                       required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <button  style="font-family: Quicksand" type="submit" class="btn btn-primary  px-2">Login</button>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 ">
                                    <button  style="font-family: Quicksand" type="button" onclick="swal('Hubungi Admin Kesantrian Albinaa IBS')"
                                             class="btn btn-link px-0 float-md-right">Forgot password?
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <br>
                                <p style="font-family: Quicksand; color: black" class="" ><strong>Kesantrian Albinaa IBS @ {{ \Carbon\Carbon::now()->year }}</strong></p>
{{--                                <a style="font-family: Quicksand" href="https://feylaboratory.xyz/sibima/"></a>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
            <span class="text-left m-r-1">
            Kesantrian Albinaa IBS © {{ \Carbon\Carbon::now()->year }}
            </span>
        {{--<span class="text-right">--}}
        {{--<a class="m-r-1" href="">About</a>--}}
        {{--<a class="m-r-1" href="">Terms</a>--}}
        {{--<a class="m-r-1" href="">Privacy</a>--}}
        {{--</span>--}}
    </footer>
</div>
<script src="{{ url("bower_components/jquery/dist/jquery.min.js")}}"></script>
<script>
    function verticalAlignMiddle() {
        var bodyHeight = $(window).height();
        var formHeight = $('.vamiddle').height();
        var marginTop = (bodyHeight / 2) - (formHeight / 2);
        if (marginTop > 0) {
            $('.vamiddle').css('margin-top', marginTop);
        }
    }
    verticalAlignMiddle();
    $(window).bind('resize', verticalAlignMiddle);
</script>
<script src="{{ url("bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<script src="{{ url("bower_components/pace/pace.min.js")}}"></script>
<script src="{{ url("bower_components/particles.js/particles.min.js") }}"></script>
<script src="{{ url("bower_components/sweetalert/dist/sweetalert.min.js") }}"></script>
<script>
    particlesJS.load('particles-js', '{{ url('config/particlesjs-config.json') }}', function () {
        console.log('callback - particles.js config loaded');
    });
</script>
</body>
</html>

