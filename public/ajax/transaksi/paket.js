function getAll(){
    $.ajax({
        url: $('#uri').val() + "paket/getall",
        method: 'GET',

        success: function(result){
            $("#datatable").DataTable().clear();
            $("#datatable").DataTable().destroy();

            $.each(result, function(index) {
                var id = result[index]['id_paket'];

                $('#datatable').dataTable().fnAddData( [
                    result[index]['aktif'] == 1 ? 'V': '',
                    result[index]['nama_paket'],
                    result[index]['kategori_paket'],
                    result[index]['harga'],
                    result[index]['durasi'],
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
        url: $('#uri').val() + "paket/getbyid",
        method: 'GET',
        data: {
            id_paket: id
        },

        success: function(result){
            $('#id_paket').val(result[0]['id_paket']);


            $('#nama_paket').val(result[0]['nama_paket']);
            if (result[0]['nama'] != '') {
                $('#nama_paket').closest('.floating').addClass('open');
            } else {
                $('#nama_paket').closest('.floating').removeClass('open');
            }

            $('#kategori_paket').val(result[0]['kategori_paket']);
            if (result[0]['alammat'] != '') {
                $('#kategori_paket').closest('.floating').addClass('open');
            } else {
                $('#kategori_paket').closest('.floating').removeClass('open');
            }

            $('#harga').val(result[0]['harga']);
            if (result[0]['telp'] != '') {
                $('#harga').closest('.floating').addClass('open');
            } else {
                $('#harga').closest('.floating').removeClass('open');
            }

            $('#durasi').val(result[0]['durasi']);
            if (result[0]['email'] != '') {
                $('#durasi').closest('.floating').addClass('open');
            } else {
                $('#durasi').closest('.floating').removeClass('open');
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
        url: $('#uri').val() + "paket/insert",
        method: 'post',
        data: {
            nama: $('#nama_paket').val(),
            alamat: $('#kategori_paket').val(),
            no_hp: $('#harga').val(),
            email: $('#durasi').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_paket']){
                $('#Validate').text(result['responseJSON']['errors']['kode_paket']);

            }
            else if (result['responseJSON']['errors']['nama_paket']){
                $('#Validate').text(result['responseJSON']['errors']['nama_paket']);

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
        url: $('#uri').val() + "paket/update",
        method: 'post',
        data: {
            id_paket: $('#id_paket').val(),
             nama: $('#nama_paket').val(),
            alamat: $('#kategori_paket').val(),
            no_hp: $('#harga').val(),
            email: $('#durasi').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_paket']){
                $('#Validate').text(result['responseJSON']['errors']['nama_paket']);

            }
            else if (result['responseJSON']['errors']['nama_paket']){
                $('#Validate').text(result['responseJSON']['errors']['nama_paket']);

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
        url: $('#uri').val() + "paket/delete",
        method: 'post',
        data: {
            id_paket: id
        },
        success: function(result){

            getAll();
        }
    });
}

function clearModal(){
    $('#tipe').val('');
    $('#id_paket').val('');
    $('#nama_paket').val('');
    $('#kategori_paket').val('');
    $('#harga').val('');
    $('#durasi').val('');
    $('#aktif').prop('checked', true);
}

$( document ).ready(function(){
        var tipe;

        getAll();

        $('#btnTambah').click(function(){
            clearModal();

            $('#tipe').val('insert');
            if($('#tipe').val() == "insert"){
                $('#input-modal .block-title').text('Tambah Paket');
                //$('#kode_paket').removeAttr("readonly", "");
            }

            $('#nama_paket').closest('.floating').removeClass('open');
            $('#kategori_paket').closest('.floating').removeClass('open');
            $('#harga').closest('.floating').removeClass('open');
            $('#durasi').closest('.floating').removeClass('open');

            $('#input-modal').modal('show');

        });

        $('#datatable').delegate('.btnUpdate', 'click', function(){
            var id = $.trim($( this ).attr('data-id'));

            getById(id);

            $('#tipe').val('update');
            if($('#tipe').val() == "update"){
                $('#input-modal .block-title').text('Update Paket');
                //$('#kode_paket').attr("readonly", "");
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
