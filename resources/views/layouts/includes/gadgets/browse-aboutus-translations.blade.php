<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.aboutus.trans') }}">
            @csrf

            @foreach ($static as $item)
                <div class="form-group">
                    <!-- Display the original value -->
                    <label for="translation_{{ $item->id }}">{{ $item->name }}</label>
                    <small class="form-text text-muted">Original: {{ $item->value ?? 'N/A' }}</small>

                    <!-- Hidden input for static_page ID -->
                    <input type="hidden" name="translations[{{ $item->id }}][static_page_id]" value="{{ $item->id }}">

                    <!-- Translation input -->
                    <input type="text" class="form-control" id="translation_{{ $item->id }}"
                           name="translations[{{ $item->id }}][translation]"
                           placeholder="Enter translation"
                           value="{{ old("translations.{$item->id}.translation") }}">

                    <!-- Optional description input -->
                    <input type="text" class="form-control mt-2"
                           name="translations[{{ $item->id }}][description]"
                           placeholder="Enter description (optional)"
                           value="{{ old("translations.{$item->id}.description") }}">

                    <!-- Language selection dropdown -->
                    <select class="form-control mt-2" name="translations[{{ $item->id }}][language_id]">
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}" {{ old("translations.{$item->id}.language_id") == $language->id ? 'selected' : '' }}>
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