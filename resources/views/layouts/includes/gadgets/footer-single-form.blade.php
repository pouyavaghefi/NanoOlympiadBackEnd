<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.footer') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="footer_logo">Footer Logo</label>
                <input type="file" class="form-control" id="footer_logo" name="footer_logo">

                @if($static->where('name', 'footer_logo')->first() && $static->where('name', 'footer_logo')->first()->value)
                    <div class="mt-3">
                        <label>Current Footer Logo:</label>
                        <br>
                        <img src="{{ asset($static->where('name', 'footer_logo')->first()->value) }}" alt="Current Footer Logo" style="max-width: 200px; max-height: 200px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="footer_description">Footer Description</label>
                <input type="text" class="form-control" id="footer_description" name="footer_description"
                       placeholder="Footer description" value="{{ old('footer_description') ?? ($static->where('name', 'footer_description')->first() ? $static->where('name', 'footer_description')->first()->value : '') }}">
            </div>

            <div class="form-group">
                <label for="footer_email">Footer Contact Email Address</label>
                <input type="email" class="form-control" id="footer_email" name="footer_email"
                       placeholder="Contact email address" value="{{ old('footer_email') ?? ($static->where('name', 'footer_email')->first() ? $static->where('name', 'footer_email')->first()->value : '') }}">
            </div>

            <div class="form-group">
                <input type="checkbox" class="form-check-input" id="footer_links" name="footer_links"
                        {{ old('footer_links') ?? ($static->where('name', 'footer_links')->first() && $static->where('name', 'footer_links')->first()->value == 'on' ? 'checked' : '') }}>
                <label for="footer_links">Show Footer Links</label>
            </div>

            <div class="form-group">
                <input type="checkbox" class="form-check-input" id="newsletter_enabled" name="newsletter_enabled"
                        {{ old('newsletter_enabled') ?? ($static->where('name', 'newsletter_enabled')->first() && $static->where('name', 'newsletter_enabled')->first()->value == 'on' ? 'checked' : '') }}>
                <label for="newsletter_enabled">Show Newsletter</label>
            </div>

            <div class="form-group">
                <label for="newsletter_description">Newsletter Description</label>
                <input type="text" class="form-control" id="newsletter_description" name="newsletter_description"
                       placeholder="Newsletter description" value="{{ old('newsletter_description') ?? ($static->where('name', 'newsletter_description')->first() ? $static->where('name', 'newsletter_description')->first()->value : '') }}">
            </div>

            <div class="form-group">
                <label for="newsletter_button_label">Newsletter Button Label</label>
                <input type="text" class="form-control" id="newsletter_button_label" name="newsletter_button_label"
                       placeholder="Newsletter button label" value="{{ old('newsletter_button_label') ?? ($static->where('name', 'newsletter_button_label')->first() ? $static->where('name', 'newsletter_button_label')->first()->value : '') }}">
            </div>

            <div class="form-group">
                <label for="newsletter_button_icon">Newsletter Button Icon</label>
                <input type="text" class="form-control" id="newsletter_button_icon" name="newsletter_button_icon"
                       placeholder="Newsletter button icon" value="{{ old('newsletter_button_icon') ?? ($static->where('name', 'newsletter_button_icon')->first() ? $static->where('name', 'newsletter_button_icon')->first()->value : '') }}">
            </div>

            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a class="btn btn-link" href="https://fontawesome.com/icons" target="_blank">Browse Icons</a>
            </div>
        </form>
    </div>
</div>
