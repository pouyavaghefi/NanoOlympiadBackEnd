@extends('layouts.master')

@section('title','Edit Static Web Page Content')

@section('wrapper')
    @include('layouts.partials.alerts')
    <hr>
    @include('layouts.includes.gadgets.edit-static-page-content')
@endsection

@section('scripts')
    <!-- Load WYSIWYG Editor -->
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: '/web-pages/statics/file-browser/upload/{{ $webpage->id }}?_token={{ csrf_token() }}',
            filebrowserImageUploadUrl: '/web-pages/statics/file-browser/upload/{{ $webpage->id }}?_token={{ csrf_token() }}'
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

                const routeSlug = titleValue
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-');

                const camelSlug = titleValue
                    .toLowerCase()
                    .replace(/[^a-z0-9\s]/g, '')
                    .split(' ')
                    .map((word, index) => index === 0 ? word : word.charAt(0).toUpperCase() + word.slice(1))
                    .join('');

                routeNameInput.value = routeSlug;
                slugInput.value = camelSlug;
            });
        });
    </script>

@endsection
