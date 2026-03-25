<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Admin Edit Form -->
        <form method="POST" action="{{ route('adm.pgs.quick.contact.info') }}">
            @csrf

            @if($static->isEmpty())
                <p>No static page data found!</p>
            @else
                <!-- Social Media Links -->
                <div class="form-group">
                    <label for="facebook">Facebook Link</label>
                    <input type="url" class="form-control" id="facebook" name="facebook" placeholder="Enter Facebook URL" value="{{ $static->where('name','fa-facebook-f')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram Link</label>
                    <input type="url" class="form-control" id="instagram" name="instagram" placeholder="Enter Instagram URL" value="{{ $static->where('name','fa-instagram')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="youtube">YouTube Link</label>
                    <input type="url" class="form-control" id="youtube" name="youtube" placeholder="Enter YouTube URL" value="{{ $static->where('name','fa-youtube')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="whatsapp">WhatsApp Link</label>
                    <input type="url" class="form-control" id="whatsapp" name="whatsapp" placeholder="Enter WhatsApp Link" value="{{ $static->where('name','fa-whatsapp')->first()->value ?? '' }}">
                </div>

                <!-- Contact Information -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{ $static->where('name','fa-location-dot')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $static->where('name','fa-envelopes')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="{{ $static->where('name','fa-phone-volume')->first()->value ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="show_quick">Do not show the quick contact bar</label>
                    <input type="checkbox" id="show_quick" name="show_quick" @if($static->where('name','show_quick')->first()->value === "on") checked @endif>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            @endif
        </form>
    </div>
</div>
