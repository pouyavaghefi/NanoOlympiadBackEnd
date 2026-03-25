@extends('layouts.master')

@section('title','Edit Slider')

@section('wrapper')
    <div class="row">
        @include('layouts.partials.alerts')

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <form method="POST" action="{{ route('adm.pgs.slider.update', $slider->id) }}" enctype="multipart/form-data">
                @csrf

                <!-- Current Slide Image -->
                <div class="form-group">
                    <label for="slideImage">Current Slider Image</label><br>
                    <img src="{{ asset('storage/' . $slider->slide_image) }}" alt="Slider Image" width="200" class="mb-2">
                    <p>{{ asset('storage/' . $slider->slide_image) }}</p>
                </div>

                <!-- Upload New Image -->
                <div class="form-group">
                    <label for="slideImage">Upload New Image (Optional)</label>
                    <input type="file" class="form-control" id="slideImage" name="slideImage" accept="image/*">
                    @error('slideImage')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slide Title -->
                <div class="form-group">
                    <label for="slideTitle">Slider Title</label>
                    <input type="text" class="form-control" id="slideTitle" name="slideTitle" value="{{ old('slideTitle', $slider->slide_title) }}" required>
                    @error('slideTitle')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slide Subtitle -->
                <div class="form-group">
                    <label for="slideSubtitle">Slider Subtitle</label>
                    <input type="text" class="form-control" id="slideSubtitle" name="slideSubtitle" value="{{ old('slideSubtitle', $slider->slide_subtitle) }}" required>
                    @error('slideSubtitle')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slide Description -->
                <div class="form-group">
                    <label for="slideDescription">Slider Description</label>
                    <textarea class="form-control" id="slideDescription" name="slideDescription" rows="3" required>{{ old('slideDescription', $slider->slide_description) }}</textarea>
                    @error('slideDescription')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button 1 Text -->
                <div class="form-group">
                    <label for="button1Text">Button 1 Text</label>
                    <input type="text" class="form-control" id="button1Text" name="button1Text" value="{{ old('button1Text', $slider->button1_text) }}">
                    @error('button1Text')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button 1 Link -->
                <div class="form-group">
                    <label for="button1Link">Button 1 Link</label>
                    <input type="url" class="form-control" id="button1Link" name="button1Link" value="{{ old('button1Link', $slider->button1_link) }}">
                    @error('button1Link')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button 2 Text -->
                <div class="form-group">
                    <label for="button2Text">Button 2 Text</label>
                    <input type="text" class="form-control" id="button2Text" name="button2Text" value="{{ old('button2Text', $slider->button2_text) }}">
                    @error('button2Text')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Button 2 Link -->
                <div class="form-group">
                    <label for="button2Link">Button 2 Link</label>
                    <input type="url" class="form-control" id="button2Link" name="button2Link" value="{{ old('button2Link', $slider->button2_link) }}">
                    @error('button2Link')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection