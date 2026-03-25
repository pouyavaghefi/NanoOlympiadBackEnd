<form action="{{ route('adm.crs.store') }}" method="POST">
    @csrf

    <h3 class="mb-4" style="text-align: left">Create New Course</h3>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        @error('title')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        @error('description')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" id="body" class="form-control">{{ old('body') }}</textarea>
        @error('body')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" id="custom_slug" class="form-check-input" onclick="toggleSlugInput()">
        <label for="custom_slug" class="form-check-label">Manually Enter Slug</label>
    </div>
    <br>

    <div class="form-group" id="slug-group" style="display: none;">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
        @error('slug')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="sessions">Sessions</label>
        <input type="number" name="sessions" id="sessions" class="form-control" value="{{ old('sessions') }}" required>
        @error('sessions')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}" required>
        @error('price')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" id="custom_hours" class="form-check-input" onclick="toggleTotalHoursInput()">
        <label for="custom_hours" class="form-check-label">Manually Enter Total Hours</label>
    </div>
    <br>

    <div class="form-group" id="total-hours-group" style="display: none;">
        <label for="total_hours">Total Hours</label>
        <input type="number" name="total_hours" id="total_hours" class="form-control" value="{{ old('total_hours') }}">
        @error('total_hours')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control">
            <option value="" disabled selected>Select a category</option>
            @foreach(\App\Models\Course\CourseCategory::all() as $category)
                <option value="{{ $category->slug }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @if(((\App\Models\Course\CourseCategory::all())->isEmpty()))
            <a style="color:red" href="{{ route('adm.crs.cats.index') }}">No category has been added!</a>
        @endif

        @error('category')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control" required>
            <option value="" disabled selected>Select type of episodes</option>
            <option value="online" {{ old('type') == 'online' ? 'selected' : '' }}>Online</option>
            <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
            <option value="video" {{ old('type') == 'none' ? 'selected' : '' }}>None</option>
        </select>
        @error('type')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-check mb-2">
        <input type="hidden" name="course_private" value="0">
        <input type="checkbox" name="course_private" id="course_private" class="form-check-input" value="1">
        <label for="course_private" class="form-check-label">Course is private</label>
    </div>
    <hr>

    <button type="submit" role="submit" class="btn btn-primary">Create Course</button>
    <button type="submit" name="save_draft" value="1" class="btn btn-secondary">Save as Draft</button>
</form>

<script src="https://cdn.tiny.cloud/1/iax4ewixzv7hhs3hq5ybww77easwpi79ojl5ns3g1kty77ba/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    function toggleSlugInput() {
        const slugGroup = document.getElementById('slug-group');
        const customSlugCheckbox = document.getElementById('custom_slug');

        if (customSlugCheckbox.checked) {
            slugGroup.style.display = 'block';
        } else {
            slugGroup.style.display = 'none';
        }
    }

    function toggleTotalHoursInput() {
        const totalHoursGroup = document.getElementById('total-hours-group');
        const customHoursCheckbox = document.getElementById('custom_hours');

        if (customHoursCheckbox.checked) {
            totalHoursGroup.style.display = 'block';
        } else {
            totalHoursGroup.style.display = 'none';
        }
    }

    // Initialize TinyMCE editor
    tinymce.init({
        selector: 'textarea',
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
</script>