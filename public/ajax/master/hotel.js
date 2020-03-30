function getAll(){
    $.ajax({
        url: $('#uri').val() + "hotel/getall",
        method: 'GET',

        success: function(result){
            $("#datatable").DataTable().clear();
            $("#datatable").DataTable().destroy();

            $.each(result, function(index) {
                var id = result[index]['id_hotel'];

                $('#datatable').dataTable().fnAddData( [
                    result[index]['aktif'] == 1 ? 'V': '',
                    result[index]['nama_hotel'],
                    result[index]['email'],
                    result[index]['telp'],
                    result[index]['alamat'],
                    result[index]['kota'],
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
        url: $('#uri').val() + "hotel/getbyid",
        method: 'GET',
        data: {
            id_hotel: id
        },

        success: function(result){
            $('#id_hotel').val(result[0]['id_hotel']);


            $('#nama_hotel').val(result[0]['nama_hotel']);
            if (result[0]['nama_hotel'] != '') {
                $('#nama_hotel').closest('.floating').addClass('open');
            } else {
                $('#nama_hotel').closest('.floating').removeClass('open');
            }

            $('#email').val(result[0]['email']);
            if (result[0]['email'] != '') {
                $('#email').closest('.floating').addClass('open');
            } else {
                $('#email').closest('.floating').removeClass('open');
            }

            $('#telp').val(result[0]['telp']);
            if (result[0]['telp'] != '') {
                $('#telp').closest('.floating').addClass('open');
            } else {
                $('#telp').closest('.floating').removeClass('open');
            }

            $('#alamat').val(result[0]['alamat']);
            if (result[0]['alamat'] != '') {
                $('#alamat').closest('.floating').addClass('open');
            } else {
                $('#alamat').closest('.floating').removeClass('open');
            }

            $('#kota').val(result[0]['kota']);
            if (result[0]['kota'] != '') {
                $('#kota').closest('.floating').addClass('open');
            } else {
                $('#kota').closest('.floating').removeClass('open');
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
        url: $('#uri').val() + "hotel/insert",
        method: 'post',
        data: {
            nama_hotel: $('#nama_hotel').val(),
            email: $('#email').val(),
            telp: $('#telp').val(),
            alamat: $('#alamat').val(),
            kota: $('#kota').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_hotel']){
                $('#Validate').text(result['responseJSON']['errors']['kode_hotel']);

            }
            else if (result['responseJSON']['errors']['nama_hotel']){
                $('#Validate').text(result['responseJSON']['errors']['nama_hotel']);

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
        url: $('#uri').val() + "hotel/update",
        method: 'post',
        data: {
            id_hotel: $('#id_hotel').val(),
            nama_hotel: $('#nama_hotel').val(),
            email: $('#email').val(),
            telp: $('#telp').val(),
            alamat: $('#alamat').val(),
            kota: $('#kota').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_hotel']){
                $('#Validate').text(result['responseJSON']['errors']['nama_hotel']);

            }
            else if (result['responseJSON']['errors']['nama_hotel']){
                $('#Validate').text(result['responseJSON']['errors']['nama_hotel']);

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
        url: $('#uri').val() + "hotel/delete",
        method: 'post',
        data: {
            id_hotel: id
        },
        success: function(result){

            getAll();
        }
    });
}

function clearModal(){
    $('#tipe').val('');
    $('#id_hotel').val('');
    $('#nama_hotel').val('');
    $('#email').val('');
    $('#telp').val('');
    $('#alamat').val('');
    $('#kota').val('');
    $('#aktif').prop('checked', true);
}

$( document ).ready(function(){
        var tipe;

        getAll();

        $('#btnTambah').click(function(){
            clearModal();

            $('#tipe').val('insert');
            if($('#tipe').val() == "insert"){
                $('#input-modal .block-title').text('Tambah Hotel');
                $('#kode_hotel').removeAttr("readonly", "");
            }

            $('#nama_hotel').closest('.floating').removeClass('open');
            $('#email').closest('.floating').removeClass('open');
            $('#telp').closest('.floating').removeClass('open');
            $('#alamat').closest('.floating').removeClass('open');
            $('#kota').closest('.floating').removeClass('open');

            $('#input-modal').modal('show');

        });

        $('#datatable').delegate('.btnUpdate', 'click', function(){
            var id = $.trim($( this ).attr('data-id'));

            getById(id);

            $('#tipe').val('update');
            if($('#tipe').val() == "update"){
                $('#input-modal .block-title').text('Update Hotel');
                $('#kode_hotel').attr("readonly", "");
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
