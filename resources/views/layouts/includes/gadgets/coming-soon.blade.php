<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.set.soon') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="counter_box_one_title">Title</label>
                <input type="text" class="form-control" id="counter_box_one_title" name="counter_box_one_title"
                       placeholder="Enter 1st counter title" value="{{ old('coming_soon_title') ?? $static->where('name','coming_soon_title')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="counter_box_one_description">Description</label>
                <input type="text" class="form-control" id="counter_box_one_description" name="counter_box_one_description"
                       placeholder="Enter 1st counter description" value="{{ old('coming_soon_description') ?? $static->where('name','coming_soon_description')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="button_one_link">Button 1 Link</label>
                <input type="text" class="form-control" id="button_one_link" name="button_one_link"
                       placeholder="Enter Button 1 link" value="{{ old('coming_soon_button_one_link') ?? $static->where('name','coming_soon_button_one_link')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="button_one_name">Button 1 Name</label>
                <input type="text" class="form-control" id="button_one_name" name="button_one_name"
                       placeholder="Enter Button 1 name" value="{{ old('coming_soon_button_one_name') ?? $static->where('name','coming_soon_button_one_name')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="button_two_link">Button 2 Link</label>
                <input type="text" class="form-control" id="button_two_link" name="button_two_link"
                       placeholder="Enter Button 2 link" value="{{ old('coming_soon_button_two_link') ?? $static->where('name','coming_soon_button_two_link')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="button_two_name">Button 2 Name</label>
                <input type="text" class="form-control" id="button_two_name" name="button_two_name"
                       placeholder="Enter Button 2 name" value="{{ old('coming_soon_button_two_name') ?? $static->where('name','coming_soon_button_two_name')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="background_image">Background Image</label>
                <input type="file" class="form-control" id="background_image" name="background_image">
            </div>

            <div class="form-group">
                <label for="subscription_form_title">Subscription Form Title</label>
                <input type="text" class="form-control" id="subscription_form_title" name="subscription_form_title"
                       placeholder="Enter subscription form title" value="{{ old('coming_soon_subscription_form_title') ?? $static->where('name','coming_soon_subscription_form_title')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="subscription_form_description">Subscription Form Description</label>
                <input type="text" class="form-control" id="subscription_form_description" name="subscription_form_description"
                       placeholder="Enter subscription form description" value="{{ old('coming_soon_subscription_form_description') ?? $static->where('name','coming_soon_subscription_form_description')->first()->value ?? '' }}">
            </div>

            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
