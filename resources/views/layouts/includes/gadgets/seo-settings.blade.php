<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.set.seo') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" class="form-control" id="meta_title" name="meta_title"
                       placeholder="Enter Meta Title"
                       value="{{ old('meta_title', $seoSettings['meta_title'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea class="form-control" id="meta_description" name="meta_description"
                          placeholder="Enter Meta Description">{{ old('meta_description', $seoSettings['meta_description'] ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="meta_keywords">Meta Keywords</label>
                <textarea class="form-control" id="meta_keywords" name="meta_keywords"
                          placeholder="Enter Meta Keywords (comma-separated)">{{ old('meta_keywords', $seoSettings['meta_keywords'] ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="canonical_url">Canonical URL</label>
                <input type="url" class="form-control" id="canonical_url" name="canonical_url"
                       placeholder="Enter Canonical URL"
                       value="{{ old('canonical_url', $seoSettings['canonical_url'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="og_title">OG Title</label>
                <input type="text" class="form-control" id="og_title" name="og_title"
                       placeholder="Enter OG Title"
                       value="{{ old('og_title', $seoSettings['og_title'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="og_description">OG Description</label>
                <textarea class="form-control" id="og_description" name="og_description"
                          placeholder="Enter OG Description">{{ old('og_description', $seoSettings['og_description'] ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="og_image">OG Image</label>
                <input type="file" class="form-control" id="og_image" name="og_image" accept="image/*">

                @if (!empty($seoSettings['og_image']))
                    <div class="mt-2">
                        <p><strong>Current OG Image:</strong></p>
                        <img src="{{ asset($seoSettings['og_image']) }}" alt="OG Image" style="max-width: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="twitter_title">Twitter Title</label>
                <input type="text" class="form-control" id="twitter_title" name="twitter_title"
                       placeholder="Enter Twitter Title"
                       value="{{ old('twitter_title', $seoSettings['twitter_title'] ?? '') }}">
            </div>

            <div class="form-group">
                <label for="twitter_description">Twitter Description</label>
                <textarea class="form-control" id="twitter_description" name="twitter_description"
                          placeholder="Enter Twitter Description">{{ old('twitter_description', $seoSettings['twitter_description'] ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="twitter_image">Twitter Image</label>
                <input type="file" class="form-control" id="twitter_image" name="twitter_image" accept="image/*">

                @if (!empty($seoSettings['twitter_image']))
                    <div class="mt-2">
                        <p><strong>Current Twitter Image:</strong></p>
                        <img src="{{ asset($seoSettings['twitter_image']) }}" alt="Twitter Image" style="max-width: 150px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="robots">Robots Directive</label>
                <select class="form-control" id="robots" name="robots">
                    <option value="index, follow" {{ old('robots', $seoSettings['robots'] ?? '') == 'index, follow' ? 'selected' : '' }}>Index, Follow</option>
                    <option value="noindex, follow" {{ old('robots', $seoSettings['robots'] ?? '') == 'noindex, follow' ? 'selected' : '' }}>No Index, Follow</option>
                    <option value="noindex, nofollow" {{ old('robots', $seoSettings['robots'] ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>No Index, No Follow</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>
