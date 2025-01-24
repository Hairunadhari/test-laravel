@extends('admin-page.layouts.app')
@section('content')
<div class="section-header">
    <h1>Pegawai</h1>
  
</div>
<div class="section-body">
   

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="w-100">Table Pegawai</h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
                        <span class="text">+ Create</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="destinasi">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Email</th>
                                    <th>No Hp</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#destinasi').DataTable({
            // responsive: true,
            processing: true,
            ordering: false,
            serverSide: true,
            ajax: {
                url: '{{ url()->current() }}',
            },
            columns: [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "nama_depan",
                },
                {
                    data: "nama_belakang",
                },
                {
                    data: "email",
                },
                {
                    data: "no_hp",
                },
                {
                    data: "alamat",
                },
                {
                    data: "j_kelamin",
                },
                {
                    data: null,
                    render: function (data) {
                        var deleteUrl = '/pegawai/delete/' + data.id;
                        var editUrl = '/pegawai/edit/' + data.id;
                        return `
                        <form action="${deleteUrl}" method="POST" onsubmit="return confirm('mau hapus?');">
                            <span><a class="btn btn-primary" href="${editUrl}"><i class="far fa-edit"></i>Edit</a></span>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i> Hapus</button>
                        </form>
                        `;
                    },
                },

            ],
        });

    });

</script>
@endsection
@section('modal')
<!-- Modal -->

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Form Input Destinasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pegawai/submit" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Depan <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="nama_depan" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Belakang <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="nama_belakang" required>
                    </div>
                    <div class="form-group">
                        <label>Email <span style="color: red">*</span></label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>No Hp <span style="color: red">*</span></label>
                        <input type="number" class="form-control" name="no_hp" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat <span style="color: red">*</span></label>
                        <input type="string" class="form-control" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin <span style="color: red">*</span></label>
                        <select name="j_kelamin" class="form-control" required>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
