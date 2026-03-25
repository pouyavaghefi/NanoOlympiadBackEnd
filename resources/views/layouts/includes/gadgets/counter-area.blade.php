<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.counter.info') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="counter_box_one_title">1st Counter Title</label>
                <input type="text" class="form-control" id="counter_box_one_title" name="counter_box_one_title"
                       placeholder="Enter 1st counter title" value="{{ old('counter_box_one_title') ?? $static->where('name','counter_box_one_title')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_one_value">1st Counter Value</label>
                <input type="text" class="form-control" id="counter_box_one_value" name="counter_box_one_value"
                       placeholder="Enter 1st counter value" value="{{ old('counter_box_one_value') ?? $static->where('name','counter_box_one_value')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_one_icon">1st Counter Icon</label>
                <input type="text" class="form-control" id="counter_box_one_icon" name="counter_box_one_icon"
                       placeholder="Enter 1st counter icon" value="{{ old('counter_box_one_icon') ?? $static->where('name','counter_box_one_icon')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_two_title">2nd Counter Title</label>
                <input type="text" class="form-control" id="counter_box_two_title" name="counter_box_two_title"
                       placeholder="Enter 2nd counter title" value="{{ old('counter_box_two_title') ?? $static->where('name','counter_box_two_title')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_two_value">2nd Counter Value</label>
                <input type="text" class="form-control" id="counter_box_two_value" name="counter_box_two_value"
                       placeholder="Enter 2nd counter value" value="{{ old('counter_box_two_value') ?? $static->where('name','counter_box_two_value')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_two_icon">2nd Counter Icon</label>
                <input type="text" class="form-control" id="counter_box_two_icon" name="counter_box_two_icon"
                       placeholder="Enter 2nd counter icon" value="{{ old('counter_box_two_icon') ?? $static->where('name','counter_box_two_icon')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_three_title">3rd Counter Title</label>
                <input type="text" class="form-control" id="counter_box_three_title" name="counter_box_three_title"
                       placeholder="Enter 3rd counter title" value="{{ old('counter_box_three_title') ?? $static->where('name','counter_box_three_title')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_three_value">3rd Counter Value</label>
                <input type="text" class="form-control" id="counter_box_three_value" name="counter_box_three_value"
                       placeholder="Enter 3rd counter value" value="{{ old('counter_box_three_value') ?? $static->where('name','counter_box_three_value')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_three_icon">3rd Counter Icon</label>
                <input type="text" class="form-control" id="counter_box_three_icon" name="counter_box_three_icon"
                       placeholder="Enter 3rd counter icon" value="{{ old('counter_box_three_icon') ?? $static->where('name','counter_box_three_icon')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_four_title">4th Counter Title</label>
                <input type="text" class="form-control" id="counter_box_four_title" name="counter_box_four_title"
                       placeholder="Enter 4th counter title" value="{{ old('counter_box_four_title') ?? $static->where('name','counter_box_four_title')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_four_value">4th Counter Value</label>
                <input type="text" class="form-control" id="counter_box_four_value" name="counter_box_four_value"
                       placeholder="Enter 4th counter value" value="{{ old('counter_box_four_value') ?? $static->where('name','counter_box_four_value')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_four_icon">4th Counter Icon</label>
                <input type="text" class="form-control" id="counter_box_four_icon" name="counter_box_four_icon"
                       placeholder="Enter 4th counter icon" value="{{ old('counter_box_four_icon') ?? $static->where('name','counter_box_four_icon')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_area_bg">Background Image (1980x1280)</label>
                <input type="file" class="form-control" id="counter_area_bg" name="counter_area_bg">
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="real_data" name="real_data" value="on"
                           @if($static->where('name','real_data')->first()->value === 'on') checked @endif>
                    <label class="form-check-label" for="real_data">Get REAL data</label>
                </div>
            </div>

            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a class="btn btn-link" href="https://fontawesome.com/icons" target="_blank">Browse Icons</a>
            </div>
        </form>
    </div>
</div>
