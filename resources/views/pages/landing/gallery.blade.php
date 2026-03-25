@extends('layouts.master')

@section('title','Gallery')

@section('wrapper')
    @include('layouts.includes.gadgets.photo-gallery')
@endsection

@section('styles')
    <style>
        .gallery-item {
            position: relative;
            width: 100%;
            margin-bottom: 25px;
        }

        .gallery-img {
            height: 100%;
        }

        .gallery-img img {
            width: 100%;
            border-radius: 50px 50px 50px 0;
        }

        .gallery-content {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .gallery-content::before {
            content: "";
            position: absolute;
            left: 10px;
            top: 10px;
            right: 10px;
            bottom: 10px;
            background: var(--theme-color2);
            border-radius: 50px 50px 50px 0;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s;
        }

        .gallery-content:hover::before {
            opacity: 0.9;
            visibility: visible
        }

        .gallery-link {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 0.5s;
            border-radius: 50px;
            opacity: 0;
            visibility: hidden;
            font-size: 60px;
            color: var(--color-white);
        }

        .gallery-link:hover {
            color: var(--color-white);
        }

        .gallery-content:hover .gallery-link {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }
    </style>
@endsection

@section('scripts')
    <script>
        function previewImage(index) {
            const fileInput = document.getElementById('file-upload-' + index);
            const imgElement = document.getElementById('gallery-img-' + index);

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imgElement.src = e.target.result; // Update the image source with the uploaded file
                };

                reader.readAsDataURL(fileInput.files[0]); // Convert the file to a data URL
            }
        }
    </script>
@endsection
