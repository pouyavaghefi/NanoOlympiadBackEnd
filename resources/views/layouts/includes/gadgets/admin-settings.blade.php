<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Admin Edit Form -->
        <form method="POST" action="{{ route('adm.set.adm') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="panel_name">Panel Name</label>
                <input type="text" class="form-control" id="panel_name" name="panel_name"
                       placeholder="Enter Panel Name"
                       value="{{ old('panel_name', $settings['panelName'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="panel_logo">Panel Logo</label>
                <input type="file" class="form-control" id="panel_logo" name="panel_logo" accept="image/*">

                @if (!empty($settings['panelLogo']))
                <div class="mt-2">
                    <p><strong>Current Logo:</strong></p>
                    <img src="{{ asset($settings['panelLogo']) }}" alt="Panel Logo" style="max-width: 150px;">
                </div>
                @endif
            </div>

            <div class="form-group">
                <label for="panel_favicon">Panel Favicon (Browser Icon)</label>
                <input type="file" class="form-control" id="panel_favicon" name="panel_favicon" accept="image/x-icon,image/*">

                @if (!empty($settings['panelFavicon']))
                <div class="mt-2">
                    <p><strong>Current Favicon:</strong></p>
                    <img src="{{ asset($settings['panelFavicon']) }}" alt="Site Favicon" style="max-width: 50px;">
                </div>
                @endif
            </div>

            <!-- Allowed IP Addresses Section -->
            <div class="form-group mt-3">
                <label><strong>Allowed IP Addresses</strong></label>
                <div id="ip-container">
                    @foreach($allowedIps as $ip)
                    <div class="input-group mb-2 ip-entry">
                        <input type="text" name="allowed_ips[]" class="form-control" value="{{ $ip->ip }}" placeholder="Enter IP Address">
                        <button type="button" class="btn btn-danger remove-ip">−</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-warning" id="add-ip">+ Add IP</button>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>

<!-- JavaScript for Dynamic IP Input Management -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ipContainer = document.getElementById("ip-container");
        const addIpBtn = document.getElementById("add-ip");

        // Function to add a new IP input field
        addIpBtn.addEventListener("click", function () {
            const newIpInput = document.createElement("div");
            newIpInput.classList.add("input-group", "mb-2", "ip-entry");

            newIpInput.innerHTML = `
                <input type="text" name="allowed_ips[]" class="form-control" placeholder="Enter IP Address">
                <button type="button" class="btn btn-danger remove-ip">−</button>
            `;

            ipContainer.appendChild(newIpInput);
        });

        // Function to remove an IP input field
        ipContainer.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-ip")) {
                event.target.parentElement.remove();
            }
        });
    });
</script>
