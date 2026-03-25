<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    @php
        $numberWords = [1 => 'one', 2 => 'two', 3 => 'three'];
    @endphp

    <form action="{{ route('adm.pgs.features.trans') }}" method="POST">
        @csrf

        @foreach ($static as $index => $feature)
            <input type="hidden" name="translations[{{ $index }}][feature_id]" value="{{ $feature->id }}">

            <div class="form-group mb-3 row">
                <label for="language_{{ $feature->id }}" class="col-sm-2 col-form-label">
                    Language:
                </label>
                <div class="col-sm-5">
                    <select class="form-control" id="language_{{ $feature->id }}" name="translations[{{ $index }}][language_id]">
                        @foreach ($languages as $lang)
                            <option value="{{ $lang->id }}" {{ old("translations.$index.language_id") == $lang->id ? 'selected' : '' }}>
                                {{ $lang->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label for="feature_{{ $feature->id }}_name" class="col-sm-2 col-form-label">
                    {{ $feature->name }}
                </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="feature_{{ $feature->id }}_translation"
                           name="translations[{{ $index }}][translation]"
                           placeholder="Enter translation for {{ $feature->name }}"
                           value="{{ old("translations.$index.translation") }}">
                </div>
                <div class="col-sm-5">
                <span class="form-control-plaintext">
                    {{ $feature->value ?? '(No Original Value)' }}
                </span>
                </div>
            </div>

            <div class="form-group mb-3 row">
                <label for="feature_{{ $feature->id }}_description" class="col-sm-2 col-form-label">
                    Description:
                </label>
                <div class="col-sm-10">
                <textarea class="form-control" id="feature_{{ $feature->id }}_description"
                          name="translations[{{ $index }}][description]"
                          placeholder="Enter description for {{ $feature->name }}">{{ old("translations.$index.description") }}</textarea>
                </div>
            </div>

            <hr>
        @endforeach

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>