function getAll(){
    $.ajax({
        url: $('#uri').val() + "kamar/getall",
        method: 'GET',

        success: function(result){
            $("#datatable").DataTable().clear();
            $("#datatable").DataTable().destroy();

            $.each(result, function(index) {
                var id = result[index]['id_kamar'];

                $('#datatable').dataTable().fnAddData( [
                    result[index]['aktif'] == 1 ? 'V': '',
                    result[index]['nama_hotel'],
                    result[index]['kelas_kamar'],
                    result[index]['jml_bed'],
                    result[index]['harga'],
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
        url: $('#uri').val() + "kamar/getbyid",
        method: 'GET',
        data: {
            id_kamar: id
        },

        success: function(result){
            $('#id_kamar').val(result[0]['id_kamar']);

            getHotel(result[0]['id_hotel']);

            $('#kelas_kamar').val(result[0]['kelas_kamar']);
            if (result[0]['kelas_kamar'] != '') {
                $('#kelas_kamar').closest('.floating').addClass('open');
            } else {
                $('#kelas_kamar').closest('.floating').removeClass('open');
            }

            $('#jml_bed').val(result[0]['jml_bed']);
            if (result[0]['jml_bed'] != '') {
                $('#jml_bed').closest('.floating').addClass('open');
            } else {
                $('#jml_bed').closest('.floating').removeClass('open');
            }

            $('#harga').val(result[0]['harga']);
            if (result[0]['harga'] != '') {
                $('#harga').closest('.floating').addClass('open');
            } else {
                $('#harga').closest('.floating').removeClass('open');
            }

            $('#aktif').prop('checked', result[0]['aktif'] == 1 ? true : false);
        }
    });
}

function getHotel(select){
    $.ajax({
        url: $('#uri').val() + "hotel/browse",
        method: 'GET',

        success: function(result){
            $("#id_hotel").empty();

            $('#id_hotel').select2({
                placeholder: '-- Pilih Satu --',
                allowClear: true
            });

            var newOption = new Option('-- Pilih Satu --', 0, true, true);
            $('#id_hotel').append(newOption).trigger('change');

            $.each(result, function(index) {

                var id = result[index]['id_hotel'];

                if(select == id){
                    var newOption = new Option(result[index]['nama_hotel'], id, true, true);
                } else {
                    var newOption = new Option(result[index]['nama_hotel'], id, false, false);
                }


                $('#id_hotel').append(newOption).trigger('change');
            });
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
        url: $('#uri').val() + "kamar/insert",
        method: 'post',
        data: {
            id_hotel: $('#id_hotel').val(),
            kelas_kamar: $('#kelas_kamar').val(),
            jml_bed: $('#jml_bed').val(),
            harga: $('#harga').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_kamar']){
                $('#Validate').text(result['responseJSON']['errors']['kode_kamar']);

            }
            else if (result['responseJSON']['errors']['kelas_kamar']){
                $('#Validate').text(result['responseJSON']['errors']['kelas_kamar']);

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
        url: $('#uri').val() + "kamar/update",
        method: 'post',
        data: {
            id_hotel: $('#id_hotel').val(),
            id_kamar: $('#id_kamar').val(),
            kelas_kamar: $('#kelas_kamar').val(),
            jml_bed: $('#jml_bed').val(),
            harga: $('#harga').val(),
            aktif: ($('#aktif').prop('checked') == true ? 1 : 0)
        },
        success: function(result){
            clearModal();
            $('#input-modal').modal('hide');

            getAll();
        },
        error: function(result){
            if (result['responseJSON']['errors']['kode_kamar']){
                $('#Validate').text(result['responseJSON']['errors']['kelas_kamar']);

            }
            else if (result['responseJSON']['errors']['kelas_kamar']){
                $('#Validate').text(result['responseJSON']['errors']['kelas_kamar']);

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
        url: $('#uri').val() + "kamar/delete",
        method: 'post',
        data: {
            id_kamar: id
        },
        success: function(result){

            getAll();
        }
    });
}

function clearModal(){
    $('#tipe').val('');
    $('#id_kamar').val('');
    $('#id_hotel').val('');
    $('#kelas_kamar').val('');
    $('#jml_bed').val('');
    $('#harga').val('');
    $('#aktif').prop('checked', true);
}

$( document ).ready(function(){
        var tipe;

        getAll();

        $('#btnTambah').click(function(){
            clearModal();

            $('#tipe').val('insert');
            if($('#tipe').val() == "insert"){
                $('#input-modal .block-title').text('Tambah Kamar');
                $('#kode_kamar').removeAttr("readonly", "");
            }

            $('#kelas_kamar').closest('.floating').removeClass('open');
            $('#jml_bed').closest('.floating').removeClass('open');
            $('#harga').closest('.floating').removeClass('open');

            getHotel(0);

            $('#input-modal').modal('show');

        });

        $('#datatable').delegate('.btnUpdate', 'click', function(){
            var id = $.trim($( this ).attr('data-id'));

            getById(id);

            $('#tipe').val('update');
            if($('#tipe').val() == "update"){
                $('#input-modal .block-title').text('Update Kamar');
                $('#kode_kamar').attr("readonly", "");
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
