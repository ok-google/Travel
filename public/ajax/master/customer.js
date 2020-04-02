function getAll(){
    $.ajax({
        url: $('#uri').val() + "customer/getall",
        method: 'GET',

        success: function(result){
            $("#datatable").DataTable().clear();
            $("#datatable").DataTable().destroy();

            $.each(result, function(index) {
                var id = result[index]['id_customer'];

                $('#datatable').dataTable().fnAddData( [
                    result[index]['nama'],
                    result[index]['alamat'],
                    result[index]['no_hp'],
                    result[index]['email'],
                    result[index]['jenis_kelamin'],
                    result[index]['tgl_lahir'],
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
        url: $('#uri').val() + "customer/getbyid",
        method: 'GET',
        data: {
            id_customer: id
        },

        success: function(result){
            $('#id_customer').val(result[0]['id_customer']);


            $('#nama').val(result[0]['nama']);
            if (result[0]['nama'] != '') {
                $('#nama').closest('.floating').addClass('open');
            } else {
                $('#nama').closest('.floating').removeClass('open');
            }

            $('#alamat').val(result[0]['alamat']);
            if (result[0]['alammat'] != '') {
                $('#alamat').closest('.floating').addClass('open');
            } else {
                $('#alamat').closest('.floating').removeClass('open');
            }

            $('#no_hp').val(result[0]['no_hp']);
            if (result[0]['telp'] != '') {
                $('#no_hp').closest('.floating').addClass('open');
            } else {
                $('#no_hp').closest('.floating').removeClass('open');
            }

            $('#email').val(result[0]['email']);
            if (result[0]['email'] != '') {
                $('#email').closest('.floating').addClass('open');
            } else {
                $('#email').closest('.floating').removeClass('open');
            }

            $('#jenis_kelamin').val(result[0]['jenis_kelamin']);
            if (result[0]['kota'] != '') {
                $('#jenis_kelamin').closest('.floating').addClass('open');
            } else {
                $('#jenis_kelamin').closest('.floating').removeClass('open');
            }

             $('#tgl_lahir').val(result[0]['tgl_lahir']);
            if (result[0]['kota'] != '') {
                $('#tgl_lahir').closest('.floating').addClass('open');
            } else {
                $('#tgl_lahir').closest('.floating').removeClass('open');
            }

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
        url: $('#uri').val() + "customer/insert",
        method: 'post',
        data: {
            nama: $('#nama').val(),
            alamat: $('#alamat').val(),
            no_hp: $('#no_hp').val(),
            email: $('#email').val(),
            jenis_kelamin: $('#jenis_kelamin').val(),
            tgl_lahir: $('#tgl_lahir').val()
            //aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_customer']){
                $('#Validate').text(result['responseJSON']['errors']['kode_customer']);

            }
            else if (result['responseJSON']['errors']['nama_customer']){
                $('#Validate').text(result['responseJSON']['errors']['nama_customer']);

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
        url: $('#uri').val() + "customer/update",
        method: 'post',
        data: {
            id_customer: $('#id_customer').val(),
            nama: $('#nama').val(),
            alamat: $('#alamat').val(),
            no_hp: $('#no_hp').val(),
            email: $('#email').val(),
            jenis_kelamin: $('#jenis_kelamin').val(),
            tgl_lahir: $('#tgl_lahir').val()
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_customer']){
                $('#Validate').text(result['responseJSON']['errors']['nama_customer']);

            }
            else if (result['responseJSON']['errors']['nama_customer']){
                $('#Validate').text(result['responseJSON']['errors']['nama_customer']);

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
        url: $('#uri').val() + "customer/delete",
        method: 'post',
        data: {
            id_customer: id
        },
        success: function(result){

            getAll();
        }
    });
}

function clearModal(){
    $('#tipe').val('');
    $('#id_customer').val('');
    $('#nama').val('');
    $('#alamat').val('');
    $('#no_hp').val('');
    $('#email').val('');
    $('#jenis_kelamin').val('');
    $('#tgl_lahir').val('');
}

$( document ).ready(function(){
        var tipe;

        getAll();

        $('#btnTambah').click(function(){
            clearModal();

            $('#tipe').val('insert');
            if($('#tipe').val() == "insert"){
                $('#input-modal .block-title').text('Tambah Customer');
                $('#kode_customer').removeAttr("readonly", "");
            }

            $('#nama').closest('.floating').removeClass('open');
            $('#alamat').closest('.floating').removeClass('open');
            $('#email').closest('.floating').removeClass('open');
            $('#no_hp').closest('.floating').removeClass('open');
            $('#jenis_kelamin').closest('.floating').removeClass('open');
            $('#tgl_lahir').closest('.floating').removeClass('open');


            $('#input-modal').modal('show');

        });

        $('#datatable').delegate('.btnUpdate', 'click', function(){
            var id = $.trim($( this ).attr('data-id'));

            getById(id);

            $('#tipe').val('update');
            if($('#tipe').val() == "update"){
                $('#input-modal .block-title').text('Update Customer');
                $('#kode_customer').attr("readonly", "");
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
