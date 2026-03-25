<div class="row">
    @include('layouts.partials.alerts')

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form method="POST" action="{{ route('adm.pgs.slider.info') }}" enctype="multipart/form-data">
            @csrf

            <!-- Slide Image -->
            <div class="form-group">
                <label for="slideImage">Slider Image</label>
                <input type="file" class="form-control" id="slideImage" name="slideImage" accept="image/*" value="{{ old('slideImage') }}" required>
                @error('slideImage')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Slide Title -->
            <div class="form-group">
                <label for="slideTitle">Slider Title</label>
                <input type="text" class="form-control" id="slideTitle" name="slideTitle" placeholder="Enter slide title" value="{{ old('slideTitle') }}" required>
                @error('slideTitle')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Slide Subtitle -->
            <div class="form-group">
                <label for="slideSubtitle">Slider Subtitle</label>
                <input type="text" class="form-control" id="slideSubtitle" name="slideSubtitle" placeholder="Enter slide subtitle" value="{{ old('slideSubtitle') }}" required>
                @error('slideSubtitle')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Slide Description -->
            <div class="form-group">
                <label for="slideDescription">Slider Description</label>
                <textarea class="form-control" id="slideDescription" name="slideDescription" rows="3" placeholder="Enter slide description" required>{{ old('slideDescription') }}</textarea>
                @error('slideDescription')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button 1 Text -->
            <div class="form-group">
                <label for="button1Text">Button 1 Text</label>
                <input type="text" class="form-control" id="button1Text" name="button1Text" placeholder="Enter text for button 1" value="{{ old('button1Text') }}">
                @error('button1Text')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button 1 Link -->
            <div class="form-group">
                <label for="button1Link">Button 1 Link</label>
                <input type="url" class="form-control" id="button1Link" name="button1Link" placeholder="Enter URL for button 1" value="{{ old('button1Link') }}">
                @error('button1Link')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button 2 Text -->
            <div class="form-group">
                <label for="button2Text">Button 2 Text</label>
                <input type="text" class="form-control" id="button2Text" name="button2Text" placeholder="Enter text for button 2" value="{{ old('button2Text') }}">
                @error('button2Text')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button 2 Link -->
            <div class="form-group">
                <label for="button2Link">Button 2 Link</label>
                <input type="url" class="form-control" id="button2Link" name="button2Link" placeholder="Enter URL for button 2" value="{{ old('button2Link') }}">
                @error('button2Link')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>
