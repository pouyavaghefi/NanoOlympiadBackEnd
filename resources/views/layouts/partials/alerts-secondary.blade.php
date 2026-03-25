@if (Session::has('success'))
    <a href=""
       class="btn btn-success btn-sm"
       data-toggle="tooltip"
       data-placement="top"
       title="Success">
        <i class="fa fa-check-circle"></i> {{ Session::get('success') }}
    </a>
@endif

@if (Session::has('warning'))
    <a href=""
       class="btn btn-warning btn-sm"
       data-toggle="tooltip"
       data-placement="top"
       title="Warning">
        <i class="fa fa-exclamation-circle"></i> {{ Session::get('warning') }}
    </a>
@endif

@if (Session::has('error'))
    <a href=""
       class="btn btn-danger btn-sm"
       data-toggle="tooltip"
       data-placement="top"
       title="Error">
        <i class="fa fa-times-circle"></i> {{ Session::get('error') }}
    </a>
@endif

@if (Session::has('info'))
    <a href=""
       class="btn btn-info btn-sm"
       data-toggle="tooltip"
       data-placement="top"
       title="Info">
        <i class="fa fa-info-circle"></i> {{ Session::get('info') }}
    </a>
@endif