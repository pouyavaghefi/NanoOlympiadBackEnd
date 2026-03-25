<!-- Load WYSIWYG Editor -->
<form action="{{ route('adm.pgs.statics.updateContent', $webpage->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h3 class="mb-4">Edit Static Page</h3>

    <div class="form-group">
        <label>Title</label>
        <input name="title" class="form-control" value="{{ old('title', $webpage->title) }}" required disabled="disabled">
    </div>

    <div class="form-group">
        <label>Page Title</label>
        <input name="page_title" class="form-control" value="{{ old('page_title', $webpage->page_title) }}" required>
    </div>

    <div class="form-group">
        <label>Slug (lowerCamelCase)</label>
        <input name="slug" class="form-control" value="{{ old('slug', $webpage->slug) }}" required>
    </div>

    <div class="form-group">
        <label>Route Name (lowercase-dash)</label>
        <input name="route_name" class="form-control" value="{{ old('route_name', $webpage->route_name) }}" required disabled="disabled">
    </div>

    <div class="form-group">
        <label>Wallpaper</label>
        <input type="file" name="wall_paper" class="form-control">
        @if ($webpage->wall_paper)
            <p>Current: <a href="{{ asset('storage/' . $webpage->wall_paper) }}" target="_blank">View</a></p>
        @endif
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="1" {{ $webpage->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $webpage->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <div class="form-group">
        <label>Content</label>
        <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content', $webpage->content) }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Update Page</button>
</form>