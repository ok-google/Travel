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

<div class="modal fade" id="input-modal" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Terms &amp; Conditions</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <input type="hidden" id="tipe" name="tipe">
                    <input type="hidden" id="id_paket" name="id_paket">
                    <div class="js-wizard-simple block">

                        <!-- Step Tabs -->
                        <ul class="nav nav-tabs nav-tabs-alt nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#wizard-progress2-step1" data-toggle="tab">1. Paket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#wizard-progress2-step2" data-toggle="tab">2. Detail</a>
                            </li>
                        </ul>
                        <!-- END Step Tabs -->

                        <!-- Form -->
                            <!-- Steps Content -->
                            <div class="block-content block-content-full tab-content" style="min-height: 274px;">
                                <!-- Step 1 -->
                                <div class="tab-pane active" id="wizard-progress2-step1" role="tabpanel">
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id="wizard-progress2-firstname" name="wizard-progress2-firstname">
                                            <label for="wizard-progress2-firstname">Kode Booking</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="id_hotel" name="id_hotel" style="width: 100%;" data-placeholder="Pilih satu..">
                                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                </select>
                                                <label for="example2-select2">Paket</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="id_hotel" name="id_hotel" style="width: 100%;" data-placeholder="Pilih satu..">
                                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                </select>
                                                <label for="example2-select2">Customer</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="id_hotel" name="id_hotel" style="width: 100%;" data-placeholder="Pilih satu..">
                                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                </select>
                                                <label for="example2-select2">Keberangkatan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id="wizard-progress2-lastname" name="wizard-progress2-lastname">
                                            <label for="wizard-progress2-lastname">Nomor Tiket</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-material floating">
                                            <input class="form-control" type="text" id="wizard-progress2-lastname" name="wizard-progress2-lastname">
                                            <label for="wizard-progress2-lastname">Nomor Kamar</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Step 1 -->

                                <!-- Step 2 -->
                                <div class="tab-pane" id="wizard-progress2-step2" role="tabpanel">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <button id="btnTambahDetail" class="btn btn-primary pull-right">Tambah Detail</button>
                                        </div>
                                    </div>

                                    <div id='Details'></div>
                                </div>
                                <!-- END Step 2 -->
                            </div>
                            <!-- END Steps Content -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancel" class="btn btn-alt-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="btnSave" class="btn btn-alt-success">
                    <i class="fa fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customJS')
    <script src="{{ asset('ajax/transaksi/booking.js') }}"></script>
@endsection
