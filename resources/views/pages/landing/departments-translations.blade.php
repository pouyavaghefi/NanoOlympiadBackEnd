@extends('layouts.master')

@section('title','Department Translations')

@section('wrapper')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a href="{{ route('adm.pgs.departments.info') }}" class="btn btn-secondary btn-block" style="color:white">
                Departments
            </a>
        </div>
    </div>

    <hr>
    <br>

    @include('layouts.includes.gadgets.browse-departments-translations')

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Department Name</th>
            @foreach ($languages2 as $language)
                <th>{{ $language->name }} Translation</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($itemsMenu as $index => $department)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $department->name }}</td>

                @foreach ($languages2 as $lang)
                        <?php
                        $translation = $department->translationsDep->where('language_id', $lang->id)->first();
                        ?>
                    <td>
                        <strong>Translation:</strong> {{ $translation->translation ?? '—' }}<br>
                        <strong>Description:</strong> {{ $translation->description ?? '—' }}

                        @if ($translation)
                            <form action="{{ route('adm.pgs.departments.trans.delete', $department->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="department_id" value="{{ $department->id }}">
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
