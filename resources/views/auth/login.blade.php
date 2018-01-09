<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Muvee | Login</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    @include('partials.stylesheets')
</head>

<body class="login-page sidebar-collapse">
    <!-- Navbar -->
    
<!-- End Navbar -->
<div class="page-header" filter-color="orange">
    <div class="page-header-image" style="background-image:url(/img/login-bg.jpg)"></div>
    <div class="container">
        <div class="col-md-4 content-center">
            <div class="card card-login card-plain">
                <div class="header header-primary text-center">
                    <div class="logo-container">
                        <img src="../assets/img/now-logo.png" alt="">
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons users_circle-08"></i>
                            </span>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons text_caps-small"></i>
                            </span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Username" required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">Login</a>
                        </div>
                    </form>
                    <div class="">
                        <h6>
                            <a href="{{ route('register') }}" class="link">Create Account</a>
                        </h6>
                    </div>
                    {{-- <div class="pull-right">
                        <h6>
                            <a href="#pablo" class="link">Need Help?</a>
                        </h6>
                    </div> --}}
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Developed with Laravel
                </div>
            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->

@include('partials.scripts')
</html>