@extends('layouts.admin')

@section('title', 'Pesanan')
@section('content')
    <div class="container-fluid col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class=" mb-0">Daftar Pesanan</h3>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pesanan Masuk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Pesanan</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Data pesanan akan diisi di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection