$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
$(document).ready(function () {    

    const dataTable = $("#depTable").DataTable({
        
    });
    
   //const dataTable = $("#todoTable").dataTable();

    //Create Todo
  $("#createDep").click(function () {
    $("#depModal #department_name").val("");
    $("#depForm input").removeAttr("disabled", true);
    $("#depForm button[type=submit]").removeClass("d-none");
    $("#depForm #depTitle").text("Department Edit");
    $("#depForm").attr("action", `${baseUrl}/departments`); 
    $("#hidden-dep-id").remove();
    $("#depModal").modal("toggle");
  });

  $("#depForm").validate({
      rules: {
            department_name: {
            required: true,
            minlength: 3
        }
      },
      messages: {
            department_name: {
            required: "Please enter Department Name",
            minlength: jQuery.validator.format("At least {0} characters required!")
          }
      },
      submitHandler: function (form) {
            $("#response").empty();
          const formData = $(form).serializeArray();

          const depId = $("#hidden-dep-id").val();
          const methodType = depId && 'PUT' || 'POST';
          const formAction = $(form).attr("action");
          $.ajax({
              url: formAction,
              type: methodType,
              data: formData,
              beforeSend: function () {
                  //console.log('loading....');
                 // showLoader();
              },
              success: function (response) {
                
                $("#depForm")[0].reset();
                $("#depModal").modal("toggle");
            
                if (response.status === 'success') {
                    toastr.success(response.message);
            
                    
                    if (depId) {
                        $(`#dep_${depId} td:nth-child(3)`).html(response.dep.department_name);
                    }
                    else{
                        const newRowData =
                            `<tr id="dep_${response.dep.id}">
                                <td>
                                    <input type="checkbox" name="chaeckDeps" id="chaeckDeps" class="form-check-input dep-checkbox" value="${response.dep.id}">
                                </td>
                                <td>${response.dep.id}</td>
                                <td>${response.dep.department_name}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btnDepview" data-id=${response.dep.id}>View</a>
                                    <a href="javascript:void(0)" class="btn btn-success btn-sm btnDepedit" data-id=${response.dep.id}>Edit</a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm btnDepdelete" data-id=${response.dep.id}>Delete</a>
                                </td>
                            </tr>`;
                            depTable.row.add($(newRowData)).draw(false);
                    }
                } 
                else if (response.status === 'failed') {
                    toastr.error(response.message);
                }
            },
            
              error: function (error) {
                  toastr.error(`An error occurred: ${error.statusText}`);
              },
              complete: function() {
                //hideLoader();
              }

          });
        }
    });

    //View Todo
    $("#depTable").on("click", ".btnDepview", function() {
        const depId = $(this).data("id");
        const mode = "view";
        depId && fetchDep(depId, mode);
    });

    function fetchDep(depId, mode=null) {
        //showLoader();
        if (depId) {
            $.ajax({
                url: `departments/${depId}`,
                type: "GET",
                success: function(response) {
                    if (response.status==="success") {
                        const dep = response.dep;

                        $("#depModal #department_name").val(dep.department_name);

                        if (mode==="view") {
                            $("#depForm input").attr("disabled", true);
                            $("#depForm button[type=submit]").addClass("d-none");
                            $("#depForm #depTitle").text("Department Details");
                            $("#depForm").removeAttr("action");
                        }else if (mode==="edit") {
                            $("#depForm input").removeAttr("disabled", true);
                            $("#depForm button[type=submit]").removeClass("d-none");
                            $("#depForm #depTitle").text("Department Edit");
                            $("#depForm").attr("action", `${baseUrl}/departments/${dep.id}`); 
                            $("#depForm").append(`<input type="hidden" id="hidden-dep-id" value="${dep.id}">`); 
                        }

                        $("#depModal").modal("toggle");
                    }
                },
                error: function(error){
                    console.error(error);
                },
                complete:function(){
                    //hideLoader();
                }
            });
        }
    }

    //Edit Todo
    $("#depTable").on("click", ".btnDepedit", function() {
        const depId = $(this).data("id");
        const mode = "edit";
        depId && fetchDep(depId, mode);
    });

    //Delete Todo
    $("#depTable tbody").on("click", ".btnDepdelete", function () {
        const depId = $(this).data("id");
        const buttonObj = $(this);
    
        if (depId) {
    
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `departments/${depId}`,
                        type: "DELETE",
                        success: function (response) {
                            if (response.status === "success") {
                                if (response.dep) {
                                    const rowIndex = depTable.row($(`#dep_${response.dep.id}`)).index();
                                    depTable.row(rowIndex).remove().draw();
    
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Department has been deleted.",
                                        icon: "success",
                                        timer: 1500,
                                    });
                                }
                            } else {
                                Swal.fire({
                                    title: "Failed!",
                                    text: "Unable to delete Department!",
                                    icon: "error",
                                });
                            }
                        },
                        error: function (error) {
                            Swal.fire({
                                title: "Failed!",
                                text: "Unable to delete Department!",
                                icon: "error",
                            });
                        },
                    });
                }
            });
        }
    });
    

    //Bulk select
    $("#selectDeps").on("click", function(){
        const checkboxes = $("tbody input[type='checkbox']");
        checkboxes.prop("checked", $(this).prop("checked"));

        if ($(this).prop("checked")) {
            $("#bulkDelete").removeClass("d-none");
        }
        else{
            $("#bulkDelete").addClass("d-none");
        }
    });

    $("#markCompleted").on("click", function() {
        let selectedDeps = [];

        $(".dep-checkbox:checked").each(function() {
            selectedDeps.push($(this).val());
        });

        if (selectedDeps.length > 0) {
            $.ajax({
                url: "departments/mark-completed",
                type: "POST",
                data: {
                    depIds: selectedDeps
                },
                success: function(response) {
                   if (response.status === "success") {
                        const departments = response.dep;

                        $.each(todos, function(index, todo) {
                            $(`#todo_${todo.id} td:nth-child(5)`).html( todo.is_completed ? 'Yes' : 'No' );
                        });

                        Swal.fire({
                            title: "Updated!",
                            text: "Todo has been marked as completed.",
                            icon: "success",
                            timer: 1500,
                        });
                   }

                   else {
                    Swal.fire({
                        title: "Failed!",
                        text: "Unable to mark as completed.",
                        icon: "error",
                        timer: 1500,
                    });
                   }
                },
                error: function(error) {
                    Swal.fire({
                        title: "Failed!",
                        text: "Something went wrong!.",
                        icon: "error",
                        timer: 1500,
                    });
                }
            });
        }
    });

    //Bulk Deleted
    $("#bulkDelete").on("click", function() {
        let selectedTodos = [];

        $(".todo-checkbox:checked").each(function() {
            selectedTodos.push($(this).val());
        });

        $.ajax({
            url: "todos/bulk-delete",
            type: "POST",
            data: {
                todoIds: selectedTodos
            },
            success: function(response) {
                if (response.status === "success") {

                    $(".todo-checkbox:checked").each(function() {
                        dataTable.row($(this).parents('tr')).remove().draw();
                    });

                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        timer: 1500,
                    });

                    $("#markCompleted").addClass("d-none");
                    $("#bulkDelete").addClass("d-none");
                }
                else {
                    Swal.fire({
                        title: "Failed!",
                        text: response.message,
                        icon: "error",
                        timer: 1500,
                    });
                }
            },
            error: function(error) {
                Swal.fire({
                    title: "Failed!",
                    text: "Unable to delete todos.",
                    icon: "error",
                    timer: 1500,
                });
            }
        })
    });
});
