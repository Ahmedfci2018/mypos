$(document).ready(function () {

    $('.add-product-btn').on('click', function (e) {

        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'),2);

        //disabled button on click
        $(this).removeClass('btn-success').addClass('btn-default disabled');

        var html =
            `<tr>
                <td>${name}</td>
                <input type="hidden" name="products[]" value="${id}" >
                <td><input type="number" name="quantites[]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price">${price}</td>
                <td><button class="btn btn-danger btn-remove-product btn-sm" data-id="${id}"><span class="fa fa-trash"></span> </button> </td>
             </tr>`;

        $('.order-list').append(html);

        calculateTotal();
    });

    $('body').on('click','.disabled', function (e) {

        e.preventDefault();

    }); //end of disabled

    $('body').on('click','.btn-remove-product', function (e) {

        e.preventDefault();

        // enable add product button
        var id=$(this).data('id');
        $('#product-'+ id).removeClass('btn-default disabled').addClass('btn-success');

        //remove this product
        $(this).closest('tr').remove();

        calculateTotal();
        
    });//end of btn-remove-product
    
    //calculate total price
    
    function calculateTotal() {

        var price=0;

        $('.order-list .product-price').each(function (index) {

            price+= parseFloat($(this).html().replace(/,/g, ''));

        }); //end of product price each

        $('.total-price').html($.number(price, 2));

        if(price > 0){

            $('#add-order-form-btn').removeClass('disabled');
        }
        else {
            $('#add-order-form-btn').addClass('disabled');
        }
    } //end of calculate total

    $('body').on('keyup change','.product-quantity',function () {

        var quantity =parseInt($(this).val());
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));

        $(this).closest('tr').find('.product-price').html($.number(unitPrice * quantity, 2));
        calculateTotal();

    }); //end of product-quantity

});// end of function