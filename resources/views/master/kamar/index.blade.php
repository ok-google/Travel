@extends('layout.app')

@section('content')
<div class="content">
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="javascript:void(0)">Home</a>
        <span class="breadcrumb-item active">Kamar</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Data Kamar</small></h3>
            <button id="btnTambah" class="btn btn-primary pull-right">Tambah Data</button>
        </div>
        <div class="block-content block-content-full">
            <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th> Aktif </th>
                        <th> Nama Hotel </th>
                        <th> Kelas Kamar </th>
                        <th> Jumlah Bed </th>
                        <th> Harga </th>
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
                    <input type="hidden" id="id_kamar" name="id_kamar">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material">
                                <select class="js-select2 form-control" id="id_hotel" name="id_hotel" style="width: 100%;" data-placeholder="Pilih satu..">
                                    <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                </select>
                                <label for="example2-select2">Hotel</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="kelas_kamar" name="kelas_kamar">
                                <label for="material-text2">Kelas Kamar</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="jml_bed" name="jml_bed">
                                <label for="material-text2">Jumlah Bed</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="harga" name="harga">
                                <label for="material-text2">Harga</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label class="css-control css-control-sm css-control-success css-switch">
                                <input type="checkbox" id="aktif" class="css-control-input" checked>
                                <span class="css-control-indicator"></span> Aktif
                            </label>
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
    <script src="{{ asset('ajax/master/kamar.js') }}"></script>
@endsection
