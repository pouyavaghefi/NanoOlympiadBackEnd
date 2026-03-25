<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.call-to-action') }}">
            @csrf

            <div class="form-group">
                <label for="menu_item__label">Call To Action Link</label>
                <input type="text" class="form-control" id="call-to-action" name="call_to_action"
                       placeholder="Call to action link address" value="{{ old('call_to_action') ?? $static->where('name','call-to-action')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Call To Action Name</label>
                <input type="text" class="form-control" id="call-to-action-name" name="call_to_action_name"
                       placeholder="Call to action button label" value="{{ old('call_to_action_name') ?? $static->where('name','call-to-action-name')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Call To Action Name</label>
                <input type="text" class="form-control" id="call-to-action-icon" name="call_to_action_icon"
                       placeholder="Call to action button label" value="{{ old('call_to_action_icon') ?? $static->where('name','call-to-action-icon')->first()->value ?? '' }}">
            </div>

            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a class="btn btn-link" href="https://fontawesome.com/icons" target="_blank">Browse Icons</a>
            </div
        </form>
    </div>
</div>
