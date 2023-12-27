@extends('layouts.dashboard')

@section('title')
    My Posts
@endsection

@section('content')
    <h1 class="h3 mb-3">Sejarah Umum</h1>

    <div class="row">
        <div class="col-12 col-md-6">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                    <strong>Successfull!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-8 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Sejarah Umum</h5>
                                </div>
                                <div class="table-responsive-xl">
                                    <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th class="d-xl-table-cell">No.</th>
                                                <th class="d-xl-table-cell">Deskripsi</th>
                                                <th class="d-xl-table-cell">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td class="d-xl-table-cell">{{ $loop->iteration }}</td>
                                                    <td class="d-xl-table-cell">{{ $row->description }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ url('/dashboard/sejarah_umum/edit/' . $row->id) }}"><span class="badge bg-success">Edit <i
                                                                        class="align-middle"
                                                                        data-feather="edit"></i></span></a> &nbsp;
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#error-alert').fadeTo(4000, 500).slideUp(500, function() {
                $('#error-alert').slideUp(500);
            });

            $('#success-alert').fadeTo(4000, 500).slideUp(500, function() {
                $('#success-alert').slideUp(500);
            });

            $('.btn-delete').on('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Post will be removed!',
                    text: 'Are you sure?',
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    focusConfirm: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(e.target).closest('form').submit()
                    } else {
                        swal.close()
                    }
                });
            });
        });
    </script>
@endpush
