<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Admin Edit Form -->
        <form method="POST" action="{{ route('adm.set.langs.ar') }}">
            @csrf

            <div class="form-group">
                <label for="site_name">Arabic Site Name</label>
                <input type="text" class="form-control" id="ar_site_name" name="site_name"
                       placeholder="Enter Site Name"
                       value="{{ old('site_name', $settings['arSiteName'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="site_description">Site Description</label>
                <input type="text" class="form-control" id="site_description" name="site_description"
                       placeholder="Enter Site Description"
                       value="{{ old('site_description', $settings['arSiteDescription'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="site_owner">Site Owner</label>
                <input type="text" class="form-control" id="site_owner" name="site_owner"
                       placeholder="Enter Site Owner Name"
                       value="{{ old('site_owner', $settings['arSiteOwner'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="owner_url">Owner URL</label>
                <input type="url" class="form-control" id="owner_url" name="owner_url"
                       placeholder="Enter Owner URL"
                       value="{{ old('owner_url', $settings['arOwnerUrl'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="site_url">Site URL</label>
                <input type="url" class="form-control" id="site_url" name="site_url"
                       placeholder="Enter Site URL"
                       value="{{ old('site_url', $settings['arSiteUrl'] ?? '') }}">
            </div>

            <div class="form-group mt-3">
                <label><strong>Site Visibility</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="site_coming_soon" id="show_coming_soon" value="coming_soon"
                            {{ isset($settings['arSiteVisibility']) && $settings['arSiteVisibility'] == 'coming_soon' ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_coming_soon">Show Coming Soon</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="site_coming_soon" id="hide_coming_soon" value="0"
                            {{ !isset($settings['arSiteVisibility']) || $settings['arSiteVisibility'] == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="hide_coming_soon">Do Not Show Coming Soon</label>
                </div>
            </div>

            <!-- Allowed IP Addresses Section (Only Show When Coming Soon is Selected) -->
            <div id="allowed-ip-section" class="mt-3" style="display: none;">
                <label><strong>Allowed IP Addresses</strong></label>
                <div id="ip-container">
                    @foreach($allowedIps as $ip)
                        <div class="input-group mb-2">
                            <input type="text" name="allowed_ips[]" class="form-control" value="{{ $ip->ip }}" placeholder="Enter IP Address">
                            <button type="button" class="btn btn-danger remove-ip">−</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-warning" id="add-ip">+ Add IP</button>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const comingSoonRadio = document.getElementById("show_coming_soon");
                    const hideComingSoonRadio = document.getElementById("hide_coming_soon");
                    const allowedIpSection = document.getElementById("allowed-ip-section");
                    const ipContainer = document.getElementById("ip-container");
                    const addIpBtn = document.getElementById("add-ip");

                    function toggleIpSection() {
                        allowedIpSection.style.display = comingSoonRadio.checked ? "block" : "none";
                    }

                    comingSoonRadio.addEventListener("change", toggleIpSection);
                    hideComingSoonRadio.addEventListener("change", toggleIpSection);

                    addIpBtn.addEventListener("click", function () {
                        const ipInput = document.createElement("div");
                        ipInput.classList.add("input-group", "mb-2");
                        ipInput.innerHTML = `
            <input type="text" name="allowed_ips[]" class="form-control" placeholder="Enter IP Address">
            <button type="button" class="btn btn-danger remove-ip">−</button>
        `;
                        ipContainer.appendChild(ipInput);
                    });

                    ipContainer.addEventListener("click", function (e) {
                        if (e.target.classList.contains("remove-ip")) {
                            e.target.parentElement.remove();
                        }
                    });

                    toggleIpSection();
                });
            </script>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>
