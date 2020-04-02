function getAll(){
    $.ajax({
        url: $('#uri').val() + "booking/getall",
        method: 'GET',

        success: function(result){
            $("#datatable").DataTable().clear();
            $("#datatable").DataTable().destroy();

            $.each(result, function(index) {
                var id = result[index]['id_booking'];

                $('#datatable').dataTable().fnAddData( [
                    result[index]['aktif'] == 1 ? 'V': '',
                    result[index]['nomor_tiket'],
                    result[index]['nomor_kamar'],
                    result[index]['tgl_booking'],
                    result[index]['tgl_batal'],
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
        url: $('#uri').val() + "booking/getbyid",
        method: 'GET',
        data: {
            id_booking: id
        },

        success: function(result){
            $('#id_booking').val(result[0]['id_booking']);


            $('#nomor_tiket').val(result[0]['nomor_tiket']);
            if (result[0]['nama'] != '') {
                $('#nomor_tiket').closest('.floating').addClass('open');
            } else {
                $('#nomor_tiket').closest('.floating').removeClass('open');
            }

            $('#nomor_kamar').val(result[0]['nomor_kamar']);
            if (result[0]['alammat'] != '') {
                $('#nomor_kamar').closest('.floating').addClass('open');
            } else {
                $('#nomor_kamar').closest('.floating').removeClass('open');
            }

            $('#tgl_booking').val(result[0]['tgl_booking']);
            if (result[0]['telp'] != '') {
                $('#tgl_booking').closest('.floating').addClass('open');
            } else {
                $('#tgl_booking').closest('.floating').removeClass('open');
            }

            $('#tgl_batal').val(result[0]['tgl_batal']);
            if (result[0]['email'] != '') {
                $('#tgl_batal').closest('.floating').addClass('open');
            } else {
                $('#tgl_batal').closest('.floating').removeClass('open');
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
        url: $('#uri').val() + "booking/insert",
        method: 'post',
        data: {
            nama: $('#nomor_tiket').val(),
            alamat: $('#nomor_kamar').val(),
            no_hp: $('#tgl_booking').val(),
            email: $('#tgl_batal').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_booking']){
                $('#Validate').text(result['responseJSON']['errors']['kode_booking']);

            }
            else if (result['responseJSON']['errors']['nama_booking']){
                $('#Validate').text(result['responseJSON']['errors']['nama_booking']);

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
        url: $('#uri').val() + "booking/update",
        method: 'post',
        data: {
            id_booking: $('#id_booking').val(),
             nama: $('#nomor_tiket').val(),
            alamat: $('#nomor_kamar').val(),
            no_hp: $('#tgl_booking').val(),
            email: $('#tgl_batal').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_booking']){
                $('#Validate').text(result['responseJSON']['errors']['nama_booking']);

            }
            else if (result['responseJSON']['errors']['nama_booking']){
                $('#Validate').text(result['responseJSON']['errors']['nama_booking']);

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
        url: $('#uri').val() + "booking/delete",
        method: 'post',
        data: {
            id_booking: id
        },
        success: function(result){

            getAll();
        }
    });
}

function clearModal(){
    $('#tipe').val('');
    $('#id_booking').val('');
    $('#nomor_tiket').val('');
    $('#nomor_kamar').val('');
    $('#tgl_booking').val('');
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
                //$('#kode_booking').removeAttr("readonly", "");
            }

            $('#nomor_tiket').closest('.floating').removeClass('open');
            $('#nomor_kamar').closest('.floating').removeClass('open');
            $('#tgl_booking').closest('.floating').removeClass('open');
            $('#tgl_batal').closest('.floating').removeClass('open');

            $('#input-modal').modal('show');

        });

        $('#datatable').delegate('.btnUpdate', 'click', function(){
            var id = $.trim($( this ).attr('data-id'));

            getById(id);

            $('#tipe').val('update');
            if($('#tipe').val() == "update"){
                $('#input-modal .block-title').text('Update Paket');
                //$('#kode_booking').attr("readonly", "");
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
