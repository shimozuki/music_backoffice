@extends('layouts.dashboard')

@section('title')
    Create Post Page
@endsection

@section('content')
    <h1 class="mb-5 h3">Edit selected post</h1>

    <div class="row">
        <div class="col-12">
            {{-- @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                    <strong>Register Done!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Do something great!</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <form action="{{ route('posts.update', $data->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_alat" class="form-label">nama alat musik</label>
                                    <input type="text" name="nama_alat"
                                        class="form-control @error('nama_alat') is-invalid @enderror" id="nama_alat"
                                        value="{{ old('nama_alat', $data->nama_alat) }}" required autofocus>

                                    @error('nama_alat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="link" class="form-label">link</label>
                                    <input type="text" name="link" class="form-control @error('link') is-invalid @enderror"
                                        id="link" value="{{ old('link', $data->link) }}" required readonly>

                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" name="old_image" value="{{ $data->image }}">
                                    <label for="image" class="form-label">Posts banner image</label>
                                    @if ($data->image)
                                        <img src="{{ asset($data->image) }}" class="d-block img-preview img-fluid mb-3 col-sm-6">
                                    @else
                                        <img class="img-preview img-fluid mb-3 col-sm-6">
                                    @endif

                                    <input class="form-control @error('image') is-invalid @enderror" name="image"
                                        type="file" id="image" onchange="previewImage()">

                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="sejarah" class="form-label">sejarah</label>

                                    @error('sejarah')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="sejarah" type="hidden" name="sejarah" value="{{ old('sejarah', $data->sejarah) }}">
                                    <trix-editor input="sejarah"></trix-editor>
                                </div>
                                <div class="mb-3">
                                    <label for="perawatan" class="form-label">Cara perawatan</label>

                                    @error('perawatan')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="perawatan" type="hidden" name="perawatan" value="{{ old('perawatan', $data->perawatan) }}">
                                    <trix-editor input="perawatan"></trix-editor>
                                </div>
                                <div class="mb-3">
                                    <label for="tutorial" class="form-label">Tutorial</label>

                                    @error('tutorial')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="tutorial" type="hidden" name="tutorial" value="{{ old('tutorial', $data->tutorial) }}">
                                    <trix-editor input="tutorial"></trix-editor>
                                </div>
                                <div class="mb-3">
                                    <label for="pembuatan" class="form-label">Cara pembuatan</label>

                                    @error('pembuatan')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="pembuatan" type="hidden" name="pembuatan" value="{{ old('pembuatan', $data->pembuatan) }}">
                                    <trix-editor input="pembuatan"></trix-editor>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
