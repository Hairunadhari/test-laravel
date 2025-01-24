@extends('admin-page.layouts.app')
@section('content')
<div class="section-header">
    <h1 style="width:87%">Edit Pegawai</h1>
</div>
<div class="section-body">

    <div class="card">
        <div class="card-header">
            <h5>Form Edit Pegawai</h5>
        </div>
        <div class="card-body">
            <form action="/pegawai/update/{{$data->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Nama Depan <span style="color: red">*</span></label>
                    <input type="text" class="form-control" value="{{$data->nama_depan}}" name="nama_depan" required>
                </div>
                <div class="form-group">
                    <label>Nama Belakang <span style="color: red">*</span></label>
                    <input type="text" class="form-control" value="{{$data->nama_belakang}}" name="nama_belakang" required>
                </div>
                <div class="form-group">
                    <label>Email <span style="color: red">*</span></label>
                    <input type="email" class="form-control" value="{{$data->email}}" name="email" required>
                </div>
                <div class="form-group">
                    <label>No Hp <span style="color: red">*</span></label>
                    <input type="number" class="form-control" value="{{$data->no_hp}}" name="no_hp" required>
                </div>
                <div class="form-group">
                    <label>Alamat <span style="color: red">*</span></label>
                    <input type="string" class="form-control" value="{{$data->alamat}}" name="alamat" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin <span style="color: red">*</span></label>
                    <select name="j_kelamin" class="form-control" required>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
