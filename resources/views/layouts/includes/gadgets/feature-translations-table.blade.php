<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Feature Name</th>
        @foreach ($languages2 as $language)
            <th>{{ $language->name }} Translation</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach ($features as $index => $feature)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $feature->name }}</td>

            @foreach ($languages2 as $lang)
                    <?php
                    $translation = $feature->translations->where('language_id', $lang->id)->first();
                    ?>
                <td>
                    <strong>Translation:</strong> {{ $translation->translation ?? '—' }}<br>
                    <strong>Description:</strong> {{ $translation->feature_description ?? '—' }}

                    @if ($translation)
                        <form action="{{ route('adm.pgs.departments.trans.delete', $feature->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="feature_id" value="{{ $feature->id }}">
                            <input type="hidden" name="language_id" value="{{ $lang->id }}">
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
