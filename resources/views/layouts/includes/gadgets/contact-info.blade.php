<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.contact.info') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="office_address" class="form-label">Office Address</label>
                <input type="text" class="form-control" id="office_address" name="office_address" value="{{ old('office_address', $contact->office_address ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Call Us</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $contact->phone ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Us</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $contact->email ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="open_time" class="form-label">Open Time</label>
                <input type="text" class="form-control" id="open_time" name="open_time" value="{{ old('open_time', $contact->open_time ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="map_embed_url" class="form-label">Geographical Coordinates (latitude and longitude - separate them by ,)</label>
                <input type="text" class="form-control" id="map_embed_url" name="map_embed_url" value="{{ old('map_embed_url', $contact->map_embed_url ?? '') }}" placeholder="Paste Google Maps Embed URL">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="show_contact_form" name="show_contact_form" value="1" {{ old('show_contact_form', $contact->show_contact_form ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="show_contact_form">Show Contact Form</label>
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
            </div>

            <!-- Cover Image Section -->
            @if(!empty($contact->cover_image))
                <div class="mb-3">
                    <label class="form-label">Current Cover Image:</label>
                    <div class="position-relative">
                        <img src="{{ asset('contact/' . $contact->cover_image) }}" class="img-fluid rounded" style="max-height: 200px;">
                        <a href="{{ route('adm.pgs.contact.info.deleteCoverImage') }}" class="btn btn-danger">X</a>
                    </div>
                </div>
            @endif

            <div class="mb-3">
                <label for="box_image" class="form-label">Box Image</label>
                <input type="file" class="form-control" id="box_image" name="box_image" accept="image/*">
            </div>

            <!-- Box Image Section -->
            @if(!empty($contact->box_image))
                <div class="mb-3">
                    <label class="form-label">Current Box Image:</label>
                    <div class="position-relative">
                        <img src="{{ asset('contact/' . $contact->box_image) }}" class="img-fluid rounded" style="max-height: 200px;">
                        <a class="btn btn-danger" href="{{ route('adm.pgs.contact.info.deleteBoxImage') }}">X</a>
                    </div>
                </div>
            @endif

            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
