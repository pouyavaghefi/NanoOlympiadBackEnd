<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Admin Edit Form -->
        <form method="POST" action="{{ route('adm.pgs.features.info') }}">
            @csrf

            @if($static->isEmpty())
                <p>No static page data found!</p>
            @else
                @php
                    $svgPath = public_path('features');
                    $svgFileNames = file_exists($svgPath) ? array_diff(scandir($svgPath), array('.', '..')) : [];

                    $featureOneIcon = $static->where('name','feature_one_icon')->first()->value ?? '';
                    $featureTwoIcon = $static->where('name','feature_two_icon')->first()->value ?? '';
                    $featureThreeIcon = $static->where('name','feature_three_icon')->first()->value ?? '';
                    $featureFourIcon = $static->where('name','feature_four_icon')->first()->value ?? '';

                    function fileExistsInFolder($fileName, $folderFiles) {
                        return in_array($fileName, $folderFiles);
                    }
                @endphp

                <div class="form-group">
                    <label for="feature_one_name">Feature 1 Name</label>
                    <input type="text" class="form-control" id="feature_one_name" name="feature_one_name" placeholder="Enter Feature One Name" value="{{ $static->where('name','feature_one_name')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="feature_one_desc">Feature 1 Description</label>
                    <textarea class="form-control" id="feature_one_desc" name="feature_one_desc" placeholder="Enter Feature 1 Desc">{{ $static->where('name','feature_one_desc')->first()->value ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="feature_one_icon">Feature 1 Icon</label>
                    <select class="form-control" id="feature_one_icon" name="feature_one_icon">
                        <option value="">Select an Icon</option>
                        @foreach($svgFileNames as $file)
                            <option value="{{ $file }}" {{ $file == $featureOneIcon ? 'selected' : '' }}>
                                {{ $file }}
                            </option>
                        @endforeach
                    </select>
                    <div id="feature_one_preview">
                        @if($featureOneIcon && fileExistsInFolder($featureOneIcon, $svgFileNames))
                            <img src="{{ asset('features/' . $featureOneIcon) }}" width="50">
                        @else
                            <p class="text-danger">Selected icon not found.</p>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="feature_two_name">Feature 2 Name</label>
                    <input type="text" class="form-control" id="feature_two_name" name="feature_two_name" placeholder="Enter Feature 2 Name" value="{{ $static->where('name','feature_two_name')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="feature_two_desc">Feature 2 Description</label>
                    <textarea class="form-control" id="feature_two_desc" name="feature_two_desc" placeholder="Enter Feature 2 Desc">{{ $static->where('name','feature_two_desc')->first()->value ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="feature_two_icon">Feature 2 Icon</label>
                    <select class="form-control" id="feature_two_icon" name="feature_two_icon">
                        <option value="">Select an Icon</option>
                        @foreach($svgFileNames as $file)
                            <option value="{{ $file }}" {{ $file == $featureTwoIcon ? 'selected' : '' }}>
                                {{ $file }}
                            </option>
                        @endforeach
                    </select>
                    <div id="feature_two_preview">
                        @if($featureTwoIcon && fileExistsInFolder($featureTwoIcon, $svgFileNames))
                            <img src="{{ asset('features/' . $featureTwoIcon) }}" width="50">
                        @else
                            <p class="text-danger">Selected icon not found.</p>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="feature_three_name">Feature 3 Name</label>
                    <input type="text" class="form-control" id="feature_three_name" name="feature_three_name" placeholder="Enter Feature 3 Name" value="{{ $static->where('name','feature_three_name')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="feature_three_desc">Feature 3 Description</label>
                    <textarea class="form-control" id="feature_three_desc" name="feature_three_desc" placeholder="Enter Feature 3 Desc">{{ $static->where('name','feature_three_desc')->first()->value ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="feature_three_icon">Feature 3 Icon</label>
                    <select class="form-control" id="feature_three_icon" name="feature_three_icon">
                        <option value="">Select an Icon</option>
                        @foreach($svgFileNames as $file)
                            <option value="{{ $file }}" {{ $file == $featureThreeIcon ? 'selected' : '' }}>
                                {{ $file }}
                            </option>
                        @endforeach
                    </select>
                    <div id="feature_three_preview">
                        @if($featureThreeIcon && fileExistsInFolder($featureThreeIcon, $svgFileNames))
                            <img src="{{ asset('features/' . $featureThreeIcon) }}" width="50">
                        @else
                            <p class="text-danger">Selected icon not found.</p>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="feature_four_name">Feature 4 Name</label>
                    <input type="text" class="form-control" id="feature_four_name" name="feature_four_name" placeholder="Enter Feature 4 Name" value="{{ $static->where('name','feature_three_name')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="feature_four_desc">Feature 4 Description</label>
                    <textarea class="form-control" id="feature_four_desc" name="feature_four_desc" placeholder="Enter Feature 4 Desc">{{ $static->where('name','feature_three_desc')->first()->value ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="feature_four_icon">Feature 4 Icon</label>
                    <select class="form-control" id="feature_four_icon" name="feature_four_icon">
                        <option value="">Select an Icon</option>
                        @foreach($svgFileNames as $file)
                            <option value="{{ $file }}" {{ $file == $featureFourIcon ? 'selected' : '' }}>
                                {{ $file }}
                            </option>
                        @endforeach
                    </select>
                    <div id="feature_three_preview">
                        @if($featureFourIcon && fileExistsInFolder($featureFourIcon, $svgFileNames))
                            <img src="{{ asset('features/' . $featureFourIcon) }}" width="50">
                        @else
                            <p class="text-danger">Selected icon not found.</p>
                        @endif
                    </div>
                </div>

                <script>
                    function updatePreview(select, previewId) {
                        const preview = document.getElementById(previewId);
                        if (select.value) {
                            fetch(`/svg/${select.value}`, { method: 'HEAD' })
                                .then(response => {
                                    if (response.ok) {
                                        preview.innerHTML = `<img src="/svg/${select.value}" width="50">`;
                                    } else {
                                        preview.innerHTML = `<p class="text-danger">Selected icon not found.</p>`;
                                    }
                                })
                                .catch(() => {
                                    preview.innerHTML = `<p class="text-danger">Selected icon not found.</p>`;
                                });
                        } else {
                            preview.innerHTML = '';
                        }
                    }

                    document.getElementById('feature_one_icon').addEventListener('change', function() {
                        updatePreview(this, 'feature_one_preview');
                    });

                    document.getElementById('feature_two_icon').addEventListener('change', function() {
                        updatePreview(this, 'feature_two_preview');
                    });

                    document.getElementById('feature_three_icon').addEventListener('change', function() {
                        updatePreview(this, 'feature_three_preview');
                    });
                </script>


                <button type="submit" class="btn btn-primary">Save Changes</button>
            @endif
        </form>

        <script src="https://cdn.tiny.cloud/1/iax4ewixzv7hhs3hq5ybww77easwpi79ojl5ns3g1kty77ba/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
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

                forced_root_block: false,
                force_br_newlines: true,
                force_p_newlines: false,
                valid_elements: '*[*]',
            });

        </script>
    </div>
</div>
