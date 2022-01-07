$(document).ready( function() {

    //name, age, cpf and phone mask
    $('input[name=phone]').mask("(00) 00000-0009");
    $('input[name=phone]').blur(function() {
        if($(this).val().length == 15) {
            $('input[name=phone]').mask("(00) 00000-0009");    
        } else {
            $('input[name=phone]').mask("(00) 0000-00009");
        }
    });
    
    $('input[name=cpf]').mask('000.000.000-00');
    $('input[name=age]').mask('990');

    //form validation with JQuery Ajax
    $('#patients-form').submit(function(e) {
        e.preventDefault();

            //inputs validations
            $('#patients-form').validate({
                rules: {
                    name: {
                        minWords: 2,
                    },
                    cpf: {
                        cpfBR: true,
                    },
                },
            });

        $('input[name=cpf]').mask('00000000000');
        if($('input[name=phone]').val().length == 15) {
            $('input[name=phone]').mask("00000000009");    
        } else {
            $('input[name=phone]').mask("00000000009");
        }

        const token = $(this).find("_token").val();
        const name = $(this).find('input#name').val();
        const phone = $(this).find('input#phone').val();
        const age = $(this).find('input#age').val();
        const valid_cpf = $(this).find('input#cpf').val();      
        const file_path = $(this).find('input#file_path')[0].files[0];

        $.ajax({
            url: "/patients",
            method: "POST",
            enctype: "multipart/form-data",
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    alert(response.message);
                    window.location.href = '/patients';
                } else {
                    alert(response.message);
                }
            }
        });

    });

    //form edit validation
    $('#patients-form-edit').submit(function(e) {
        e.preventDefault();
       

            //inputs validations
            $('#patients-form-edit').validate({
                rules: {
                    name: {
                        minWords: 2,
                    },
                    cpf: {
                        cpfBR: true,
                    },
                },
            });

        $('input[name=cpf]').mask('00000000000');
        if($('input[name=phone]').val().length == 15) {
            $('input[name=phone]').mask("00000000009");    
        } else {
            $('input[name=phone]').mask("00000000009");
        }

        const id = $(this).find('input#patient-id').val();
        const _token = $(this).find("input[name=_token]").val();
        const name = $(this).find('input#name-edit').val();
        const phone = $(this).find('input#phone-edit').val();
        const age = $(this).find('input#age-edit').val();
        const cpf = $(this).find('input#cpf-edit').val();      
        const file_path = $(this).find('input#file_path-edit')[0].files[0];

        $.ajax({
            url: `/patients/${id}/update`,
            type: "PUT",
            enctype: "multipart/form-data",
            data: {
                id:id,
                _token: _token,
                name:name,
                phone:phone,
                age:age,
                cpf:cpf,
                file_path:file_path
            },
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    alert(response.message);
                    
                } else {
                    alert(response.message, '\n', response.error);
                }

            }
        });

    });

    //exclusão de usuário
    $("tbody").on("click", "[data-action]", function(e) {
        e.preventDefault();
        var data = $(this).data(); 
        var element = $(this).parent();
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/patients/${data.id}/delete`,
            type: 'DELETE',
            data: {
                "_token": token,
                "id": data.id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === true) {
                    alert(response.message);
                    element.parent().fadeOut();
                } else {
                    alert(response.message);
                }
            }
        });
    });

    //requisitando paciente para criação da ficha
    $('#capture-symptoms').submit(function(e) {
        //e.preventDefault();
        $('input[name=cpf]').mask('00000000000');

    });
});

//show form edit
