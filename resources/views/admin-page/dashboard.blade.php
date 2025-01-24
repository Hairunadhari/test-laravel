@extends('admin-page.layouts.app')
@section('content')
<!-- Main Content -->
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                   
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-mountain"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Destination</h4>
                        </div>
                        <div class="card-body">
                            {{$dest}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                   
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transactions</h4>
                        </div>
                        <div class="card-body">
                            {{$trans}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Users</h4>
                        </div>
                        <div class="card-body">
                            {{$user}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Transaction</h4>
                        <div class="card-header-action">
                            <a href="/admin/transactions" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Tanggal Keberangkatan</th>
                                </tr>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $data->firstItem() + $loop->index }}</td>
                                        <td>{{$item->nama_pemesan}}</td>
                                        <td><span class="badge badge-success">{{$item->status_pembayaran}}</span></td>
                                        <td>{{ date('d F Y', strtotime($item->tanggal_keberangkatan)) }}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="align-items-center text-center text-nowrap">Data Kosong</td>
                                </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>

@endsection
