@section('styles')
    <style>
        #department_description_one_id,#department_description_two_id,#department_description_three_id,#department_description_four_id,#department_title_five_id,#department_description_five_id,#department_title_id,#department_header_id,#department_description_id,#department_title_one_id,#department_title_two_id,#department_title_three_id,#department_title_four_id {
            display: none;
        }
    </style>
@endsection

<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.departments.trans') }}">
            @csrf

            @php
                $numbersInWords = ['one', 'two', 'three', 'four', 'five'];
            @endphp

            <!-- Department Field -->
            <div class="form-group">
                <label for="department_trans">Department</label>
                <input type="text" class="form-control" id="department_trans" name="department_trans"
                       placeholder="Department" value="{{ old('department_trans') }}">
                <input type="number" class="form-control" id="department_header_id" name="department_header_id" value="{{ $static->where('name', 'department_header')->first()->id }}">
                <small class="form-text text-muted">Original: {{ $static->where('name', 'department_header')->first()->value ?? 'N/A' }}</small>
            </div>

            <!-- Language Select for Department -->
            <div class="form-group">
                <label for="department_trans_lang">Language</label>
                <select class="form-control" id="department_trans_lang" name="department_trans_lang">
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ old('department_trans_lang') == $language->id ? 'selected' : '' }}>
                            {{ $language->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Department Title Field -->
            <div class="form-group">
                <label for="department_title_trans">Department Title</label>
                <input type="text" class="form-control" id="department_title_trans" name="department_title_trans"
                       placeholder="Department Title"
                       value="{{ old('department_title_trans') }}">
                <input type="number" class="form-control" id="department_title_id" name="department_title_id" value="{{ $static->where('name', 'department_title')->first()->id }}">
                <small class="form-text text-muted">Original: {{ $static->where('name', 'department_title')->first()->value ?? 'N/A' }}</small>
            </div>

            <!-- Language Select for Department Title -->
            <div class="form-group">
                <label for="department_title_trans_lang">Language</label>
                <select class="form-control" id="department_title_trans_lang" name="department_title_trans_lang">
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ old('department_title_trans_lang') == $language->id ? 'selected' : '' }}>
                            {{ $language->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Department Description Field -->
            <div class="form-group">
                <label for="department_title_trans">Department Description</label>
                <input type="text" class="form-control" id="department_title_trans" name="department_description_trans"
                       placeholder="Department Description"
                       value="{{ old('department_description_trans') }}">
                <input type="number" class="form-control" id="department_description_id" name="department_description_id" value="{{ $static->where('name', 'department_description')->first()->id }}">
                <small class="form-text text-muted">Original: {{ $static->where('name', 'department_description')->first()->value ?? 'N/A' }}</small>
            </div>

            <!-- Language Select for Department Description -->
            <div class="form-group">
                <label for="department_description_trans_lang">Language</label>
                <select class="form-control" id="department_description_trans_lang" name="department_description_trans_lang">
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" {{ old('department_description_trans_lang') == $language->id ? 'selected' : '' }}>
                            {{ $language->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr>
            <br>

            @foreach ($numbersInWords as $word)
                @php
                    $currentTitleKey = "department_title_{$word}";
                    $currentDescKey = "department_description_{$word}";
                    $currentDescKeyId = "department_description_{$word}_id";
                    $currentTitleKeyId = "department_title_{$word}_id";
                @endphp

                <hr>
                <h3>Department {{ ucfirst($word) }} Translation</h3>

                <!-- Department Title Translation -->
                <div class="form-group">
                    <label for="department_title_{{ $word }}_trans">Department Title</label>
                    <input type="text" class="form-control" id="department_title_{{ $word }}_trans" name="department_title_{{ $word }}_trans"
                           placeholder="Department Title"
                           value="{{ old("department_title_{$word}_trans") ?? $static->where('name', $currentTitleKey)->first()->translation ?? '' }}">
                    <input type="number" class="form-control" id="department_title_{{ $word }}_id" name="department_title_{{ $word }}_id" value="{{ $static->where('name', $currentTitleKey)->first()->id }}">
                    <small class="form-text text-muted">Original: {{ $static->where('name', $currentTitleKey)->first()->value ?? 'N/A' }}</small>
                </div>

                <!-- Language Select for Title -->
                <div class="form-group">
                    <label for="department_title_{{ $word }}_lang">Language</label>
                    <select class="form-control" id="department_title_{{ $word }}_lang" name="department_title_{{ $word }}_lang">
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}" {{ old("department_title_{$word}_lang") == $language->id ? 'selected' : '' }}>
                                {{ $language->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Department Description Translation -->
                <div class="form-group">
                    <label for="department_description_{{ $word }}_trans">Department Description</label>
                    <input type="text" class="form-control" id="department_description_{{ $word }}_trans" name="department_description_{{ $word }}_trans"
                           placeholder="Department Description"
                           value="{{ old("department_description_{$word}_trans") ?? $static->where('name', $currentDescKey)->first()->translation ?? '' }}">
                    <input type="number" class="form-control" id="department_description_{{ $word }}_id" name="department_description_{{ $word }}_id" value="{{ $static->where('name', $currentDescKey)->first()->id }}">
                    <small class="form-text text-muted">Original: {{ $static->where('name', $currentDescKey)->first()->value ?? 'N/A' }}</small>
                </div>

                <!-- Language Select for Description -->
                <div class="form-group">
                    <label for="department_description_{{ $word }}_lang">Language</label>
                    <select class="form-control" id="department_description_{{ $word }}_lang" name="department_description_{{ $word }}_lang">
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}" {{ old("department_description_{$word}_lang") == $language->id ? 'selected' : '' }}>
                                {{ $language->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <hr>
            @endforeach

            <button type="submit" class="btn btn-primary">Save Translations</button>
        </form>
    </div>
</div>
