@extends('layouts.dashboard')

@section('title')
My Posts
@endsection

@section('content')
<h1 class="h3 mb-3">Alat Music</h1>

<div class="row">
    <div class="col-12 col-md-6">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <strong>Successfull!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Tambahkan Alat Musik Tradisional</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Tambahkan Kontent Edukasi Tentang Alat Musik Tradisional Sumbawa dengan cara klik tombol Tambah.</p>
                <a href="{{ route('posts.create') }}" class="card-link btn btn-dark">Tambah</a>
            </div>
        </div>
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
                                <h5 class="card-title mb-0">Latest Projects</h5>
                            </div>
                            <div class="table-responsive-xl">
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th class="d-xl-table-cell">No.</th>
                                            <th class="d-xl-table-cell">Nama Alat Music</th>
                                            <th class="d-xl-table-cell">link Vidio</th>
                                            <th class="d-xl-table-cell">image</th>
                                            <th class="d-xl-table-cell">Status</th>
                                            <th class="d-xl-table-cell text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                        <tr>
                                            <td class="d-xl-table-cell">{{ $loop->iteration }}</td>
                                            <td class="d-xl-table-cell">{{ $post->nama_alat }}</td>

                                            <td class="d-xl-table-cell"><iframe width="150" height="50%" src="https://www.youtube.com/embed/{{ $post->link }}">
                                                </iframe></td>
                                            <td class="d-xl-table-cell text-center"><img src="{{ asset($post->image) }}" alt="" width="50%"></td>
                                            <td class="d-xl-table-cell">
                                                <span id="statusToggle{{ $post->id }}" class="btn {{ $post->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                                    {{ $post->status == 1 ? 'Published' : 'Unpublished' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- <a href="{{ route('posts.show', $post->id) }}"><span class="badge bg-info">More <i class="align-middle" data-feather="maximize"></i></span></a> &nbsp; -->
                                                    <a href="{{ route('posts.edit', $post->id) }}"><span class="badge bg-success">Edit <i class="align-middle" data-feather="edit"></i></span></a> &nbsp;
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button" class="badge bg-danger text-white border-0 btn-delete" id="idBtnDelete"> Delete
                                                            <i class="align-middle" data-feather="trash"></i></button>
                                                    </form>
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
<script>
    $(document).ready(function() {
        $('[id^=statusToggle]').click(function() {
            var postId = $(this).attr('id').replace('statusToggle', '');

            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Ingin Mengubah Status Postingan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    updateStatus(postId);
                }
            });
        });

        function updateStatus(postId) {
            $.ajax({
                url: `{{ url('/dashboard/update-status/')}}` + postId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status == 1) {
                        $('#statusToggle' + postId)
                            .removeClass('btn-danger')
                            .addClass('btn-success')
                            .text('Published');
                    } else {
                        $('#statusToggle' + postId)
                            .removeClass('btn-success')
                            .addClass('btn-danger')
                            .text('Unpublished');
                    }
                },
                error: function(error) {
                    console.error('Error updating status:', error);
                }
            });
        }
    });
</script>
@endpush