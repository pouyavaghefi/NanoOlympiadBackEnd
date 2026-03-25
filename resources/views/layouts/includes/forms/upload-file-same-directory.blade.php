@php
    $currentUrl = request()->path();

    if (str_contains($currentUrl, 'landing/features')) {
        $directory = 'features';
    } elseif (str_contains($currentUrl, 'landing/aboutus')) {
        $directory = 'about';
    } elseif (str_contains($currentUrl, 'academy/members/all')) {
        $directory = 'members-country';
    }else {
        $directory = 'members-country';
    }
@endphp

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('adm.pgs.upload.wallpaper', ['directory' => $directory]) }}" method="POST" enctype="multipart/form-data" class="mt-4">
    @csrf

    <div class="mb-3">
        <label for="file" class="form-label">Upload File</label>
        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" required>

        @error('file')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Upload</button>
</form>
