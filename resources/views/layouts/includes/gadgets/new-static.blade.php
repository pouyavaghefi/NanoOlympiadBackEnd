<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('adm.pgs.statics.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h3 class="mb-4 text-left">Add New Static Page</h3>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" class="form-control" value="{{ old('title') }}">
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input name="slug" class="form-control" value="{{ old('slug') }}">
                        @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="route_name">Route Name</label>
                        <input name="route_name" class="form-control" value="{{ old('route_name') }}">
                        @error('route_name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="wall_paper">Wallpaper (optional)</label>
                        <input type="file" name="wall_paper" class="form-control-file">
                        @error('wall_paper')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Page Content</label>
                        <textarea name="content" class="form-control wysiwyg-editor" rows="10">{{ old('content') }}</textarea>
                        @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" id="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Add Static Page</button>
                </form>
            </div>
        </div>
    </div>
</div>