function getAll(){
    $.ajax({
        url: $('#uri').val() + "penerbangan/getall",
        method: 'GET',

        success: function(result){
            $("#datatable").DataTable().clear();
            $("#datatable").DataTable().destroy();

            $.each(result, function(index) {
                var id = result[index]['id_penerbangan'];

                $('#datatable').dataTable().fnAddData( [
                    result[index]['aktif'] == 1 ? 'V': '',
                    result[index]['kode_penerbangan'],
                    result[index]['nama_penerbangan'],
                    result[index]['keterangan'],
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
        url: $('#uri').val() + "penerbangan/getbyid",
        method: 'GET',
        data: {
            id_penerbangan: id
        },

        success: function(result){
            $('#id_penerbangan').val(result[0]['id_penerbangan']);

            $('#kode_penerbangan').val(result[0]['kode_penerbangan']);
            if (result[0]['kode_penerbangan'] != '') {
                $('#kode_penerbangan').closest('.floating').addClass('open');
            } else {
                $('#kode_penerbangan').closest('.floating').removeClass('open');
            }

            $('#nama_penerbangan').val(result[0]['nama_penerbangan']);
            if (result[0]['nama_penerbangan'] != '') {
                $('#nama_penerbangan').closest('.floating').addClass('open');
            } else {
                $('#nama_penerbangan').closest('.floating').removeClass('open');
            }

            $('#keterangan').val(result[0]['keterangan']);
            if (result[0]['nama_penerbangan'] != '') {
                $('#keterangan').closest('.floating').addClass('open');
            } else {
                $('#keterangan').closest('.floating').removeClass('open');
            }

            $('#aktif').prop('checked', result[0]['aktif'] == 1 ? true : false);
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
        url: $('#uri').val() + "penerbangan/insert",
        method: 'post',
        data: {
            kode_penerbangan: $('#kode_penerbangan').val(),
            nama_penerbangan: $('#nama_penerbangan').val(),
            keterangan: ($('#keterangan').val() == "" ? "" : $('#keterangan').val()),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_penerbangan']){
                $('#Validate').text(result['responseJSON']['errors']['kode_penerbangan']);

            }
            else if (result['responseJSON']['errors']['nama_penerbangan']){
                $('#Validate').text(result['responseJSON']['errors']['nama_penerbangan']);

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
        url: $('#uri').val() + "penerbangan/update",
        method: 'post',
        data: {
            id_penerbangan: $('#id_penerbangan').val(),
            kode_penerbangan: $('#kode_penerbangan').val(),
            nama_penerbangan: $('#nama_penerbangan').val(),
            keterangan: $('#keterangan').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_penerbangan']){
                $('#Validate').text(result['responseJSON']['errors']['nama_penerbangan']);

            }
            else if (result['responseJSON']['errors']['nama_penerbangan']){
                $('#Validate').text(result['responseJSON']['errors']['nama_penerbangan']);

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
        url: $('#uri').val() + "penerbangan/delete",
        method: 'post',
        data: {
            id_penerbangan: id
        },
        success: function(result){

            getAll();
        }
    });
}

function clearModal(){
    $('#tipe').val('');
    $('#id_penerbangan').val('');
    $('#kode_penerbangan').val('');
    $('#nama_penerbangan').val('');
    $('#keterangan').val('');
    $('#aktif').prop('checked', true);
}

$( document ).ready(function(){
        var tipe;

        getAll();

        $('#btnTambah').click(function(){
            clearModal();

            $('#tipe').val('insert');
            if($('#tipe').val() == "insert"){
                $('#input-modal .block-title').text('Tambah Penerbangan');
                $('#kode_penerbangan').removeAttr("readonly", "");
            }

            $('#kode_penerbangan').closest('.floating').removeClass('open');
            $('#nama_penerbangan').closest('.floating').removeClass('open');
            $('#keterangan').closest('.floating').removeClass('open');

            $('#input-modal').modal('show');

        });

        $('#datatable').delegate('.btnUpdate', 'click', function(){
            var id = $.trim($( this ).attr('data-id'));

            getById(id);

            $('#tipe').val('update');
            if($('#tipe').val() == "update"){
                $('#input-modal .block-title').text('Update Penerbangan');
                $('#kode_penerbangan').attr("readonly", "");
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
