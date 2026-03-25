<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('adm.crs.epi.store', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h3 class="mb-4" style="text-align: left">Add New Episode</h3>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="add_video_url" name="add_video_url" value="1" {{ old('add_video_url') ? 'checked' : '' }}>
                            Add Video URL Instead of Uploading
                        </label>
                    </div>

                    <div class="form-group" id="video_url_group" style="display: {{ old('add_video_url') ? 'block' : 'none' }};">
                        <label for="video_url">Video URL</label>
                        <input type="text" name="video_url" id="video_url" class="form-control" value="{{ old('video_url') }}">
                        @error('video_url')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" id="video_upload_group" style="display: {{ old('add_video_url') ? 'none' : 'block' }};">
                        <label for="video_file">Upload Video</label>
                        <input type="file" name="video_file" id="video_file" class="form-control">
                        @error('video_file')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let checkbox = document.getElementById("add_video_url");
                            let videoUrlGroup = document.getElementById("video_url_group");
                            let videoUploadGroup = document.getElementById("video_upload_group");

                            checkbox.addEventListener("change", function() {
                                if (this.checked) {
                                    videoUrlGroup.style.display = "block";
                                    videoUploadGroup.style.display = "none";
                                } else {
                                    videoUrlGroup.style.display = "none";
                                    videoUploadGroup.style.display = "block";
                                }
                            });
                        });
                    </script>

                    <div class="form-group">
                        <label for="course_id">Course</label>
                        <select id="course_id" class="form-control" disabled required>
                            <option value="" disabled selected>Select a Course</option>
                            @foreach(\App\Models\Course\Course::whereNull('deleted_at')->pluck('title', 'id') as $id => $title)
                                <option value="{{ $id }}" {{ $courseId == $id ? 'selected' : '' }}>
                                    {{ $title }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="course_id" value="{{ $courseId }}">
                        @error('course_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title">Episode Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="manual_slug" class="form-check-input" name="manual_slug" value="1">
                            <label for="manual_slug" class="form-check-label">Enter Slug Manually</label>
                        </div>
                    </div>

                    <div class="form-group" id="slug_input" style="display: none;">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
                        @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <script>
                        document.getElementById('manual_slug').addEventListener('change', function() {
                            let slugInput = document.getElementById('slug_input');
                            slugInput.style.display = this.checked ? 'block' : 'none';
                        });
                    </script>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="manual_episode_number" class="form-check-input" name="manual_episode_number" value="1">
                            <label for="manual_episode_number" class="form-check-label">Enter Episode Number Manually</label>
                        </div>
                    </div>

                    <div class="form-group" id="episode_number_input" style="display: none;">
                        <label for="number">Episode Number</label>
                        <input type="number" name="number" id="number" class="form-control" value="{{ old('number') }}">
                        @error('number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <script>
                        document.getElementById('manual_episode_number').addEventListener('change', function() {
                            let episodeNumberInput = document.getElementById('episode_number_input');
                            episodeNumberInput.style.display = this.checked ? 'block' : 'none';
                        });
                    </script>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            let manualSlugCheckbox = document.getElementById("manual_slug");
                            let slugField = document.getElementById("slug");
                            let titleField = document.getElementById("title");

                            function generateSlug(text) {
                                return text.toLowerCase()
                                    .replace(/[^a-z0-9\s-]/g, '')
                                    .replace(/\s+/g, '-')
                                    .replace(/-+/g, '-');
                            }

                            manualSlugCheckbox.addEventListener("change", function () {
                                if (this.checked) {
                                    slugField.removeAttribute("readonly");
                                } else {
                                    slugField.setAttribute("readonly", true);
                                    slugField.value = generateSlug(titleField.value);
                                }
                            });

                            titleField.addEventListener("input", function () {
                                if (!manualSlugCheckbox.checked) {
                                    slugField.value = generateSlug(this.value);
                                }
                            });
                        });
                    </script>

                    <div class="form-group">
                        <label for="type">Episode Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="article" {{ old('type') == 'article' ? 'selected' : '' }}>Article</option>
                        </select>
                        @error('type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Short Description</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="body">Content (For Article Type)</label>
                        <textarea name="body" id="body" class="form-control">{{ old('body') }}</textarea>
                        @error('body')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags (Comma Separated)</label>
                        <input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags') }}">
                        @error('tags')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="manual_duration" class="form-check-input">
                            <label for="manual_duration" class="form-check-label">Add duration manually</label>
                        </div>
                    </div>

                    <div class="form-group" id="duration_input" style="display: none;">
                        <label for="time">Duration</label>
                        <input type="text" name="time" id="time" class="form-control" value="{{ old('time', '00:00:00') }}">
                        @error('time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <script>
                        document.getElementById('manual_duration').addEventListener('change', function() {
                            let durationInput = document.getElementById('duration_input');
                            if (this.checked) {
                                durationInput.style.display = 'block';
                            } else {
                                durationInput.style.display = 'none';
                            }
                        });
                    </script>

                    <button type="submit" class="btn btn-primary">Add Episode</button>
                </form>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        let typeSelect = document.getElementById("type");
                        let addVideoUrlCheckbox = document.getElementById("add_video_url").closest(".form-group"); // Hides the checkbox group
                        let videoUrlGroup = document.getElementById("video_url_group");
                        let videoUploadGroup = document.getElementById("video_upload_group");

                        function toggleVideoFields() {
                            if (typeSelect.value === "article") {
                                addVideoUrlCheckbox.style.display = "none";
                                videoUrlGroup.style.display = "none";
                                videoUploadGroup.style.display = "none";
                            } else {
                                addVideoUrlCheckbox.style.display = "block";
                                let isUrlChecked = document.getElementById("add_video_url").checked;
                                videoUrlGroup.style.display = isUrlChecked ? "block" : "none";
                                videoUploadGroup.style.display = isUrlChecked ? "none" : "block";
                            }
                        }

                        typeSelect.addEventListener("change", toggleVideoFields);
                        toggleVideoFields();
                    });
                </script>

                <script>
                    function toggleSlugInput() {
                        let slugGroup = document.getElementById("slug-group");
                        let slugInput = document.getElementById("slug");
                        let checkbox = document.getElementById("custom_slug");

                        if (checkbox.checked) {
                            slugGroup.style.display = "block";
                            slugInput.required = true;
                        } else {
                            slugGroup.style.display = "none";
                            slugInput.required = false;
                            slugInput.value = "";
                        }
                    }

                    function toggleVideoUrl() {
                        let typeSelect = document.getElementById("type");
                        let videoSection = document.getElementById("video-section");
                        let videoUrlInput = document.getElementById("video_url");
                        let customVideoCheckbox = document.getElementById("custom_video_url");

                        if (typeSelect.value === "video") {
                            videoSection.style.display = "block";
                            videoUrlInput.value = generateVideoUrl();
                            videoUrlInput.readOnly = true;
                            customVideoCheckbox.checked = false;
                        } else {
                            videoSection.style.display = "none";
                            videoUrlInput.value = "";
                        }
                    }

                    function toggleVideoInput() {
                        let videoUrlInput = document.getElementById("video_url");
                        let checkbox = document.getElementById("custom_video_url");

                        if (checkbox.checked) {
                            videoUrlInput.readOnly = false;
                            videoUrlInput.value = "";
                        } else {
                            videoUrlInput.readOnly = true;
                            videoUrlInput.value = generateVideoUrl();
                        }
                    }

                    function generateVideoUrl() {
                        return "{{ env('MAIN_DOMAIN') }}/" + Math.random().toString(36).substring(7);
                    }

                    function toggleTotalHours() {
                        var totalHoursField = document.getElementById('total_hours_group');
                        if (document.getElementById('toggle_total_hours').checked) {
                            totalHoursField.style.display = 'block';
                        } else {
                            totalHoursField.style.display = 'none';
                        }
                    }
                </script>
                <script src="https://cdn.tiny.cloud/1/iax4ewixzv7hhs3hq5ybww77easwpi79ojl5ns3g1kty77ba/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        tinymce.init({
                            selector: '#description, #body',
                            plugins: [
                                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media',
                                'searchreplace', 'table', 'visualblocks', 'wordcount', 'checklist', 'mediaembed', 'casechange',
                                'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen',
                                'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments',
                                'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
                                'importword', 'exportword', 'exportpdf'
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
                    });
                </script>

            </div>
        </div>
    </div>
</div>