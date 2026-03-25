<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta -->
<meta name="description" content="{{ env('APP_NAME') }} Administration">
<meta name="author" content="PouyaVaghefi">
<link rel="shortcut icon" href="{{ env('APP_URL') }}/{{ $bases['panelFavicon'] }}" type="image/x-icon">
<link rel="icon" href="{{ env('APP_URL') }}/{{ $bases['panelFavicon'] }}" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

<!-- Title -->
<title>{{ $bases['panelName'] ?? config('mng.title') }} - @yield('title')</title>


<!-- *************
    ************ Common Css Files *************
************ -->
<!-- Bootstrap css -->
<link rel="stylesheet" href="/css/bootstrap.min.css">

<!-- Icomoon Font Icons css -->
<link rel="stylesheet" href="/fonts/style.css">

<!-- Main css -->
<link rel="stylesheet" href="/css/main.css">


<!-- *************
    ************ Vendor Css Files *************
************ -->
<!-- DateRange css -->
<link rel="stylesheet" href="/vendor/daterange/daterange.css" />

<!-- Chartist css -->
<link rel="stylesheet" href="/vendor/chartist/css/chartist.min.css" />
<link rel="stylesheet" href="/vendor/chartist/css/chartist-custom.css" />

<!-- SweetAlert CSS & JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('styles')