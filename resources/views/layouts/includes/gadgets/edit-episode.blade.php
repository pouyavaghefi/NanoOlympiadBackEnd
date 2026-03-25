<form action="{{ route('adm.crs.epi.updateEpi', $episode->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <h3 class="mb-4" style="text-align: left">Edit Episode</h3>

    <div class="form-group">
        <label>Course ID</label>
        <input type="number" name="course_id" class="form-control" value="{{ old('course_id', $episode->course_id) }}" required>
    </div>

    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $episode->title) }}" required>
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $episode->slug) }}">
    </div>

    <div class="form-group">
        <label>Type</label>
        <input type="text" name="type" class="form-control" value="{{ old('type', $episode->type) }}" required>
    </div>

    <div class="form-group">
        <label>Show Status</label>
        <select name="show_status" class="form-control" required>
            <option value="1" {{ $episode->show_status == 1 ? 'selected' : '' }}>Show</option>
            <option value="0" {{ $episode->show_status == 0 ? 'selected' : '' }}>Hide</option>
        </select>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $episode->description) }}</textarea>
    </div>

    <div class="form-group">
        <label>Body</label>
        <textarea name="body" class="form-control">{{ old('body', $episode->body) }}</textarea>
    </div>

    <div class="form-group">
        <label>Video URL</label>
        <input type="text" name="video_url" class="form-control" value="{{ old('video_url', $episode->video_url) }}">
    </div>

    <div class="form-group">
        <label>Upload Video File</label>
        <input type="file" name="video_path" class="form-control-file">
        @if ($episode->video_path)
            <small>Current: <a href="{{ asset($episode->video_path) }}" target="_blank">Watch Video</a></small>
        @endif
    </div>

    <div class="form-group">
        <label>Upload Thumbnail</label>
        <input type="file" name="thumb_path" class="form-control-file">
        @if ($episode->thumb_path)
            <div class="mt-2">
                <img src="{{ asset($episode->thumb_path) }}" alt="Thumbnail" style="max-width: 150px;">
            </div>
        @endif
    </div>

    <div class="form-group">
        <label>Tags</label>
        <input type="text" name="tags" class="form-control" value="{{ old('tags', $episode->tags) }}">
    </div>

    <div class="form-group">
        <label>Time (e.g., 00:12:30)</label>
        <input type="text" name="time" class="form-control" value="{{ old('time', $episode->time) }}" required>
    </div>

    <div class="form-group">
        <label>Number</label>
        <input type="number" name="number" class="form-control" value="{{ old('number', $episode->number) }}">
    </div>

    <div class="form-group">
        <label>Download Available</label>
        <select name="download_available" class="form-control" required>
            <option value="1" {{ $episode->download_available == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $episode->download_available == 0 ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <div class="form-group">
        <label>Episode Number</label>
        <input type="number" name="episode_number" class="form-control" value="{{ old('episode_number', $episode->episode_number) }}" required>
    </div>

    <div class="form-group">
        <label>Episode iFrame</label>
        <input type="text" name="episode_iframe" class="form-control" value="{{ old('episode_iframe', $episode->episode_iframe) }}">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Update Episode</button>
</form>
