<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.departments.info') }}">
            @csrf

            <div class="form-group">
                <label for="menu_item__label">Department Header</label>
                <input type="text" class="form-control" id="department_header" name="department_header"
                       placeholder="Department Header" value="{{ old('department_header') ?? $static->where('name','department_header')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Title</label>
                <input type="text" class="form-control" id="department_title" name="department_title"
                       placeholder="Department Title" value="{{ old('department_title') ?? $static->where('name','department_title')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Description</label>
                <input type="text" class="form-control" id="department_description" name="department_description"
                       placeholder="Department Description" value="{{ old('department_description') ?? $static->where('name','department_description')->first()->value ?? '' }}">
            </div>

            <hr>
            <h3>Department One</h3>
            <br>
            <div class="form-group">
                <label for="department_icon_one">Department Icon</label>
                <input type="file" class="form-control" id="department_icon_one" name="department_icon_one"
                       accept="image/*">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Title</label>
                <input type="text" class="form-control" id="department_title_one" name="department_title_one"
                       placeholder="Department Title" value="{{ old('department_title_one') ?? $static->where('name','department_title_one')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Description</label>
                <input type="text" class="form-control" id="department_description_one" name="department_description_one"
                       placeholder="Department Description" value="{{ old('department_description_one') ?? $static->where('name','department_description_one')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Link</label>
                <input type="text" class="form-control" id="department_link_one" name="department_link_one"
                       placeholder="Department Link" value="{{ old('department_link_one') ?? $static->where('name','department_link_one')->first()->value ?? '' }}">
            </div>

            <hr>
            <h3>Department Two</h3>
            <br>
            <div class="form-group">
                <label for="department_icon_two">Department Icon</label>
                <input type="file" class="form-control" id="department_icon_two" name="department_icon_two"
                       accept="image/*">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Title</label>
                <input type="text" class="form-control" id="department_title_two" name="department_title_two"
                       placeholder="Department Title" value="{{ old('department_title_two') ?? $static->where('name','department_title_two')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Description</label>
                <input type="text" class="form-control" id="department_description_two" name="department_description_two"
                       placeholder="Department Description" value="{{ old('department_description_two') ?? $static->where('name','department_description_two')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Link</label>
                <input type="text" class="form-control" id="department_link_two" name="department_link_two"
                       placeholder="Department Link" value="{{ old('department_link_two') ?? $static->where('name','department_link_two')->first()->value ?? '' }}">
            </div>

            <hr>
            <h3>Department Three</h3>
            <br>
            <div class="form-group">
                <label for="department_icon_three">Department Icon</label>
                <input type="file" class="form-control" id="department_icon_three" name="department_icon_three"
                       accept="image/*">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Title</label>
                <input type="text" class="form-control" id="department_title_three" name="department_title_three"
                       placeholder="Department Title" value="{{ old('department_title_three') ?? $static->where('name','department_title_three')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Description</label>
                <input type="text" class="form-control" id="department_description_three" name="department_description_three"
                       placeholder="Department Description" value="{{ old('department_description_three') ?? $static->where('name','department_description_three')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Link</label>
                <input type="text" class="form-control" id="department_link_three" name="department_link_three"
                       placeholder="Department Link" value="{{ old('department_link_three') ?? $static->where('name','department_link_three')->first()->value ?? '' }}">
            </div>

            <hr>
            <h3>Department Four</h3>
            <br>
            <div class="form-group">
                <label for="department_icon_four">Department Icon</label>
                <input type="file" class="form-control" id="department_icon_four" name="department_icon_four"
                       accept="image/*">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Title</label>
                <input type="text" class="form-control" id="department_title_four" name="department_title_four"
                       placeholder="Department Title" value="{{ old('department_title_four') ?? $static->where('name','department_title_four')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Description</label>
                <input type="text" class="form-control" id="department_description_four" name="department_description_four"
                       placeholder="Department Description" value="{{ old('department_description_four') ?? $static->where('name','department_description_four')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Link</label>
                <input type="text" class="form-control" id="department_link_four" name="department_link_four"
                       placeholder="Department Link" value="{{ old('department_link_four') ?? $static->where('name','department_link_four')->first()->value ?? '' }}">
            </div>

            <hr>
            <h3>Department Five</h3>
            <br>
            <div class="form-group">
                <label for="department_icon_five">Department Icon</label>
                <input type="file" class="form-control" id="department_icon_five" name="department_icon_five"
                       accept="image/*">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Title</label>
                <input type="text" class="form-control" id="department_title_five" name="department_title_five"
                       placeholder="Department Title" value="{{ old('department_title_five') ?? $static->where('name','department_title_five')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Description</label>
                <input type="text" class="form-control" id="department_description_five" name="department_description_five"
                       placeholder="Department Description" value="{{ old('department_description_five') ?? $static->where('name','department_description_five')->first()->value ?? '' }}">
            </div>

            <div class="form-group">
                <label for="menu_item__label">Department Link</label>
                <input type="text" class="form-control" id="department_link_five" name="department_link_five"
                       placeholder="Department Link" value="{{ old('department_link_five') ?? $static->where('name','department_link_five')->first()->value ?? '' }}">
            </div>

            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a class="btn btn-link" href="https://fontawesome.com/icons" target="_blank">Browse Icons</a>
            </div>
        </form>
    </div>
</div>
