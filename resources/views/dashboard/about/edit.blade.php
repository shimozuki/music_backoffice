@extends('layouts.dashboard')

@section('title')
    Create Category Page
@endsection

@section('content')
    <h1 class="mb-5 h3">Edit Tentang Aplikasi</h1>

    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                    <strong>Successfull!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Tentang Aplikasi</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <form action="{{ route('about.update', $data->id) }}" method="post">
                                @method('patch')
                                @csrf
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>

                                    @error('description')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="description" type="hidden" name="description" value="{{ old('description', $data->description) }}">
                                    <trix-editor input="description"></trix-editor>
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
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch('/dashboard/categories/checkSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        $(document).ready(function () {
            $('#error-alert').fadeTo(4000, 500).slideUp(500, function() {
                $('#error-alert').slideUp(500);
            });

            $('#success-alert').fadeTo(4000, 500).slideUp(500, function() {
                $('#success-alert').slideUp(500);
            });
        });
    </script>
@endpush
