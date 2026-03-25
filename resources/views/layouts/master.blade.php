<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.includes.init.head')
    @yield('styles')
</head>
<body>

<!-- Loading starts -->
{{--@include('layouts.includes.parsers.loading')--}}
<!-- Loading ends -->


<!-- *************
    ************ Header section start *************
************* -->

<!-- Header start -->
@include('layouts.includes.header')
<!-- Header end -->

<!-- Screen overlay start -->
<div class="screen-overlay"></div>
<!-- Screen overlay end -->

<!-- Quicklinks box start -->
<!-- Quicklinks box end -->

<!-- Quick settings start -->
<!-- Quick settings end -->

<!-- *************
    ************ Header section end *************
************* -->

<!-- Container fluid start -->
<div class="container-fluid">

    <!-- Navigation start -->
    @include('layouts.includes.overall.navigation')
    <!-- Navigation end -->

    <!-- *************
        ************ Main container start *************
    ************* -->
    <div class="main-container">

        <!-- Page header start -->
        <div class="page-header">
            @include('layouts.includes.parsers.breadcrumb')

{{--            @include('layouts.includes.parsers.app-actions')--}}
        </div>
        <!-- Page header end -->

        <!-- Content wrapper start -->
        <div class="content-wrapper">

            @yield('wrapper')

        </div>
        <!-- Content wrapper end -->

    </div>
    <!-- *************
        ************ Main container end *************
    ************* -->

    <!-- Footer start -->
    @include('layouts.includes.footer')
    <!-- Footer end -->

</div>
<!-- Container fluid end -->

@include('layouts.includes.init.scripts')
@yield('scripts')

<script>
    let logoutTimer;
    const maxInactivity = 10 * 60 * 1000; // 10 minutes in milliseconds

    const resetTimer = () => {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(() => {
            fetch('/logout-due-to-inactivity', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then(() => {
                window.location.href = '/login?reason=inactive';
            });
        }, maxInactivity);
    };

    ['mousemove', 'keydown', 'scroll', 'touchstart'].forEach(evt => {
        window.addEventListener(evt, resetTimer);
    });

    resetTimer(); // Initial call
</script>
</body>
</html>
