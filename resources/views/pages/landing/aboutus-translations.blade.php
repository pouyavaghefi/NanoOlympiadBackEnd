@extends('layouts.master')

@section('title','Department Translations')

@section('wrapper')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a href="{{ route('adm.pgs.aboutus.info') }}" class="btn btn-secondary btn-block" style="color:white">
                Aboutus
            </a>
        </div>
    </div>

    <hr>
    <br>

    @include('layouts.includes.gadgets.browse-aboutus-translations')

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Aboutus Field</th>
            @foreach ($languages2 as $language)
                <th>{{ $language->name }} Translation</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($static as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>

                @foreach ($languages2 as $lang)
                        <?php
                        $translation = $item->aboutusTranslations->where('language_id', $lang->id)->first();
                        ?>
                    <td>
                        <strong>Translation:</strong> {{ $translation->translation ?? '—' }}<br>
                        <strong>Description:</strong> {{ $translation->description ?? '—' }}

                        @if ($translation)
                            <form action="{{ route('adm.pgs.aboutus.trans.delete', $translation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
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
