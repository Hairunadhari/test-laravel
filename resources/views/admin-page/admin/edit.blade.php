@extends('admin-page.layouts.app')
@section('content')
<div class="section-header">
    <h1 style="width:87%">Edit Admin</h1>
</div>
<div class="section-body">

    <div class="card">
        <div class="card-header">
            <h5>Form Edit Admin</h5>
        </div>
        <div class="card-body">
            <form action="/admin/update/{{$data->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Nama Depan <span style="color: red">*</span></label>
                    <input value="{{$data->nama_depan}}" type="text" class="form-control" name="nama_depan" required>
                </div>
                <div class="form-group">
                    <label>Nama Belakang <span style="color: red">*</span></label>
                    <input value="{{$data->nama_belakang}}" type="text" class="form-control" name="nama_belakang" required>
                </div>
                <div class="form-group">
                    <label>Email <span style="color: red">*</span></label>
                    <input value="{{$data->email}}" type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password <span style="color: red">*</span></label>
                    <input  type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label>Password Confirm <span style="color: red">*</span></label>
                    <input  type="password" class="form-control" name="password_confirm" required>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
