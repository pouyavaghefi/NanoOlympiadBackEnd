<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.cta.info') }}">
            @csrf

            <div class="form-group">
                <label for="cta_bg_image">Upload Background Image (1920x700)</label>
                <input type="file" class="form-control" id="cta_bg_image" name="cta_bg_image">
            </div>

            <div class="form-group">
                <label for="cta_title">CTA Title</label>
                <input type="text" class="form-control" id="cta_title" name="cta_title"
                       placeholder="Enter CTA title" value="{{ old('cta_title') ?? $static->where('name','cta_title')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="cta_description">CTA Description</label>
                <input type="text" class="form-control" id="cta_description" name="cta_description"
                       placeholder="Enter CTA description" value="{{ old('cta_description') ?? $static->where('name','cta_description')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="cta_button_name">CTA Button Name</label>
                <input type="text" class="form-control" id="cta_button_name" name="cta_button_name"
                       placeholder="Enter CTA button name" value="{{ old('cta_button_name') ?? $static->where('name','cta_button_name')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="cta_button_link">CTA Button Link</label>
                <input type="text" class="form-control" id="cta_button_link" name="cta_button_link"
                       placeholder="Enter CTA button link" value="{{ old('cta_button_link') ?? $static->where('name','cta_button_link')->first()->value ?? '' }}">
            </div>

            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
