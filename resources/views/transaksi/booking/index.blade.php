@extends('layout.app')

@section('content')
<div class="content">
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="javascript:void(0)">Booking</a>
        <span class="breadcrumb-item active">Booking</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Data Booking</small></h3>
            <button id="btnTambah" class="btn btn-primary pull-right">Tambah Data</button>
        </div>
        <div class="block-content block-content-full">
            <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th> Aktif </th>
                        <th> Nama </th>
                        <th> Nomor Tiket </th>
                        <th> Nomor Kamar </th>
                        <th> Tanggal Booking </th>
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
    <script src="{{ asset('ajax/transaksi/booking.js') }}"></script>
@endsection
