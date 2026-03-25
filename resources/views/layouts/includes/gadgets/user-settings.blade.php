<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Admin Edit Form -->
        <form method="POST" action="{{ route('adm.set.usr') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="dashboard_name">Panel Name</label>
                <input type="text" class="form-control" id="dashboard_name" name="dashboard_name"
                       placeholder="Enter Dashboard Name"
                       value="{{ old('dashboard_name', $settings['dashName'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="dashboard_logo">Panel Logo</label>
                <input type="file" class="form-control" id="dashboard_logo" name="dashboard_logo" accept="image/*">

                @if (!empty($settings['dashLogo']))
                <div class="mt-2">
                    <p><strong>Current Logo:</strong></p>
                    <img src="{{ asset($settings['dashLogo']) }}" alt="Panel Logo" style="max-width: 150px;">
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="dashboard_favicon">Panel Favicon (Browser Icon)</label>
                <input type="file" class="form-control" id="dashboard_favicon" name="dashboard_favicon" accept="image/x-icon,image/*">

                @if (!empty($settings['dashFavicon']))
                <div class="mt-2">
                    <p><strong>Current Favicon:</strong></p>
                    <img src="{{ asset($settings['dashFavicon']) }}" alt="Dashboard Favicon" style="max-width: 50px;">
                </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>
