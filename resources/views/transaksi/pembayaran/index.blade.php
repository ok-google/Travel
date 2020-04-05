@extends('layout.app')

@section('content')
<div class="content">
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="javascript:void(0)">Booking</a>
        <span class="breadcrumb-item active">Pembayaran</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Data Pembayaran</small></h3>
            <button id="btnTambah" class="btn btn-primary pull-right">Tambah Data</button>
        </div>
        <div class="block-content block-content-full">
            <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th> Aktif </th>
                        <th> Tanggal Pembayaran </th>
                        <th> Bukti Pembayaran </th>
                        <th> Nominal </th>
                        <th> File </th>
                        <th> Aksi </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection

@section('customJS')
    <script src="{{ asset('ajax/transaksi/pembayaran.js') }}"></script>
@endsection
