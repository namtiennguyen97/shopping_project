//login custom
$('#customLogin').click(function () {
    $('#modalLogin').modal('show');
});

$('#registerOnLoginModal').click(function () {
    $('#modalLogin').modal('hide');
    $('#modalRegister').modal('show');
});

$('#customeRegister').click(function () {

    $('#modalRegister').modal('show');
});


$('#loginForm').on('submit', function () {

    $.ajax({
        url: "/userLogin",
        method: 'post',
        dataType: 'json',
        data: $('#loginForm').serialize(),
        success: function (data) {
            alertify.success('You has been logged in.');
            // window.location.reload();
            console.log(data);
        },
        error: function (response) {
            alertify.error('Wrong email or password!');
            console.log(response);
        }
    });
});
//end login custom

$('#registerForm').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: "/userRegister",
        method: 'post',
        data: $('#registerForm').serialize(),
        dataType: 'json',
        success: function () {
            alertify.success('Your account has been created! Now login.');
            $('#modalRegister').modal('hide');
            $('#modalLogin').modal('show');
        },
        error: function (response) {
            alertify.error('Something went wrong, please check again!');
            console.log(response);
        }
    });
});


// cart

function addCart(id) {
    $.ajax({
        url: "addCart/"+id,
        method: 'get',
        success: function (data) {
            $('#change-cart-items').empty();
            $('#change-cart-items').html(data);
            $('#total-Qty-Product').text($('#qtyCart-cart').val());
            // console.log($('#qtyCart-cart').val());
            alertify.success('Added to Your Cart!');
        },
        error: function (response) {
            console.log('error: '+ response);
            alertify.error('You have to login!');
        }
    })
}

$('#change-cart-items').on('click', '.si-close .deleteProduct', function () {
    $.ajax({
        url: 'deleteCart/' + $(this).data('id'),
        type: 'GET',
        success: function (data) {
            $('#change-cart-items').empty();
            $('#change-cart-items').html(data);
            $('#total-Qty-Product').text($('#qtyCart-cart').val());
            if(!$('#qtyCart-cart').val()){
                $('#total-Qty-Product').text('0');
            }
            console.log($('#qtyCart-cart').val());
            alertify.success('Delete Your Item!');
        },
        error: function (response) {
            console.log('error delete: ' + response);
            // alertify.error('You have to login!');
        }
    });
});

$('.review-slider-item').on('click','.showUserProfile', function () {
    $('#userProfileModal').modal('show');
    $.ajax({
        url: "showUserProfile/"+$(this).data('id'),
        method: 'get',
        success: function (data) {
            console.log(data);
            $('#appendUserProfile').empty();
            $('#appendUserProfile').html(data);
        }
    });
})
