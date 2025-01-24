@extends('admin-page.layouts.app')
@section('content')
<div class="section-header">
    <h1>Cuti</h1>
  
</div>
<div class="section-body">
   

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="w-100">Table Cuti</h4>
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
                                    <th>Nama</th>
                                    <th>Alasan</th>
                                    <th>Tgl Mulai</th>
                                    <th>Tgl Selesai</th>
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
                    data: "user.nama_depan",
                },
                
                {
                    data: "alasan",
                },
                {
                    data: "tgl_mulai",
                },
                {
                    data: "tgl_selesai",
                },
               
                {
                    data: null,
                    render: function (data) {
                        var deleteUrl = '/cuti/delete/' + data.id;
                        var editUrl = '/cuti/edit/' + data.id;
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
            <form action="/cuti/submit" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pegawai <span style="color: red">*</span></label>
                        <select name="user_id" class="form-control" required>
                            @foreach ($pegawai as $item)
                                <option value="{{$item->id}}">{{$item->nama_depan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alasan <span style="color: red">*</span></label>
                        <input type="string" class="form-control" name="alasan" required>
                    </div>
                    <div class="form-group">
                        <label>Tgl mulai <span style="color: red">*</span></label>
                        <input type="date" class="form-control" name="tgl_mulai" required>
                    </div>
                    <div class="form-group">
                        <label>Tgl Selesai <span style="color: red">*</span></label>
                        <input type="date" class="form-control" name="tgl_selesai" required>
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
