@extends('layouts.master')

@section('title','Features')

@section('wrapper')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a class="btn btn-secondary btn-block" style="color:white" href="{{ route('adm.pgs.features.info') }}">Features</a>
        </div>
    </div>

    <hr>
    <br>

    @include('layouts.includes.gadgets.feature-translations')

    <hr>
    <br>

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
    @foreach ($static as $index => $feature)
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
            <form action="{{ route('adm.pgs.features.trans.delete',$feature->id) }}" method="POST" class="d-inline">
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
@endsection
