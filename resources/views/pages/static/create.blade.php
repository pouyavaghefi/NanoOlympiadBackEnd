@extends('layouts.master')

@section('title','Create Static')

@section('styles')
<style>
    .td-actions .btn {
        transition: all 0.3s ease;
    }

    .td-actions .btn:hover i {
        transform: scale(1.2);
    }

    .td-actions .btn i {
        font-size: 16px;
    }

    /* Tooltip styling */
    [data-toggle="tooltip"] {
        cursor: pointer;
    }
</style>

@endsection

@section('wrapper')
    @include('layouts.partials.alerts')
    @include('layouts.includes.gadgets.new-static')
@endsection

@section('scripts')
<script src="/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace(document.querySelector('.wysiwyg-editor'), {
        filebrowserUploadUrl: '/web-pages/statics/file-browser/upload?_token={{ csrf_token() }}',
        filebrowserImageUploadUrl: '/web-pages/statics/file-browser/upload?_token={{ csrf_token() }}',
        filebrowserBrowseUrl: '/file-manager/',  // Optional: to open file manager
    });

    // Handling file upload response to pass the URL to CKEditor
    CKEDITOR.on('instanceReady', function(ev) {
        var editor = ev.editor;

        editor.on('fileUploadResponse', function(evt) {
            var data = evt.data;
            if (data && data.url) {
                // File URL is in the response, insert the image into CKEditor
                editor.insertHtml('<img src="' + data.url + '" />');

                // Show success message
                alert("Image uploaded successfully!");
            }
        });

        editor.on('fileUploadError', function(evt) {
            alert("Error uploading image. Please try again.");
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.querySelector('input[name="title"]');
        const routeNameInput = document.querySelector('input[name="route_name"]');
        const slugInput = document.querySelector('input[name="slug"]');

        titleInput.addEventListener('input', function () {
            const titleValue = titleInput.value.trim();

            // Generate route_name: lowercase, dash-separated
            const routeSlug = titleValue
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')      // Remove special chars
                .replace(/\s+/g, '-')          // Replace spaces with dash
                .replace(/--+/g, '-');

            // Generate slug: lowerCamelCase
            const camelSlug = titleValue
                .toLowerCase()
                .replace(/[^a-z0-9\s]/g, '')   // Remove special chars
                .split(' ')
                .map((word, index) => index === 0 ? word : word.charAt(0).toUpperCase() + word.slice(1))
                .join('');

            routeNameInput.value = routeSlug;
            slugInput.value = camelSlug;
        });
    });
</script>

@endsection

