@foreach($countries as $country)
    @php
        $withoutExtension = pathinfo($country->flag, PATHINFO_FILENAME);
        $fullURL = env('URL_FRONT') . "/members/" . $withoutExtension;
    @endphp

    <form action="{{ route('adm.pgs.statics.update', $country->id) }}" method="POST" enctype="multipart/form-data" class="country-form">
        @csrf
        @method('PUT')

        <h3 class="mb-4" style="text-align: left">Edit Member Country #{{ $country->id }}</h3>

        <div class="mb-3">
            <label for="name_{{ $country->id }}" class="form-label">Country Name</label>
            <input type="text" class="form-control" id="name_{{ $country->id }}" name="name" value="{{ old('name', $country->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="country_url_{{ $country->id }}" class="form-label">Country URL</label>
            <input type="url" class="form-control" id="country_url_{{ $country->id }}" name="country_url" value="{{ old('country_url', $country->c_link) }}" placeholder="https://example.com">
        </div>

        <div class="mb-3">
            <label for="country_webpage_{{ $country->id }}" class="form-label">Members URL</label>
            <input type="url" class="form-control" id="country_webpage_{{ $country->id }}" name="country_webpage" value="@if($country->members_page == 1) {{ $fullURL }} @else N/A @endif" disabled="disabled">
        </div>

        <div class="mb-3">
            <label for="flag_{{ $country->id }}" class="form-label">Country Flag</label>
            <select class="form-control" id="flag_{{ $country->id }}" name="flag">
                <option value="">-- Select a flag --</option>
                @foreach($flags as $flag)
                    <option value="{{ $flag }}" {{ $country->flag == $flag ? 'selected' : '' }}>
                        {{ $flag }}
                    </option>
                @endforeach
            </select>

            @if($country->flag)
                <div class="mt-2">
                    <img src="{{ asset('members-country/' . $country->flag) }}" alt="{{ $country->name }}" width="100">
                    <button type="submit" class="btn btn-danger btn-sm mt-2" name="remove_flag" value="1">Remove Image</button>
                </div>
            @endif
        </div>

        @if($country->members_page == 1)
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="pinned_{{ $country->id }}" name="pinned" value="1" {{ $country->pinned ? 'checked' : '' }}>
            <label class="form-check-label" for="pinned_{{ $country->id }}">Pinned</label>
        </div>
        @endif

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="members_page_{{ $country->members_page }}" name="members_page" value="1" {{ $country->members_page ? 'checked' : '' }}>
            <label class="form-check-label" for="members_page_{{ $country->members_page }}">Show at members page</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Country</button>
    </form>
    <hr>
@endforeach

<!-- Add New Country Button -->
<button type="button" class="btn btn-success" id="add-new-country">+ Add New Country</button>

<!-- Template for New Country Form -->
<div id="new-country-template" style="display: none;">
    <form action="{{ route('adm.pgs.statics.store') }}" method="POST" enctype="multipart/form-data" class="country-form">
        @csrf
        <h3 class="mb-4" style="text-align: left">New Member Country</h3>

        <div class="mb-3">
            <label class="form-label">Country Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Country URL</label>
            <input type="url" class="form-control" name="country_url" placeholder="https://example.com">
        </div>

        <div class="mb-3">
            <label class="form-label">Country Flag</label>
            <select class="form-control" name="flag">
                <option value="">-- Select a flag --</option>
                @foreach($flags as $flag)
                    <option value="{{ $flag }}">{{ $flag }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="pinned" value="1">
            <label class="form-check-label">Pinned</label>
        </div>

        <button type="submit" class="btn btn-primary">Save Country</button>
        <button type="button" class="btn btn-danger remove-country-form">Remove</button>
    </form>
    <hr>
</div>

<!-- JavaScript for Adding New Form -->
<script>
    document.getElementById("add-new-country").addEventListener("click", function () {
        let template = document.getElementById("new-country-template").cloneNode(true);
        template.style.display = "block";
        template.removeAttribute("id");
        document.getElementById("add-new-country").insertAdjacentElement("beforebegin", template);

        // Remove new form on button click
        template.querySelector(".remove-country-form").addEventListener("click", function () {
            template.remove();
        });
    });
</script>
