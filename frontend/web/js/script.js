//Левое меню
$('.catalog').dcAccordion({speed: 300});

//Добавление в корзину
$('.add-to-cart').on('click', function (e) {
    e.preventDefault();

    var id = $(this).data('id'),
        qty = $('#qty').val();
    if (qty != null) {
        qty = qty;
    } else {
        qty = 1;
    }
    $.ajax({
        url: '/cart/add',
        data: {id: id, qty: qty},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Такого товара нет');
            // console.log(res);
            showCart(res)
        },
        error: function () {
            alert('Error')
        }
    });

    return false;
});

//Добавление корзины в модальное окно
function showCart(cart) {
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
}

//Очистка корзины
function clearCart() {
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res) {
            if (!res) alert('Такого товара нет');
            showCart(res)
        },
        error: function () {
            alert('Error')
        }
    });
}

//Удаление товара с корзины

$('#cart .modal-body').on('click', '.del-item', function (e) {
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Такого товара нет');
            // console.log(res);
            showCart(res)
        },
        error: function () {
            alert('Error')
        }
    });
});

$('.cart-container').on('click', '.del-item', function (e) {
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Такого товара нет');
            // console.log(res);
            showCart(res)
        },
        error: function () {
            alert('Error')
        }
    });
});

function getCart() {
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function (res) {
            if (!res) alert('Такого товара нет');
            showCart(res)
        },
        error: function () {
            alert('Error')
        }
    });
}

//Добавление в Wishlist
$('.add-to-wishlist').on('click', function (e) {
    e.preventDefault();

    var id = $(this).data('id');

    $.ajax({
        url: '/wishlist/add',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if (!res) alert('Такого товара нет');
            // console.log(res);
            showWishlist(res)
        },
        error: function () {
            alert('Error')
        }
    });

    return false;
});

//Добавление wishlist в модальное окно
function showWishlist(wishlist) {
    $('#wishlist .modal-body').html(wishlist);
    $('#wishlist').modal();
}

