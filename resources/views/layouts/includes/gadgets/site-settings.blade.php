<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Admin Edit Form -->
        <form method="POST" action="{{ route('adm.set.site') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="site_name">Site Name</label>
                <input type="text" class="form-control" id="site_name" name="site_name"
                       placeholder="Enter Site Name"
                       value="{{ old('site_name', $settings['siteName'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="site_description">Site Description</label>
                <input type="text" class="form-control" id="site_description" name="site_description"
                       placeholder="Enter Site Description"
                       value="{{ old('site_description', $settings['siteDescription'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="site_owner">Site Owner</label>
                <input type="text" class="form-control" id="site_owner" name="site_owner"
                       placeholder="Enter Site Owner Name"
                       value="{{ old('site_owner', $settings['siteOwner'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="owner_url">Owner URL</label>
                <input type="url" class="form-control" id="owner_url" name="owner_url"
                       placeholder="Enter Owner URL"
                       value="{{ old('owner_url', $settings['ownerUrl'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="site_url">Site URL</label>
                <input type="url" class="form-control" id="site_url" name="site_url"
                       placeholder="Enter Site URL"
                       value="{{ old('site_url', $settings['siteUrl'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="subdomain1_url">Subdomain 1 URL</label>
                <input type="url" class="form-control" id="subdomain1_url" name="subdomain1_url"
                       placeholder="Enter Subdomain 1 URL"
                       value="{{ old('subdomain1_url', $settings['subdomain1Url'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="subdomain2_url">Subdomain 2 URL</label>
                <input type="url" class="form-control" id="subdomain2_url" name="subdomain2_url"
                       placeholder="Enter Subdomain 2 URL"
                       value="{{ old('subdomain2_url', $settings['subdomain2Url'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="site_logo">Site Logo</label>
                <input type="file" class="form-control" id="site_logo" name="site_logo" accept="image/*">

                @if (!empty($settings['siteLogo']))
                    <div class="mt-2">
                        <p><strong>Current Logo:</strong></p>
                        <img src="{{ asset($settings['siteLogo']) }}" alt="Site Logo" style="max-width: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="site_langs">Site Languages (Comma Separated)</label>
                <input type="text" class="form-control" id="site_langs" name="site_langs"
                       value="{{ $settings['siteLangs'] ?? '' }}">
            </div>

            <div class="form-group">
                <label for="site_favicon">Site Favicon (Browser Icon)</label>
                <input type="file" class="form-control" id="site_favicon" name="site_favicon" accept="image/x-icon,image/*">

                @if (!empty($settings['siteFavicon']))
                <div class="mt-2">
                    <p><strong>Current Favicon:</strong></p>
                    <img src="{{ asset($settings['siteFavicon']) }}" alt="Site Favicon" style="max-width: 50px;">
                </div>
                @endif
            </div>

            <div class="form-group mt-3">
                <label><strong>Site Visibility</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="site_coming_soon" id="show_coming_soon" value="coming_soon"
                           {{ isset($settings['siteVisibility']) && $settings['siteVisibility'] == 'coming_soon' ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_coming_soon">Show Coming Soon</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="site_coming_soon" id="hide_coming_soon" value="0"
                           {{ !isset($settings['siteVisibility']) || $settings['siteVisibility'] == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="hide_coming_soon">Do Not Show Coming Soon</label>
                </div>
            </div>

            <div class="form-group mt-3">
                <label><strong>Site Publication</strong></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="site_under_construction" id="site_under_construction" value="under_construction"
                            {{ isset($settings['sitePublication']) && $settings['sitePublication'] == 'under_construction' ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_under_construction">Site Under Construction</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="site_under_construction" id="hide_under_construction" value="0"
                            {{ !isset($settings['sitePublication']) || $settings['sitePublication'] == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="hide_under_construction">Site Published</label>
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

                    const underConstructionRadio = document.getElementById("site_under_construction");
                    const publishedRadio = document.getElementById("hide_under_construction");

                    const allowedIpSection = document.getElementById("allowed-ip-section");
                    const ipContainer = document.getElementById("ip-container");
                    const addIpBtn = document.getElementById("add-ip");

                    function toggleIpSection() {
                        if (comingSoonRadio.checked || underConstructionRadio.checked) {
                            allowedIpSection.style.display = "block";
                        } else {
                            allowedIpSection.style.display = "none";
                        }
                    }

                    comingSoonRadio.addEventListener("change", toggleIpSection);
                    hideComingSoonRadio.addEventListener("change", toggleIpSection);
                    underConstructionRadio.addEventListener("change", toggleIpSection);
                    publishedRadio.addEventListener("change", toggleIpSection);

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
                            e.target.closest(".input-group").remove();
                        }
                    });

                    toggleIpSection();
                });
            </script>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>
