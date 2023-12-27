@extends('layouts.dashboard')

@section('title')
    Tambah Alat Musik
@endsection

@section('content')
    <h1 class="mb-5 h3">Tambah Alat Music</h1>

    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                    <strong>Register Done!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Silahkan Isi form di bawah ini!</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <form action="{{ url('/dashboard/post/create') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Nama Alat Music</label>
                                    <input type="text" name="nama_alat"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        value="{{ old('title') }}" required autofocus>

                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Link Vidio</label>
                                    <input type="text" name="link" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" value="{{ old('slug') }}" required>

                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">image</label>
                                    <img class="img-preview img-fluid mb-3 col-sm-6">

                                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file" id="image" onchange="previewImage()">

                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="sejarah" class="form-label">Sejarah</label>

                                    @error('sejarah')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="sejarah" type="hidden" name="sejarah" value="{{ old('sejarah') }}">
                                    <trix-editor input="sejarah"></trix-editor>
                                </div>
                                <div class="mb-3">
                                    <label for="perawatan" class="form-label">Cara Perawatan</label>

                                    @error('perawatan')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="perawatan" type="hidden" name="perawatan" value="{{ old('perawatan') }}">
                                    <trix-editor input="perawatan"></trix-editor>
                                </div>
                                <div class="mb-3">
                                    <label for="tutorial" class="form-label">Tutorial</label>

                                    @error('tutorial')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="tutorial" type="hidden" name="tutorial" value="{{ old('tutorial') }}">
                                    <trix-editor input="tutorial"></trix-editor>
                                </div>
                                <div class="mb-3">
                                    <label for="pembuatan" class="form-label">Cara Pembuatan</label>

                                    @error('pembuatan')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="pembuatan" type="hidden" name="pembuatan" value="{{ old('pembuatan') }}">
                                    <trix-editor input="pembuatan"></trix-editor>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
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
        // preview Image
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
