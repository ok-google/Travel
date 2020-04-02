function getAll(){
    $.ajax({
        url: $('#uri').val() + "pembayaran/getall",
        method: 'GET',

        success: function(result){
            $("#datatable").DataTable().clear();
            $("#datatable").DataTable().destroy();

            $.each(result, function(index) {
                var id = result[index]['id_pembayaran'];

                $('#datatable').dataTable().fnAddData( [
                    result[index]['aktif'] == 1 ? 'V': '',
                    result[index]['tgl_pembayaran'],
                    result[index]['bukti_pembayaran'],
                    result[index]['nominal'],
                    result[index]['file'],
                    '<button class="btn btn-info btnUpdate" data-id="'+id+'">' +
                    '<i class="fa fa-pencil"></i>' +
                    '</button>' +
                    '<button class="btn btn-danger btnDelete" data-id="'+id+'">' +
                    '<i class="fa fa-trash"></i>' +
                    '</button>'
                ]);
            });

        }
    });
}

function getById(id){
    $.ajax({
        url: $('#uri').val() + "pembayaran/getbyid",
        method: 'GET',
        data: {
            id_pembayaran: id
        },

        success: function(result){
            $('#id_pembayaran').val(result[0]['id_pembayaran']);


            $('#tgl_pembayaran').val(result[0]['tgl_pembayaran']);
            if (result[0]['nama'] != '') {
                $('#tgl_pembayaran').closest('.floating').addClass('open');
            } else {
                $('#tgl_pembayaran').closest('.floating').removeClass('open');
            }

            $('#bukti_pembayaran').val(result[0]['bukti_pembayaran']);
            if (result[0]['alammat'] != '') {
                $('#bukti_pembayaran').closest('.floating').addClass('open');
            } else {
                $('#bukti_pembayaran').closest('.floating').removeClass('open');
            }

            $('#nominal').val(result[0]['nominal']);
            if (result[0]['telp'] != '') {
                $('#nominal').closest('.floating').addClass('open');
            } else {
                $('#nominal').closest('.floating').removeClass('open');
            }

            $('#file').val(result[0]['file']);
            if (result[0]['email'] != '') {
                $('#file').closest('.floating').addClass('open');
            } else {
                $('#file').closest('.floating').removeClass('open');
            }

            $('#aktif').prop('checked', result[0]['aktif'] == 1 ? true : false);

           // $('#aktif').prop('checked', result[0]['aktif'] == 1 ? true : false);
        }
    });
}

function insert(e){
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: $('#uri').val() + "pembayaran/insert",
        method: 'post',
        data: {
            nama: $('#tgl_pembayaran').val(),
            alamat: $('#bukti_pembayaran').val(),
            no_hp: $('#nominal').val(),
            email: $('#file').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_pembayaran']){
                $('#Validate').text(result['responseJSON']['errors']['kode_pembayaran']);

            }
            else if (result['responseJSON']['errors']['nama_pembayaran']){
                $('#Validate').text(result['responseJSON']['errors']['nama_pembayaran']);

            }
        }
    });
}

function update(e){
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: $('#uri').val() + "pembayaran/update",
        method: 'post',
        data: {
            id_pembayaran: $('#id_pembayaran').val(),
            nama: $('#tgl_pembayaran').val(),
            alamat: $('#bukti_pembayaran').val(),
            no_hp: $('#nominal').val(),
            email: $('#file').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_pembayaran']){
                $('#Validate').text(result['responseJSON']['errors']['nama_pembayaran']);

            }
            else if (result['responseJSON']['errors']['nama_pembayaran']){
                $('#Validate').text(result['responseJSON']['errors']['nama_pembayaran']);

            }
        }
    });
}

function deleteData(e, id){
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: $('#uri').val() + "pembayaran/delete",
        method: 'post',
        data: {
            id_pembayaran: id
        },
        success: function(result){

            getAll();
        }
    });
}

function clearModal(){
    $('#tipe').val('');
    $('#id_pembayaran').val('');
    $('#nomor_tiket').val('');
    $('#nomor_kamar').val('');
    $('#tgl_pembayaran').val('');
    $('#tgl_batal').val('');
    $('#aktif').prop('checked', true);
}

$( document ).ready(function(){
        var tipe;

        getAll();

        $('#btnTambah').click(function(){
            clearModal();

            $('#tipe').val('insert');
            if($('#tipe').val() == "insert"){
                $('#input-modal .block-title').text('Tambah Booking');
                //$('#kode_pembayaran').removeAttr("readonly", "");
            }

            $('#nomor_tiket').closest('.floating').removeClass('open');
            $('#nomor_kamar').closest('.floating').removeClass('open');
            $('#tgl_pembayaran').closest('.floating').removeClass('open');
            $('#tgl_batal').closest('.floating').removeClass('open');

            $('#input-modal').modal('show');

        });

        $('#datatable').delegate('.btnUpdate', 'click', function(){
            var id = $.trim($( this ).attr('data-id'));

            getById(id);

            $('#tipe').val('update');
            if($('#tipe').val() == "update"){
                $('#input-modal .block-title').text('Update Paket');
                //$('#kode_pembayaran').attr("readonly", "");
            }

            $('#input-modal').modal('show');
        });

        $('#datatable').delegate('.btnDelete', 'click', function(e){
            var id = $.trim($( this ).attr('data-id'));

            swal(
                {
                    title: 'Anda yakin untuk menghapus data ini ?',
                    text: '',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success ConfirmDelete',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }
            ).then(function () {
                deleteData(e, id);

                swal(
                    'Terhapus!',
                    'Data berhasil dihapus.',
                    'success'
                )
            });
        });

        $('#btnSave').click(function(e){
            tipe = $('#tipe').val();
            if (tipe == "insert"){
                insert(e);
            }

            if (tipe == "update"){
                update(e);
            }

        });

        $('#btnCancel').click(function(){
            clearModal();
        });

        $('#btnCloseExcel').click(function(){
            clearModal();
        });

        $('#btnCancel').click(function(){
            clearModal();
            $('#Validate').text("");
            $('#input-modal').modal('hide');
        });
    });
