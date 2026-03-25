<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Admin Edit Form -->
        <form method="POST" action="{{ route('adm.pgs.aboutus.info') }}" enctype="multipart/form-data">
            @csrf

            @if($static->isEmpty())
                <p>No static page data found!</p>
            @else
                <div class="form-group">
                    <label for="aboutus_header">Aboutus Header</label>
                    <input type="text" class="form-control" id="aboutus_header" name="aboutus_header" placeholder="Enter Aboutus Header" value="{{ $static->where('name','aboutus_header')->first()->value ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="aboutus_header_icon">Aboutus Header Icon</label>
                    <input type="text" class="form-control" id="aboutus_header_icon" name="aboutus_header_icon" placeholder="Enter Aboutus Header Icon" value="{{ $static->where('name','aboutus_header_icon')->first()->value ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="aboutus_title">Aboutus Title</label>
                    <input type="text" class="form-control" id="aboutus_title" name="aboutus_title" placeholder="Enter Aboutus Title" value="{{ $static->where('name','aboutus_title')->first()->value ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="aboutus_paragraph">Aboutus Paragraph</label>
                    <textarea class="form-control" id="aboutus_paragraph" name="aboutus_paragraph" placeholder="Enter Aboutus Paragraph">{{ $static->where('name','aboutus_paragraph')->first()->value ?? '' }}</textarea>
                </div>

                <hr>

                <div class="form-group">
                    <label for="secondary_title_1">Aboutus Secondary Title 1</label>
                    <input type="text" class="form-control" id="aboutus_secondary_title_1" name="aboutus_secondary_title_1" placeholder="Enter Secondary Title 1" value="{{ $static->where('name','aboutus_secondary_title_1')->first()->value ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="aboutus_secondary_paragraph_1">Aboutus Secondary Paragraph 1</label>
                    <textarea class="form-control" id="aboutus_secondary_paragraph_1" name="aboutus_secondary_paragraph_1" placeholder="Enter Secondary Paragraph 1">{{ $static->where('name','aboutus_secondary_paragraph_1')->first()->value ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="aboutus_secondary_icon_1">Aboutus Secondary Icon 1</label>
                    <input type="text" class="form-control" id="aboutus_secondary_icon_1" name="aboutus_secondary_icon_1" placeholder="Enter Secondary Icon 1" value="{{ $static->where('name','aboutus_secondary_icon_1')->first()->value ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="aboutus_secondary_title_2">Aboutus Secondary Title 2</label>
                    <input type="text" class="form-control" id="aboutus_secondary_title_2" name="aboutus_secondary_title_2" placeholder="Enter Secondary Title 2" value="{{ $static->where('name','aboutus_secondary_title_2')->first()->value ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="aboutus_secondary_paragraph_2">Aboutus Secondary Paragraph 2</label>
                    <textarea class="form-control" id="aboutus_secondary_paragraph_2" name="aboutus_secondary_paragraph_2" placeholder="Enter Secondary Paragraph 2">{{ $static->where('name','aboutus_secondary_paragraph_2')->first()->value ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="aboutus_secondary_icon_2">Aboutus Secondary Icon 2</label>
                    <input type="text" class="form-control" id="aboutus_secondary_icon_2" name="aboutus_secondary_icon_2" placeholder="Enter Secondary Icon 2" value="{{ $static->where('name','aboutus_secondary_icon_2')->first()->value ?? '' }}">
                </div>

                <hr>

                <div class="form-group">
                    <label for="aboutus_extra_note">Aboutus Extra Note</label>
                    <textarea class="form-control" id="aboutus_extra_note" name="aboutus_extra_note" placeholder="Enter Extra Note">{{ $static->where('name','aboutus_extra_note')->first()->value ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="aboutus_link_name">Aboutus Link Name</label>
                    <input type="text" class="form-control" id="aboutus_link_name" name="aboutus_link_name" placeholder="Enter Link Name" value="{{ $static->where('name','aboutus_link_name')->first()->value ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="aboutus_link_url">Aboutus Link URL</label>
                    <input type="url" class="form-control" id="aboutus_link_url" name="aboutus_link_url" placeholder="Enter Link URL" value="{{ $static->where('name','aboutus_link_url')->first()->value ?? '' }}">
                </div>

                <hr>
                <p><a class="btn btn-link" href="/guides/home-aboutus.png" target="_blank">See the guidelines</a></p><br>
                <div class="form-group">
                    <label for="aboutus_first_image">Aboutus First Image (400x600)</label>
                    <input type="file" class="form-control" id="aboutus_first_image" name="aboutus_first_image">
                </div>

                <div class="form-group">
                    <label for="aboutus_second_image">Aboutus Second Image (400x400)</label>
                    <input type="file" class="form-control" id="aboutus_second_image" name="aboutus_second_image">
                </div>

                <div class="form-group">
                    <label for="aboutus_third_image">Aboutus Third Image (400x480)</label>
                    <input type="file" class="form-control" id="aboutus_third_image" name="aboutus_third_image">
                </div>

                <hr>

                <div class="form-group">
                    <label for="aboutus_badge_text">Aboutus Badge Text</label>
                    <input type="text" class="form-control" id="aboutus_badge_text" name="aboutus_badge_text" placeholder="Enter Badge Text" value="{{ $static->where('name','aboutus_badge_text')->first()->value ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="aboutus_badge_icon">Aboutus Badge Icon</label>
                    <input type="text" class="form-control" id="aboutus_badge_icon" name="aboutus_badge_icon" placeholder="Enter Badge Icon" value="{{ $static->where('name','aboutus_badge_icon')->first()->value ?? '' }}">
                </div>

                <hr>

                <div class="form-group">
                    <label for="aboutus_call_number">Aboutus Call Number</label>
                    <input type="tel" class="form-control" id="aboutus_call_number" name="aboutus_call_number" placeholder="Enter Call Number" value="{{ $static->where('name','aboutus_call_number')->first()->value ?? '' }}">
                </div>


                <button type="submit" class="btn btn-primary">Save Changes</button>
            @endif
        </form>
    </div>
</div>
