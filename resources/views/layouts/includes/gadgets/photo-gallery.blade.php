<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.gallery.info') }}" enctype="multipart/form-data">
            @csrf

            <div class="gallery-area py-120">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="gallery_header">Gallery Header</label>
                                <input type="text" class="form-control" id="gallery_header" name="gallery_header" placeholder="Enter Gallery Header" value="{{ $static->where('name','gallery_header')->first()->value ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="gallery_icon">Gallery Icon</label>
                                <input type="text" class="form-control" id="gallery_icon" name="gallery_icon" placeholder="Enter Gallery Icon" value="{{ $static->where('name','gallery_icon')->first()->value ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="gallery_title">Gallery Title</label>
                                <input type="text" class="form-control" id="gallery_title" name="gallery_title" placeholder="Enter Gallery Title" value="{{ $static->where('name','gallery_title')->first()->value ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="gallery_description">Gallery Description</label>
                                <input type="text" class="form-control" id="gallery_description" name="gallery_description" placeholder="Enter Gallery Description" value="{{ $static->where('name','gallery_description')->first()->value ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row popup-gallery">
                        @for ($i = 1; $i <= 6; $i += 2)
                            <div class="col-md-4 mb-4">
                                <!-- First Image in Pair -->
                                <div class="gallery-item mt-4">
                                    <div class="gallery-img">
                                        <img src="/assets/img/gallery/{{ sprintf('%02d', $i + 1) }}.jpg" alt="Gallery Image {{ $i + 1 }}" id="gallery-img-{{ $i + 1 }}" class="img-fluid">
                                    </div>
                                    <div class="gallery-content text-center mt-2">
                                        <input type="file" class="file-upload" id="file-upload-{{ $i + 1 }}" style="display:none;" accept="image/*" onchange="previewImage({{ $i + 1 }})">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('file-upload-{{ $i + 1 }}').click();">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                    </div>
                                </div>

                                <!-- Second Image in Pair -->
                                <div class="gallery-item">
                                    <div class="gallery-img">
                                        <img src="/assets/img/gallery/{{ sprintf('%02d', $i) }}.jpg" alt="Gallery Image {{ $i }}" id="gallery-img-{{ $i }}" class="img-fluid">
                                    </div>
                                    <div class="gallery-content text-center mt-2">
                                        <input type="file" class="file-upload" id="file-upload-{{ $i }}" style="display:none;" accept="image/*" onchange="previewImage({{ $i }})">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('file-upload-{{ $i }}').click();">
                                            <i class="fas fa-upload"></i> Upload
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <hr>
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a class="btn btn-link" href="https://fontawesome.com/icons" target="_blank">Browse Icons</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
