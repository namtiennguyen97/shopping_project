$('#updateUserForm').on('submit', function (e) {
    e.preventDefault();
    let id = $('#showId').data('id');
    console.log(id);
    $.ajax({
        url: "updateUser/" + id,
        method: 'post',
        data: $('#updateUserForm').serialize(),
        success: function (data) {
            $('#editName').val(data.name);
            $('#editPhone').val(data.phone);
            $('#editFullName').val(data.full_name);
            $('#editAddress').val(data.address);
            $('#accountName').text(data.name);

            // ko hien thi loi nua
            $('#showErrorName').text("");
            $('#showErrorFullName').text("");
            $('#showErrorPhone').text("");
            $('#showErrorAddress').text("");
            //cac o input ko hien thi in-invalid nua

            $('#editName').removeClass('is-invalid');
            $('#editName').addClass('is-valid');

            $('#editFullName').removeClass('is-invalid');
            $('#editFullName').addClass('is-valid');

            $('#editPhone').removeClass('is-invalid');
            $('#editPhone').addClass('is-valid');

            $('#editAddress').removeClass('is-invalid');
            $('#editAddress').addClass('is-valid');

            alertify.success("Updated successfully!");


        },
        error: function (response) {
            console.log(response);
            $('#showErrorName').text(response.responseJSON.errors.name);
            $('#showErrorAddress').text(response.responseJSON.errors.address);
            $('#showErrorFullName').text(response.responseJSON.errors.full_name);
            $('#showErrorPhone').text(response.responseJSON.errors.phone);
            if (response.responseJSON.errors.name) {
                $('#editName').removeClass('is-valid');
                $('#editName').addClass('is-invalid');
            } else {
                $('#editName').removeClass('is-invalid');
                $('#editName').addClass('is-valid');
                $('#showErrorName').text("");
            }
            if (response.responseJSON.errors.full_name) {
                $('#editFullName').removeClass('is-valid');
                $('#editFullName').addClass('is-invalid');
            } else {
                $('#editFullName').removeClass('is-invalid');
                $('#editFullName').addClass('is-valid');
                $('#showErrorFullName').text("");
            }
            if (response.responseJSON.errors.phone) {
                $('#editPhone').removeClass('is-valid');
                $('#editPhone').addClass('is-invalid');
            } else {
                $('#editPhone').removeClass('is-invalid');
                $('#editPhone').addClass('is-valid');
                $('#showErrorPhone').text("");
            }
            if (response.responseJSON.errors.address) {
                $('#editAddress').removeClass('is-valid');
                $('#editAddress').addClass('is-invalid');
            } else {
                $('#editAddress').removeClass('is-invalid');
                $('#editAddress').addClass('is-valid');
                $('#showErrorAddress').text("");
            }

        }
    });
});

//change password
$('#changePassword').on('submit', function (e) {
    e.preventDefault();
    let id = $('#showId').data('id');
    $.ajax({
        url: "updatePassword/"+id,
        method: 'post',
        data: $('#changePassword').serialize(),
        success: function (response) {
            alertify.success("Password changed successfully!");
            // alertify.alert("ALERT", "You have to re-Login");

            window.location.reload();
        },
        error: function (response) {
            console.log(response.responseJSON.errors.newPassword);
            if (response.responseJSON.errors.newPassword) {
                $('#newPassword').removeClass('is-valid');
                $('#newPassword').addClass('is-invalid');
                $('#showErrorsNewPassword').text(response.responseJSON.errors.newPassword);
            } else {
                $('#newPassword').removeClass('is-invalid');
                $('#newPassword').addClass('is-valid');
                $('#showErrorsNewPassword').text("");
            }
            if (response.responseJSON.errors.confirmNewPassword) {
                $('#confirmNewPassword').removeClass('is-valid');
                $('#confirmNewPassword').addClass('is-invalid');

                $('#showErrorsCFPassword').text(response.responseJSON.errors.confirmNewPassword);
            } else {
                $('#confirmNewPassword').removeClass('is-invalid');
                $('#confirmNewPassword').addClass('is-valid');
                $('#showErrorsCFPassword').text("");
            }
            if (response.responseJSON.errors.currentPassword) {
                $('#currentPassword').removeClass('is-valid');
                $('#currentPassword').addClass('is-invalid');

                $('#showErrorsCRPassword').text(response.responseJSON.errors.currentPassword);
            } else {
                $('#currentPassword').removeClass('is-invalid');
                $('#currentPassword').addClass('is-valid');

                $('#showErrorsCRPassword').text("");
            }

            alertify.error("Something has wrong! Please check again...");
        }
    });
});


$('#form-post').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: "post/create",
        method: 'post',
        data: $('#form-post').serialize(),
        success: function (data) {


            if (!$("#userAvatarSrc").val()){
                alertify.success('Posted! Make sure you update your default avatar to let everyone know who you re!');
                $('#showPost').append("<div class='user-post"+data.id+"'>" +
                    "<img src='storage/images/user-avatar.jpg' class='img-thumbnail avatar-comment' width='40' alt='image'>" +
                    "<a><b>"+ $('#authUserName').val() +"</b></a>"+
                    " <a>"+ data.created_at +"</a>" +
                    "<button class='btn btn-info btn-edit-post' data-id="+ data.id+"><i class='fas fa-edit'></i></button>"+
                    " <button class='btn btn-danger btn-del-post' data-id="+ data.id +"><i class='fa fa-trash-alt'></i></button>" +
                    "<textarea class='form-control' readonly>" + data.comment + "</textarea>"+
                    "</div> ");
            }
            else{
                alertify.success('Have fun ^^');
                $('#showPost').append("<div class='user-post"+data.id+"'>" +
                    "<img src='storage/"+$("#userAvatarSrc").val()+"' class='img-thumbnail avatar-comment' width='40' alt='image'>" +
                    "<a><b>"+ $('#authUserName').val() +"</b></a>"+
                    " <a>"+ data.created_at +"</a>" +
                    "<button class='btn btn-info btn-edit-post' data-id="+ data.id+"><i class='fas fa-edit'></i></button>"+
                    " <button class='btn btn-danger btn-del-post' data-id="+ data.id +"><i class='fa fa-trash-alt'></i></button>" +
                    "<textarea class='form-control' readonly>" + data.comment + "</textarea>"+
                    "</div> ");
            }

        }
    })
});

$('#showPost').on('click','.btn-del-post', function (e) {
    e.preventDefault();
    let r = confirm('Do you want to delete this?');
    if (r == true){
        $.ajax({
            url: '/post/destroy/' + $(this).data('id'),
            method: 'get',

            success: function (data) {
                console.log(data.id);
                $('.user-post' + data.id).remove();

                alertify.success("Deleted!");
            }
        });
    }

});

//hien thi modal edit post
let editPostId;
$('#showPost').on('click','.btn-edit-post', function () {
    editPostId = $(this).data('id');
    $('#modalEditPost').modal('show');
    $.ajax({
        url: "showOnePost/" + editPostId ,
        method: 'get',
        success: function (data) {
            console.log(data);
            $('#showEditComment').val(data.comment);
        }
    });
});
//edit post method form

$('#editPostForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: "post/update/" + editPostId,
        method: 'post',
        data: $('#editPostForm').serialize(),
        success: function (data) {
            console.log(data.comment);
            alertify.success("Updated");
            $('#modalEditPost').modal('hide');

            if (!$("#userAvatarSrc").val()){
                $('.user-post' + data.id).replaceWith("<div class='user-post"+data.id+"'>" +
                    "<img src='storage/images/user-avatar.jpg' class='img-thumbnail avatar-comment' width='40' alt='image'>" +
                    "<a><b>"+ $('#authUserName').val() +"</b></a>"+
                    " <a>"+ data.created_at +"</a>" +
                    "<button class='btn btn-info btn-edit-post' data-id="+ data.id+"><i class='fas fa-edit'></i></button>"+
                    " <button class='btn btn-danger btn-del-post' data-id="+ data.id +"><i class='fa fa-trash-alt'></i></button>" +
                    "<textarea class='form-control' readonly>" + data.comment + "</textarea>"+
                    "</div>");
            }
            else{
                $('.user-post' + data.id).replaceWith("<div class='user-post"+data.id+"'>" +
                    "<img src='storage/"+$("#userAvatarSrc").val()+"' class='img-thumbnail avatar-comment' width='40' alt='image'>" +
                    "<a><b>"+ $('#authUserName').val() +"</b></a>"+
                    " <a>"+ data.created_at +"</a>" +
                    "<button class='btn btn-info btn-edit-post' data-id="+ data.id+"><i class='fas fa-edit'></i></button>"+
                    " <button class='btn btn-danger btn-del-post' data-id="+ data.id +"><i class='fa fa-trash-alt'></i></button>" +
                    "<textarea class='form-control' readonly>" + data.comment + "</textarea>"+
                    "</div>");
            }

        }
    });
});

// preview avatar image
function loadImage(event) {
    let output = document.getElementById('previewUserAvatar');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
}

// update avatar
$('#avatarForm').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: "updateUserAvatar/"+ $('#showId').data('id'),
        method: 'post',
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,

        success: function (data) {
            console.log(data);
            $('#load-dashboard-avatar').empty();
            $('#load-dashboard-avatar').html(data.requested_image);
            $('#user-avatar-dashboard').empty();
            $('#user-avatar-dashboard').html(data.dashboard_image);
            $('.avatar-comment').empty();
            $('.avatar-comment').html(data.comment_image);
            alertify.success("Avatar changed!");
        }
    });
})
// function render image after change
