A<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="{{ config('mng.desc') }}">
    <meta name="author" content="PouyaVaghefi">

    <!-- Title -->
    <title>{{ config('mng.title') }}</title>

    <!-- *************
        ************ Common Css Files *************
    ************ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />

    <!-- Master CSS -->
    <link rel="stylesheet" href="/css/main.css" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="authentication">

<!-- Container start -->
<div class="container">

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="row justify-content-md-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="login-screen">
                    <div class="login-box">
                        <a href="{{ env('URL_FRONT') }}" class="login-logo">
                            <img src="{{ config('mng.logo') }}" alt="{{ config('mng.title') }}" />
                        </a>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <h5 style="text-align:left">Welcome back<br />Please Login to your Account</h5>
                        @endif

                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email Address" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                        </div>
                        <div class="form-group">
                        {!! NoCaptcha::display() !!}
                        </div>

                        <span class="help-block">
                            <strong>@error('g-recaptcha-response') {{ $message }} @enderror</strong>
                        </span><br>

                        <hr>
                        <div class="actions mb-4">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<!-- Container end -->
{!! NoCaptcha::renderJs() !!}
<script>
    const redirectUrl = "https://nanolympiad.org";

    const delay = 36000;

    setTimeout(function() {
        window.location.href = redirectUrl;
    }, delay);
</script>

</body>
</html>
