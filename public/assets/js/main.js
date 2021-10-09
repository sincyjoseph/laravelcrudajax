$(document).ready(function(){
    getdata();
});

//get data by ajax
function getdata(){
    $.ajax({
        url: "/api/get-user",
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response);
            $.each(response.userdata, function (key, value) { 
                var created_at = moment(value['created_at']).format("YYYY/MM/DD");
                var updated_at = moment(value['updated_at']).format("YYYY/MM/DD");
                console.log(created_at);
                $('#table_data').append(
                    '<tr>'+
                    '<td>'+value['id']+'</td>'+
                    '<td>'+value['username']+'</td>'+
                    '<td>'+value['password']+'</td>'+
                    '<td>'+value['email']+'</td>'+
                    '<td>'+value['phone']+'</td>'+
                    '<td>'+value['dateofbirth']+'</td>'+
                    '<td>'+value['gender']+'</td>'+
                    '<td>'+value['address']+'</td>'+
                    '<td>'+created_at+'</td>'+
                    '<td>'+updated_at+'</td>'+
                    '<td>'+
                        '<span class="btn btn-sm btn-info edit" data-id="'+value['id']+'">EDIT</span>'+
                        '&nbsp;'+
                        '<span class="btn btn-sm btn-danger delete" data-id="'+value['id']+'">DELETE</span>'+
                    '</td>'+
                    '</tr>'
                );
            });
            onEdit();
            onDelete();
        },
        error: function(jqXHR, exception){
            console.log(jqXHR);
        }

    });
}

//resetting the feilds
$(".reset").click(function() {
    $('#HI').val(0);
    $('#username').val('');
    $('#password').val('');
    $('#email').val('');
    $('#phone').val('');
    var genderinfo = document.forms['myForm']['gender'];
    if(genderinfo[0].checked==true || genderinfo[1].checked==true){
        $('#female').prop( "checked", false );
        $('#male').prop( "checked", false );
    }
    $('#dateofbirth').val('');
    $('#address').val('');
    $("#save_button").html('Save').data('action', 'save');
});

//edit operation
function onEdit() {
    $('.edit').off('click');
    $(".edit").on('click', function (e) {
        var row = $(this).closest('tr');
        var userId = $(this).data("id");
        $("#save_button").html('Update').data('action', 'update');
        $(row).each(function () {
                var username = $(this).find("td:eq(1)").text().trim();
                var password = $(this).find("td:eq(2)").text().trim();
                var email = $(this).find("td:eq(3)").text().trim();
                var phone = $(this).find("td:eq(4)").text().trim();
                var dateofbirth = $(this).find("td:eq(5)").text().trim();
                var gender = $(this).find("td:eq(6)").text();
                if(gender == 'female'){
                    $('#female').prop( "checked", true );
                }else if(gender == 'male'){
                    $('#male').prop( "checked", true );
                }
                var address = $(this).find("td:eq(7)").text().trim();

                $('#username').val(username);
                $('#password').val(password);
                $('#email').val(email);
                $('#phone').val(phone);
                $('#dateofbirth').val(dateofbirth);
                $('#address').val(address);
                $('#HI').val(userId);
        });
    });
}
onEdit();

//delete operation
function onDelete() {
    $('.delete').off('click');
    $('.delete').on( 'click', function(){
        var obj = $(this);
        var userId = $(this).data('id');
        var operation = 'delete';
        var token = $('input[name="_token"]').val();
        var confirmalert = confirm("Are you sure?");
        if (confirmalert == true) {
        $.ajax({
            url: '/api/delete-user',
            type: 'POST',
            data: { 
                userId: userId,
                operation: operation
            },
            headers: {'X-CSRF-TOKEN': token},
            dataType: "json",
            success: function(response){
                if (response.code==200){
                    $(obj).closest('tr').remove();
                }
            },
            error: function(jqXHR, exception){
            console.log(jqXHR);
            }
        });
        }
    });
}
onDelete();


$("#reg").submit(function(e) {
    e.preventDefault();
    var username = $('#username').val();
    var password = $('#password').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var dateofbirth = $('#dateofbirth').val();
    var gender = $('input[name="gender"]:checked').val();
    var address = $('#address').val();
    var declaration = $('input[name="declaration"]:checked').val();
    var token = $('input[name="_token"]').val();
    var operation = $("#save_button").data('action');
    var data = {
        username: username,
        password: password,
        email: email,
        phone: phone,
        dateofbirth: dateofbirth,
        gender: gender,
        address: address,
        declaration: declaration,
        operation: operation,
    };
    var genderinfo = document.forms['myForm']['gender'];
    if(operation=='update'){
        var HI = $('#HI').val();
        data.userId = HI;
    }
    $(".error").remove();
    if (username.length == 0) {
        $('#username').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(password.length == 0){
        $('#password').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(email.length == 0){
        $('#email').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(phone.length == 0){
        $('#phone').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(dateofbirth.length == 0){
        $('#dateofbirth').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(genderinfo[0].checked==false && genderinfo[1].checked==false){
        $('#female').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(address.length == 0){
        $('#address').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(!document.getElementById('declaration').checked){
        $('#declaration').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else{
        $.ajax({
            url: "/api/add-user",
            type: "POST",
            data: data,
            headers: {'X-CSRF-TOKEN': token},
            dataType:"json",
            success:function(response){
                //console.log(response.code);
                var rowCount = $("#table_data tr").length;
                if(operation=='save'){
                    var out = '<tr>';
                      out += '<td>'+ response.lastId+'</td>';
                      out += '<td>'+ data.username+'</td>';
                      out += '<td>'+ data.password+'</td>';
                      out += '<td>'+ data.email+'</td>';
                      out += '<td>'+ data.phone+'</td>';
                      out += '<td>'+ data.dateofbirth+'</td>';
                      out += '<td>'+ data.gender+'</td>';
                      out += '<td>'+ data.address+'</td>';
                      out += '<td>'+ new Date().getFullYear()+"/"+new Date().getMonth()+"/"+new Date().getDate()+'</td>';
                      out += '<td>'+ new Date().getFullYear()+"/"+new Date().getMonth()+"/"+new Date().getDate()+'</td>';
                      out += '<td >';
                      out += '<span class="btn btn-sm btn-info edit" data-id="'+ response.lastId +'">EDIT</span>';
                      out += '&nbsp;';
                      out += '<span class="btn btn-sm btn-danger delete" data-id="'+ response.lastId +'">DELETE</span>';
                      out += '</td></tr>';
                      
                      if(rowCount > 0) {
                          $(out).insertAfter('#table_data tr:last');
                          $('#reg')[0].reset();
                      } else {
                          $('#table_data').html(out);
                          $('#reg')[0].reset();
                      }
                }else if(operation=='update'){
                    var tableRow = $("td").filter(function() {
                          return $(this).text() == HI;
                      }).closest("tr");    
                      //console.log(tableRow);
                      tableRow.find("td:eq(1)").html(username);
                      tableRow.find("td:eq(2)").html(password);
                      tableRow.find("td:eq(3)").html(email);
                      tableRow.find("td:eq(4)").html(phone);
                      tableRow.find("td:eq(5)").html(dateofbirth);
                      tableRow.find("td:eq(6)").html(gender);
                      tableRow.find("td:eq(7)").html(address);
                      tableRow.find("td:eq(8)").html(new Date().getFullYear()+"/"+new Date().getMonth()+"/"+new Date().getDate());
                      tableRow.find("td:eq(9)").html(new Date().getFullYear()+"/"+new Date().getMonth()+"/"+new Date().getDate());
                      $("#save_button").html('Save').data('action', 'save');
                      $('#reg')[0].reset();
                      $('#HI').val(0);
                }
                onEdit();
                onDelete();
            }      
        }); 
    }
});