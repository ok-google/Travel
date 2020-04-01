@extends('layout.app')

@section('content')
<div class="content">
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="javascript:void(0)">Home</a>
        <span class="breadcrumb-item active">Keberangkatan</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Data Keberangkatan</small></h3>
            <button id="btnTambah" class="btn btn-primary pull-right">Tambah Data</button>
        </div>
        <div class="block-content block-content-full">
            <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th> Tanggal Berangkat </th>
                        <th> Tanggal Pulang </th>
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
                    <input type="hidden" id="id_keberangkatan" name="id_keberangkatan">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="js-flatpickr form-control" id="tgl_berangkat" name="tgl_berangkat" data-allow-input="true" data-date-format="d-m-Y">
                                <label for="material-text2">Tanggal Berangkat</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="js-flatpickr form-control" id="tgl_pulang" name="tgl_pulang" data-allow-input="true" data-date-format="d-m-Y">
                                <label for="material-text2">Tanggal Pulang</label>
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
    <script src="{{ asset('ajax/master/keberangkatan.js') }}"></script>
@endsection
