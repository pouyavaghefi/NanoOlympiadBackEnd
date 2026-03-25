@extends('layouts.master')

@section('title','Create Category Course')

@section('styles')
    <style>
        .td-actions .btn {
            transition: all 0.3s ease;
        }

        /* Hover effect: Enlarge the icon slightly */
        .td-actions .btn:hover i {
            transform: scale(1.2);
        }

        /* Customize button sizes and icon alignment */
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
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('adm.crs.store') }}" method="POST">
                        @csrf
                        @include('layouts.partials.errors')

                        <h3 class="mb-4" style="text-align: left">Create New Course Category</h3>

                        <div class="form-group">
                            <label for="title">Name</label>
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

                        <button type="submit" role="submit" class="btn btn-primary">Create Category</button>
                    </form>

                    <script src="https://cdn.tiny.cloud/1/iax4ewixzv7hhs3hq5ybww77easwpi79ojl5ns3g1kty77ba/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

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
                </div>
            </div>
        </div>
    </div>
@endsection

