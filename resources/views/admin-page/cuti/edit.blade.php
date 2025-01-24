@extends('admin-page.layouts.app')
@section('content')
<div class="section-header">
    <h1 style="width:87%">Edit Cuti</h1>
</div>
<div class="section-body">

    <div class="card">
        <div class="card-header">
            <h5>Form Edit Cuti</h5>
        </div>
        <div class="card-body">
            <form action="/cuti/update/{{$data->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
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
                    <input type="string" value="{{$data->alasan}}" class="form-control" name="alasan" required>
                </div>
                <div class="form-group">
                    <label>Tgl mulai <span style="color: red">*</span></label>
                    <input type="date" value="{{$data->tgl_mulai}}" class="form-control" name="tgl_mulai" required>
                </div>
                <div class="form-group">
                    <label>Tgl Selesai <span style="color: red">*</span></label>
                    <input type="date" value="{{$data->tgl_selesai}}" class="form-control" name="tgl_selesai" required>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
