function getAll(){
    $.ajax({
        url: $('#uri').val() + "keberangkatan/getall",
        method: 'GET',

        success: function(result){
            $("#datatable").DataTable().clear();
            $("#datatable").DataTable().destroy();

            $.each(result, function(index) {
                var id = result[index]['id_keberangkatan'];

                $('#datatable').dataTable().fnAddData( [
                    result[index]['tgl_berangkat'],
                    result[index]['tgl_pulang'],
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
        url: $('#uri').val() + "keberangkatan/getbyid",
        method: 'GET',
        data: {
            id_keberangkatan: id
        },

        success: function(result){
            $('#id_keberangkatan').val(result[0]['id_keberangkatan']);

            $('#tgl_berangkat').val(result[0]['tgl_berangkat']);
            if (result[0]['tgl_berangkat'] != '') {
                $('#tgl_berangkat').closest('.floating').addClass('open');
            } else {
                $('#tgl_berangkat').closest('.floating').removeClass('open');
            }

            $('#tgl_pulang').val(result[0]['tgl_pulang']);
            if (result[0]['tgl_pulang'] != '') {
                $('#tgl_pulang').closest('.floating').addClass('open');
            } else {
                $('#tgl_pulang').closest('.floating').removeClass('open');
            }
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
        url: $('#uri').val() + "keberangkatan/insert",
        method: 'post',
        data: {
            tgl_berangkat: $('#tgl_berangkat').val(),
            tgl_pulang: $('#tgl_pulang').val()
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['tgl_berangkat']){
                $('#Validate').text(result['responseJSON']['errors']['tgl_berangkat']);

            }
            else if (result['responseJSON']['errors']['tgl_pulang']){
                $('#Validate').text(result['responseJSON']['errors']['tgl_pulang']);

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
        url: $('#uri').val() + "keberangkatan/update",
        method: 'post',
        data: {
            id_keberangkatan: $('#id_keberangkatan').val(),
            tgl_berangkat: $('#tgl_berangkat').val(),
            tgl_pulang: $('#tgl_pulang').val()
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['tgl_berangkat']){
                $('#Validate').text(result['responseJSON']['errors']['tgl_pulang']);

            }
            else if (result['responseJSON']['errors']['tgl_pulang']){
                $('#Validate').text(result['responseJSON']['errors']['tgl_pulang']);

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
        url: $('#uri').val() + "keberangkatan/delete",
        method: 'post',
        data: {
            id_keberangkatan: id
        },
        success: function(result){

            getAll();
        }
    });
}

function clearModal(){
    $('#tipe').val('');
    $('#id_keberangkatan').val('');
    $('#tgl_berangkat').val('');
    $('#tgl_pulang').val('');
}

$( document ).ready(function(){
        var tipe;

        getAll();

        $('#btnTambah').click(function(){
            clearModal();

            $('#tipe').val('insert');
            if($('#tipe').val() == "insert"){
                $('#input-modal .block-title').text('Tambah Keberangkatan');
                $('#tgl_berangkat').removeAttr("readonly", "");
            }

            $('#tgl_berangkat').closest('.floating').removeClass('open');
            $('#tgl_pulang').closest('.floating').removeClass('open');

            $('#input-modal').modal('show');

        });

        $('#datatable').delegate('.btnUpdate', 'click', function(){
            var id = $.trim($( this ).attr('data-id'));

            getById(id);

            $('#tipe').val('update');
            if($('#tipe').val() == "update"){
                $('#input-modal .block-title').text('Update Keberangkatan');
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
