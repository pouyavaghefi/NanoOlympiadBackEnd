@extends('layouts.master')

@section('title','Translate Course')

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
                    <!-- Main Course Information in the Primary Language -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 style="text-align: left">Main Course Information (Primary Language)</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label><strong>Title:</strong></label>
                                <p>{{ $course->title }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Slug:</strong></label>
                                <p>{{ $course->slug }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Description:</strong></label>
                                <p>{!! $course->description !!}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Body:</strong></label>
                                <p>{!! $course->body !!}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('adm.crs.translate.submit', $course->id) }}" method="POST">
                        @csrf
                        @include('layouts.partials.errors')

                        <h3 class="mb-4" style="text-align: left">Translate Course</h3>

                        <!-- Language Selection -->
                        <div class="form-group">
                            <label for="language_id">Language</label>
                            <select name="language_id" id="language_id" class="form-control" required>
                                @foreach($languages as $language)
                                    @php
                                        $translation = $courseTranslations[$language->id] ?? null;
                                    @endphp
                                    <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                        {{ $language->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Title -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <!-- Slug -->
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                        </div>

                        <!-- Body -->
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" class="form-control" rows="8">{{ old('body') }}</textarea>
                        </div>

                        <button type="submit" role="submit" class="btn btn-primary">Submit Translation</button>
                    </form>

                    <!-- Translations Table -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Language</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Body</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($languages as $language)
                            @php
                                $translation = $courseTranslations[$language->id] ?? null;
                            @endphp
                            <tr>
                                <td>{{ $language->name }}</td>
                                <td>{{ $translation->title ?? '—' }}</td>
                                <td>{{ $translation->slug ?? '—' }}</td>
                                <td>{{ $translation->description ?? '—' }}</td>
                                <td>{{ $translation->body ?? '—' }}</td>
                                <td>
                                    @if ($translation)
                                        <!-- Edit Button -->
                                        <a href="{{ route('adm.crs.translate.edit', ['course' => $course->id, 'language' => $language->id]) }}"
                                           class="btn btn-primary btn-sm">
                                            Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('adm.crs.translate.delete', ['course' => $course->id, 'language' => $language->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="language_id" value="{{ $language->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this translation?');">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


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
                </div>
            </div>
        </div>
    </div>
@endsection

