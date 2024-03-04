$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    const teacherTable = $("#teacherTable").DataTable({});
    $("#addNewTeacher").on('click', function(){
        $("#teacherModal").modal('toggle');
    });
    $("#teacherForm").validate({
        rules:{
            name: {
                required: true,
                minlength: 3
            },
            email:{
                required: true,
                email: true
            },
            phone:{
                required: true,
                minlength: 11
            }
        },
        messages:{
            name:{
              required: "Please enter name of student",
              minlength: jQuery.validator.format("At least {0} characters required!")
            },
            email:{
              required: "Please enter a valid email",
            },
            phone:{
                required: "Please enter a valid phone number",
                minlength: jQuery.validator.format("At least {0} characters required!")
            }
        }, 
        submitHandler: function(form) {
            $("#response").empty();
            const formData = new FormData(form);
            $.ajax({
                type: "POST",
                url: "/teachers",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    $("#teacherModal").modal("toggle");
                    $(form).trigger('reset');
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        const newRowData = [
                            response.teacher.id,
                            response.teacher.name,
                            response.teacher.email,
                            response.teacher.phone,
                            `<img src="${response.teacher.photo}"  alt="Teacher Photo" class="img-thumbnail" width="50">`,
                            `<a href="javascript:void(0)" class="btn btn-success editTeacher" data-id="${response.teacher.id}}">Edit</a>
                             <a href="javascript:void(0)" class="btn btn-danger deleteTeacher" data-id="${response.teacher.id}}">Delete</a>`
                        ];
                        teacherTable.row.add(newRowData).draw(false);
                    } else if (response.status === 'failed') {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('An error occurred while processing your request.');
                    }
                }
                
            });
        }
        
        
    });
    $('#photo').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#teacherThmb').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
});