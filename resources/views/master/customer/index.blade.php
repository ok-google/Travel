@extends('layout.app')

@section('content')
<div class="content">
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="javascript:void(0)">Customer</a>
        <span class="breadcrumb-item active">Customer</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Data Customer</small></h3>
            <button id="btnTambah" class="btn btn-primary pull-right">Tambah Data</button>
        </div>
        <div class="block-content block-content-full">
            <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th> Nama </th>
                        <th> Alamat </th>
                        <th> No HP </th>
                        <th> Email </th>
                        <th> Jenis Kelamin </th>
                        <th> Tanggal Lahir </th>
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
                    <input type="hidden" id="id_customer" name="id_customer">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="nama" name="nama">
                                <label for="material-text2">Nama</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="js-flatpickr form-control" id="tgl_lahir" name="tgl_lahir" data-allow-input="true" data-date-format="d-m-Y">
                                <label for="material-text2">Tanggal Lahir</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <select class="js-select2 form-control" id="jenis_kelamin" name="jenis_kelamin" style="width: 100%;" data-placeholder="Pilih satu..">
                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <option value="1"> Pria </option>
                                    <option value="2"> Wanita </option>
                                </select>
                                <label for="example2-select2">Jenis Kelamin</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                <label for="material-text2">Alamat</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="no_hp" name="no_hp">
                                <label for="material-text2">Telepon</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="email" class="form-control" id="email" name="email">
                                <label for="material-textarea-small2">E-mail</label>
                            </div>
                        </div>
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
    <script src="{{ asset('ajax/master/customer.js') }}"></script>
@endsection
