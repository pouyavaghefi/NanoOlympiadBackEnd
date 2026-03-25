<form action="{{ route('adm.crs.update', $course->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h3 class="mb-4" style="text-align: left">Edit Course</h3>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $course->title) }}" required>
        @error('title')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $course->description) }}</textarea>
        @error('description')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" id="body" class="form-control">{{ old('body', $course->body) }}</textarea>
        @error('body')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" id="custom_slug" class="form-check-input" onclick="toggleSlugInput()" {{ old('slug', $course->slug) ? 'checked' : '' }}>
        <label for="custom_slug" class="form-check-label">Manually Enter Slug</label>
    </div>
    <br>

    <div class="form-group" id="slug-group" style="{{ old('slug', $course->slug) ? '' : 'display: none;' }}">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $course->slug) }}">
        @error('slug')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="sessions">Sessions</label>
        <input type="number" name="sessions" id="sessions" class="form-control" value="{{ old('sessions', $course->sessions) }}" required>
        @error('sessions')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $course->price) }}" required>
        @error('price')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" id="custom_hours" class="form-check-input" onclick="toggleTotalHoursInput()" {{ old('total_hours', $course->total_hours) ? 'checked' : '' }}>
        <label for="custom_hours" class="form-check-label">Manually Enter Total Hours</label>
    </div>
    <br>

    <div class="form-group" id="total-hours-group" style="{{ old('total_hours', $course->total_hours) ? '' : 'display: none;' }}">
        <label for="total_hours">Total Hours</label>
        <input type="number" name="total_hours" id="total_hours" class="form-control" value="{{ old('total_hours', $course->total_hours) }}">
        @error('total_hours')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="category[]" id="category" class="form-control select2" multiple>
            @foreach(\App\Models\Course\CourseCategory::all() as $category)
                <option value="{{ $category->slug }}"
                        {{ in_array($category->slug, old('category', $course->category ?? [])) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @if(\App\Models\Course\CourseCategory::all()->isEmpty())
            <a style="color:red" href="{{ route('adm.crs.cats.index') }}">No category has been added!</a>
        @endif
        @error('category')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select categories",
                allowClear: true
            });
        });
    </script>

    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control" required>
            <option value="" disabled>Select type of episodes</option>
            <option value="online" {{ old('type', $course->type) == 'online' ? 'selected' : '' }}>Online</option>
            <option value="video" {{ old('type', $course->type) == 'video' ? 'selected' : '' }}>Video</option>
            <option value="none" {{ old('type', $course->type) == 'none' ? 'selected' : '' }}>None</option>
        </select>
        @error('type')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="image_url">Course Image</label>
        <input type="file" name="image_url" id="image_url" class="form-control">

        @if($course->image_url)
            <p>Current Image:
                <img src="{{ asset($course->image_url) }}" alt="Current Image" width="100">
                <a href="{{ route('adm.crs.deleteImage', $course->id) }}"
                   class="btn btn-danger btn-sm"
                   data-method="DELETE"
                   data-confirm="Are you sure you want to delete this image?"
                   style="display:inline;">X</a>
            </p>
        @else
            <small style="color:red">No image has been added!</small>
        @endif
        @error('image_url')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="cover_image">Course Cover Image</label>
        <input type="file" name="cover_image" id="cover_image" class="form-control">

        @if($course->image_url)
            <p>Current Image:
                <img src="{{ asset($course->image_url) }}" alt="Current Cover Image" width="100">
                <a href="{{ route('adm.crs.deleteImageCover', $course->id) }}"
                   class="btn btn-danger btn-sm"
                   data-method="DELETE"
                   data-confirm="Are you sure you want to delete this cover image?"
                   style="display:inline;">X</a>
            </p>
        @else
            <small style="color:red">No cover image has been added!</small>
        @endif
        @error('cover_image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="intro_video">Course Introduction Video</label>
        <input type="file" name="intro_video" id="intro_video" class="form-control">
        <small class="text-muted">Upload a video file (MP4, AVI, MOV) or enter a YouTube iframe URL below.</small>
    </div>

    @if($course->intro_video)
        <p>Current Video:</p>
        <video width="320" height="240" controls>
            <source src="{{ asset($course->intro_video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @else
        @if((is_null($course->intro_video)) && (is_null($course->intro_video_url)))
        <small style="color:red">No intro video has been added! Consider adding an intro video or add a link of video</small>
        @endif
    @endif

    <div class="form-group">
        <label for="intro_video_url">YouTube Video URL</label>
        <input type="text" name="intro_video_url" id="intro_video_url" class="form-control" placeholder="Paste YouTube embed URL">
    </div>

    @if($course->intro_video_url)
        <p>Current YouTube Video:</p>
        <div>{!! $course->intro_video_url !!}</div>
    @endif

    <button type="submit" class="btn btn-primary">Update Course</button>
</form>

<script>
    function toggleSlugInput() {
        var slugGroup = document.getElementById('slug-group');
        slugGroup.style.display = document.getElementById('custom_slug').checked ? '' : 'none';
    }

    function toggleTotalHoursInput() {
        var totalHoursGroup = document.getElementById('total-hours-group');
        totalHoursGroup.style.display = document.getElementById('custom_hours').checked ? '' : 'none';
    }
</script>
