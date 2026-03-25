<hr>
<br>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form action="{{ route('adm.pgs.slider.trans') }}" method="POST">
            @csrf

            @php($counter = 0)
            @foreach ($sliders as $index => $slider)
            <!-- Hidden input for slider_id -->
            <input type="hidden" name="slider_id[{{ $index }}]" value="{{ $slider->id }}">

            <div class="form-group mb-3 row">
                <label for="slider_translate_title_{{ $index }}" class="col-sm-2 col-form-label">Slider Title:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="slider_translate_title_{{ $index }}"
                           name="slider_translate_title[{{ $index }}]"
                           value="{{ optional($slider->showTrans('en'))->slide_title ?? '' }}"
                           placeholder="Translate Title">
                </div>
                <div class="col-sm-5">
                    <span class="form-control-plaintext">{{ $slider->slide_title ?? '' }}</span>
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label for="slider_translate_subtitle_{{ $index }}" class="col-sm-2 col-form-label">Slider Subtitle:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="slider_translate_subtitle_{{ $index }}"
                           name="slider_translate_subtitle[{{ $index }}]"
                           value="{{ optional($slider->showTrans('en'))->slide_subtitle ?? '' }}"
                           placeholder="Translate Subtitle">
                </div>
                <div class="col-sm-5">
                    <span class="form-control-plaintext">{{ $slider->slide_subtitle ?? '' }}</span>
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label for="slider_translate_description_{{ $index }}" class="col-sm-2 col-form-label">Slider Description:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="slider_translate_description_{{ $index }}"
                           name="slider_translate_description[{{ $index }}]"
                           value="{{ optional($slider->showTrans('en'))->slide_description ?? '' }}"
                           placeholder="Translate Description">
                </div>
                <div class="col-sm-5">
                    <span class="form-control-plaintext">{{ $slider->slide_description ?? '' }}</span>
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label for="slider_translate_button1_text_{{ $index }}" class="col-sm-2 col-form-label">Button 1 Text:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="slider_translate_button1_text_{{ $index }}"
                           name="slider_translate_button1_text[{{ $index }}]"
                           value="{{ optional($slider->showTrans('en'))->button1_text ?? '' }}"
                           placeholder="Button 1 Text">
                </div>
                <div class="col-sm-5">
                    <span class="form-control-plaintext">{{ $slider->button1_text ?? '' }}</span>
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label for="slider_translate_button2_text_{{ $index }}" class="col-sm-2 col-form-label">Button 2 Text:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="slider_translate_button2_text_{{ $index }}"
                           name="slider_translate_button2_text[{{ $index }}]"
                           value="{{ optional($slider->showTrans('en'))->button2_text ?? '' }}"
                           placeholder="Button 2 Text">
                </div>
                <div class="col-sm-5">
                    <span class="form-control-plaintext">{{ $slider->button2_text ?? '' }}</span>
                </div>
            </div>

            <!-- Language Select -->
            <div class="form-group mb-3 row">
                <label for="language_{{ $index }}" class="col-sm-2 col-form-label">Language:</label>
                <div class="col-sm-5">
                    <select class="form-control" id="language_{{ $index }}" name="language[{{ $index }}]">
                        @foreach ($languages as $language)
                        <option value="{{ $language->code }}"
                                {{ optional($slider->showTrans($language->code))->language_code == $language->code ? 'selected' : '' }}>
                            {{ $language->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>
            @endforeach

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Translations</button>
            </div>
        </form>

        <hr>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Slider Title (English)</th>
                <th>Slider Subtitle (English)</th>
                <th>Slider Description (English)</th>
                <th>Button 1 (English)</th>
                <th>Button 2 (English)</th>
                @foreach ($languages2 as $language)
                <th>{{ $language->name }} Translation</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($sliders as $index => $slider)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $slider->slide_title }}</td>
                <td>{{ $slider->slide_subtitle }}</td>
                <td>{{ $slider->slide_description }}</td>
                <td>{{ $slider->button1_text }}</td>
                <td>{{ $slider->button2_text }}</td>

                @foreach ($languages2 as $lang)
                <?php $translation = optional($slider->showTrans($lang->code)); ?>
                <td>
                    <strong>Title:</strong> {{ $translation->slide_title ?? '' }}<br>
                    <strong>Subtitle:</strong> {{ $translation->slide_subtitle ?? '' }}<br>
                    <strong>Description:</strong> {{ $translation->slide_description ?? '' }}<br>
                    <strong>Button 1:</strong> {{ $translation->button1_text ?? '' }}<br>
                    <strong>Button 2:</strong> {{ $translation->button2_text ?? '' }}

                    @if ($translation)
                    <form action="{{ route('adm.pgs.slider.trans.delete') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="slider_id" value="{{ $slider->id }}">
                        <input type="hidden" name="language_code" value="{{ $lang->code }}">
                        <button type="submit" class="btn btn-danger btn-sm mt-1"
                                onclick="return confirm('Are you sure you want to delete this translation?');">
                            Delete
                        </button>
                    </form>
                    @endif
                </td>
                @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
