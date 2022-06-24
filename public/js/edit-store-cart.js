//instantiating plugins {switchery: for the switch button, select2, for the select with search box}
$(document).ready(function() {
    //*** switchery instantiating ***//
    var elemprimary = document.querySelector('#js-success');
    var switchery = new Switchery(elemprimary, {
        color: '#2ed8b6',
        jackColor: '#fff'
    });
    //*** End switchery instantiating ***//

    //*** Select2 instantiating ***//
    $('#product_select').select2();
    $('#customer_select').select2();
    //*** End Select2 instantiating ***//
});


//*** Vat Toggle ***//
$('#js-success').on("change", function() {

    //checking the value of the switch button
    if ($(this).prop("checked") === false) {
        // show switch off notification
        $.toast({
            text: "VAT has been deactivated",
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right",
            bgColor: '#f5365c',
            textColor: 'white',
            hideAfter: 5000,
        })

        // $(this).prop("checked") === "true"
        if(parseFloat($('#paid').text()).toFixed(2) * 1 === 0.00 && (parseFloat($('#chang').text()).toFixed(2) * 1 === 0.00)) {
            // recalculates the stock, amount and total
            overallSuM('subtotals');

            //calculates the discount
            discount("tableTotal")

            // calculates the change
            calChange();
        }else {
            overallSumm('subtotals');

            //calculates the discount
            discount("tableTotal")

            // calculates the change
            calChange();
        }

    } else {
        // show switch on notification
        $.toast({
            text: 'VAT has been activated',
            showHideTransition: 'fade',
            icon: 'success',
            position: "top-right",
            bgColor: '#2dce89',
            textColor: 'white'
        })
        if(parseFloat($('#paid').text()).toFixed(2) * 1 === 0.00 && (parseFloat($('#chang').text()).toFixed(2) * 1 === 0.00)) {
            // recalculates the stock, amount and total
            overallSuM('subtotals');

            //calculates the discount
            discount("tableTotal")

            // calculates the change
            calChange();
        }else {
            overallSumm('subtotals');

            //calculates the discount
            discount("tableTotal")

            // calculates the change
            calChange();
        }
    }
})
//*** End Vat Toggle **//


//*** Apply Discount Button ***//
$("#applyDiscountBtn").click(function(){
    discount("tableTotal");
});
//*** End Apply Discount Button ***//


//*** Add to cart with add button ***//
$(document).on('click', '.add_product', function() {
    // gets the id of the button clicked
    let button_id = $(this).attr("id");

    let barcode = button_id.replace("btn", "");
    let name = $(`#${barcode}`).find("span").eq(1).text();
    let price = $(`#${barcode}`).find("span").eq(3).text();
    var i;
    i = $("#track_number")
    i++;
    if ($("#cart-table").find("#name" + barcode).length) {
        $(`#q${barcode}`).val(parseInt($(`#q${barcode}`).val()) + 1)
        addContent('q' + barcode, 'p' + barcode, 't' + barcode, 'stk' + barcode);
        overallSumm('subtotals');
        discount('tableTotal')
        calChange();
    } else {

        $('#cart-table').append('<tr id="row' + i + '"><td><input type="text" id="name' + barcode + '" readonly="readonly" name="item[]" value="' + name + '" class="form-control"/></td><td><input type="text" readonly="readonly" id="p' + barcode + '" name="price[]" value="' + price + '" class="form-control"/></td><td><input type="number" step="0.01" min="1" name="quantity[]" id="q' + barcode + '" onchange = "addContent(\'q' + barcode + '\',\'p' + barcode + '\',\'t' + barcode + '\',\'stk' + barcode + '\'); overallSumm(\'subtotals\');" onkeyup = "addContent(\'q' + barcode + '\',\'p' + barcode + '\',\'t' + barcode + '\',\'stk' + barcode + '\'); overallSumm(\'subtotals\');" value="1" class="form-control quantities"/><td><input type="text" readonly="readonly" id="t' + barcode + '" name="amount[]"  value="' + price + '" class="form-control subtotals"/></td><td><button type="button" name="remove" id="' + i + '" onclick="deleteRow(' + i + ');"  class="btn btn-danger btn_remove"><i class=\'ik ik-trash-2\'></i></button></td></tr>');
        addContent('q' + barcode, 'p' + barcode, 't' + barcode, 'stk' + barcode);
        overallSumm('subtotals');
        discount('tableTotal');

        calChange();
    }

    $("#track_number").val(i);


});
//*** End add to cart with add button ***//


//*** Event When Amount Paid is Entered ***//
$('#paid').on('keypress', function() {
    // calChange();
    //grabs event keycode in the keycode constant
    const {keyCode} = event;
    if (keyCode === 13) { // checks if the key pressed is the enter key (whose key code is '13')
        if ((parseFloat($('#tableTotal').text()).toFixed(2) * 1) === 0.00) { // Checks if the total is = 0.00
            // shows cart error since the the cart is empty
            $.toast({
                head: "Cart Error",
                text: "Cart is empty <br>Please add an item!",
                showHideTransition: 'fade',
                icon: 'error',
                position: "top-right",
                bgColor: '#f5365c',
                textColor: 'white',
                hideAfter: 5000,
            }) //checks if the amount paid is lesser than the expected amount
        } else if ((parseFloat($('#paid').val()).toFixed(2) * 1) < (parseFloat($("#tableTotal").val().replaceAll(",","")).toFixed(2) * 1)) {
            // shows payment since the amount paid is not enough
            $.toast({
                head: "Insufficient Payment",
                text: "Amount Paid is Insufficient..<br>Please Check Amount Paid!",
                showHideTransition: 'fade',
                icon: '<i class="fas fa-money-bill-alt"></i>',
                position: "top-right",
                bgColor: '#f5365c',
                textColor: 'white',
                hideAfter: 5000,
            }); // checks if the the amount paid has not been entered
        } else if ((parseFloat($("#paid").val()).toFixed(2) * 1) < 1 || $("#paid").val() === "" ) {
            // shows payment error since the amount paid has not been entered
            $.toast({
                head: "Payment Error",
                text: "Please enter amount paid by customer",
                showHideTransition: 'fade',
                icon: 'error',
                position: "top-right",
                bgColor: '#f5365c',
                textColor: 'white',
                hideAfter: 5000,
            })// checks if the change input box value is a negative signed number
        } else if (Math.sign((parseFloat($("#chang").val()).toFixed(2) * 1)) === -1) {
            // shows payment error since the amount paid is not enough
            $.toast({
                head: "Payment Error",
                text: "Please check amount paid by customer",
                showHideTransition: 'fade',
                icon: 'error',
                position: "top-right",
                bgColor: '#f5365c',
                textColor: 'white',
                hideAfter: 5000,
            })
        } 
        // else {
        //     Swal.fire({
        //         title: 'Are you sure you want to place this order?',
        //         showDenyButton: true,
        //         showCancelButton: true,
        //         confirmButtonText: `Yes`,
        //         denyButtonText: `No`,
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire('Order Placed!', '', 'success')
        //             setTimeout(
        //                 function(){
        //                     // submits form if all the above exceptions are validated
        //                     $("#item-form").submit();
        //                 }, 2000
        //             );
        //         } else if (result.isDenied) {
        //             Swal.fire('Order Cancelled', '', 'info')
        //         }
        //     });
        // }
    }

})
//*** End Event When Amount Paid is Entered ***//


//*** Clear Cart Button ***//
$("#clearCartBtn").on("click", function (){
    Swal.fire({
        title: 'Are you sure you want to clear the cart?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
    }).then((result) => {
        //  when confirm button (yes) is clicked
        if (result.isConfirmed) {
            // deletes all the rows
            $(".item_row").remove();
            // clears amount paid and change
            $("#paid").val("");
            $("#chang").val("");
            $("#totalAmount").val("");
            // success msg pop ups
            Swal.fire('Cart Cleared!', '', 'success')
            // tars the figures
            overallSumm("subtotals");
            calChange();
        } else if (result.isDenied) { // when the denied button (no) is clicked
            // Denial message pop up
            Swal.fire('Cart Clearing Cancelled!', '', 'info')
        }
    });


});
//*** End Clear Cart Button ***//


//*** Submit Button click ***//
$('#subm').click(function () {
   // checks if total is 0.00
    if ($("#disappear").prop("style")[0] === undefined) {
        if (parseFloat($('#tableTotal').text()).toFixed(2) * 1 === 0.00) {
            // show an Cart error since there is nothing in th car
            console.log("here")
            $.toast({
                head: "Cart Error",
                text: "Cart is empty <br>Please add an item!",
                showHideTransition: 'fade',
                icon: 'error',
                position: "top-right",
                bgColor: '#f5365c',
                textColor: 'white',
                hideAfter: 5000,
            })
        } else // checks if is lesser than the total amount to be paid
        if ((parseFloat($("#paid").val()).toFixed(2) * 1) < (parseFloat($("#tableTotal").val()).toFixed(2) * 1)) {
            // shows payment error since the payment made is insufficient
            $.toast({
                head: "Insufficient Payment",
                text: "Amount Paid is Insufficient..<br>Please Check Amount Paid!",
                showHideTransition: 'fade',
                icon: 'error',
                position: "top-right",
                bgColor: '#f5365c',
                textColor: 'white',
                hideAfter: 5000,
            });
        } else // checks if the amount paid is less than 1
        if ((parseFloat($("#paid").val()).toFixed(2) * 1) < 1 || $("#paid").val() === "") {
            // shows payment error since (either the content of the paid box has been
            // emptied or payment has not been entered
            $.toast({
                head: "Payment Error",
                text: "Please check  the amount paid by customer",
                showHideTransition: 'fade',
                icon: 'error',
                position: "top-right",
                bgColor: '#f5365c',
                textColor: 'white',
                hideAfter: 5000,
            })
        } else // checks if the change box has a negative number (which means the payment is not enough)
        if (Math.sign((parseFloat($("#chang").val()).toFixed(2) * 1)) === -1) {
            // shows payment errors
            $.toast({
                head: "Payment Error",
                text: "Please check amount paid by customer",
                showHideTransition: 'fade',
                icon: 'error',
                position: "top-right",
                bgColor: '#f5365c',
                textColor: 'white',
                hideAfter: 5000,
            })

        } else {
            //  Shows Pop Up for confirmation upon placing order
            Swal.fire({
                title: 'Are you sure you want to place this order?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                //  when confirm button (yes) is clicked
                if (result.isConfirmed) {
                    // success msg pop ups
                    Swal.fire('Order Placed!', '', 'success');
                    $("#totalAmount").val($("#tableTotal").text());
                    setTimeout(
                        function () {
                            // submits form if all the above exceptions are validated
                            $("#item-form").submit();
                        }, 100
                    )
                } else if (result.isDenied) { // when the denied button (no) is clicked
                    // Denial message pop up
                    Swal.fire('Order has been cancelled', '', 'info')
                }
            });

        }
    }else {
        // $("#item-form").submit();
        Swal.fire({
            title: 'Are you sure you want to place this order?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
        }).then((result) => {
            //  when confirm button (yes) is clicked
            if (result.isConfirmed) {
                // success msg pop ups
                Swal.fire('Order Placed!', '', 'success');
                setTimeout(
                    function () {
                        // submits form if all the above exceptions are validated
                        $("#item-form").submit();
                    }, 100
                )
            } else if (result.isDenied) { // when the denied button (no) is clicked
                // Denial message pop up
                Swal.fire('Order has been cancelled', '', 'info')
            }
        });
    }
})
//*** End Submit Button Click ***//


//*** Credit Submit Button click ***//
$('#subc').on('click',function () {
    console.log("whats wrong")
   // checks if total is 0.00
    if (parseFloat($('#tableTotal').text()).toFixed(2) * 1 === 0.00) {
        // show an Cart error since there is nothing in th cart
        $.toast({
            head: "Cart Error",
            text: "Cart is empty <br>Please add an item!",
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right",
            bgColor: '#f5365c',
            textColor: 'white',
            hideAfter: 5000,
        })

    } else {
        //  Shows Pop Up for confirmation upon placing order
        Swal.fire({
            title: 'Are you sure you want to place this order?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
        }).then((result) => {
            //  when confirm button (yes) is clicked
            if (result.isConfirmed) {
                // success msg pop ups
                Swal.fire('Order Placed!', '', 'success');
                $("#totalAmount").val($("#tableTotal").text());
                setTimeout(
                    function(){
                        // submits form if all the above exceptions are validated
                        // $("#item-form").submit();
                    }, 100
                )
            } else if (result.isDenied) { // when the denied button (no) is clicked
                // Denial message pop up
                Swal.fire('Order has been cancelled', '', 'info')
            }
        });

    }

})
//*** End Credit Submit Button Click ***//


//*** Save Submit Button click ***//
$('#savem').on('click',function () {
    let sale_type = $("#sale_type");
    let former_value = sale_type.val();
    console.log(former_value)
   // checks if total is 0.00
    if (parseFloat($('#tableTotal').text()).toFixed(2) * 1 === 0.00) {
        // show an Cart error since there is nothing in th cart
        $.toast({
            head: "Cart Error",
            text: "Cart is empty <br>Please add an item!",
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right",
            bgColor: '#f5365c',
            textColor: 'white',
            hideAfter: 5000,
        })

    } else {
        //  Shows Pop Up for confirmation upon placing order
        Swal.fire({
            title: 'Are you sure you want to save this order?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Yes`,
            denyButtonText: `No`,
        }).then((result) => {
            //  when confirm button (yes) is clicked
            if (result.isConfirmed) {
                // success msg pop ups
                Swal.fire('Order Placed!', '', 'success');
                $("#totalAmount").val($("#tableTotal").text());
                sale_type.val("pending");
                console.log(sale_type.val())
                setTimeout(
                    function(){
                        // submits form if all the above exceptions are validated
                        $("#item-form").submit();
                    }, 100
                )
            } else if (result.isDenied) { // when the denied button (no) is clicked
                // Denial message pop up
                sale_type.val(former_value);
                console.log(sale_type.val());
                Swal.fire('Order has been cancelled', '', 'info')
            }
        });

    }

})
//*** End Save Submit Button Click ***//


/**
 * @param {string} quantityID the id of the added row's quantity
 * @param {string} priceID the id of the added row's price
 * @param {string} totalID the id the added row's total amount
 * @param {string} stockID the id of the stock level of the added row
 * @author {@link https://instagram.com/brakhobbykurtiz Aaron Will Djaba},
 * calculates the total price of a single product
 */
function addContent(quantityID, priceID, totalID, stockID) {

    /**
     * takes the value of the quantity element of the added product/item/service
     * @type {*|[]|string|undefined|jQuery.v|jQuery}
     */
    let quantity = $(`#${quantityID}`).val();

    /**
     * takes the value of the price element of the added product/item/service
     * @type {*|[]|string|undefined|jQuery.v|jQuery}
     */
    let price = $(`#${priceID}`).val();

    /**
     * takes the value of the stock element (hidden) of the added product/item/services
     * @type {*|[]|string|undefined|jQuery.v|jQuery}
     */
    let stkQuant = $(`#${stockID}`).text();

    /**
     * keeps the value of the remaining stock whenever the item is added or quantity is changed
     * @type {number}
     */
    let verbose = stkQuant - quantity

    /**
     * keeps the total value of price multiplied by the current quantity in the stock
     * @type {number}
     */
    let totalItem;
    if (!(verbose <= -1)) {
        //checks if the value of the stock left is not less than or equal to -1
        // multiplying the quantity by the price of the product/item/service to get its total price
        totalItem = price * quantity;

        // assigns the value to the added product's/item's/services' total price view
        $(`#${totalID}`).val(parseFloat(totalItem).toFixed(2) * 1);

    } else {
        // shows stock error since there's not enough stock of that product/item/service
        $.toast({
            head: "Not Enough Stock",
            text: "You don't have enough stock <br> Current Stock Available for this Item: " + stkQuant,
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right",
            bgColor: '#f5365c',
            textColor: 'white',
            hideAfter: 5000,
        })
         x=$(`#${quantityID}`);
        // changes the quantity back to 1
        x.val("1");

        // changes the price to the corresponding value of the quantity
        $(`#${totalID}`).val(parseFloat(price * 1).toFixed(2));

        // notifies the user which items quantity needs attention
        x.addClass("form-control-danger");
        setTimeout(()=>{
            x.removeClass("form-control-danger");
        }, 5000);
    }

}


/**
 * @param {string} quantityID the id of the added row's quantity
 * @param {string} priceID the id of the added row's price
 * @param {string} totalID the id the added row's total amount
 * @param {string} stockID the id of the stock level of the added row
 * @author {@link https://instagram.com/brakhobbykurtiz Aaron Will Djaba},
 * calculates the total price of a single product
 */
function addContents(quantityID, priceID, totalID, stockID) {

    /**
     * takes the value of the quantity element of the added product/item/service
     * @type {*|[]|string|undefined|jQuery.v|jQuery}
     */
    let quantity = $(`#${quantityID}`).val();

    /**
     * takes the value of the price element of the added product/item/service
     * @type {*|[]|string|undefined|jQuery.v|jQuery}
     */
    let price = $(`#${priceID}`).val();

    /**
     * takes the value of the stock element (hidden) of the added product/item/services
     * @type {*|[]|string|undefined|jQuery.v|jQuery}
     */
    let stkQuant = $(`#${stockID}`).text();

    /**
     * keeps the value of the remaining stock whenever the item is added or quantity is changed
     * @type {number}
     */
    let verbose = stkQuant - quantity

    /**
     * keeps the total value of price multiplied by the current quantity in the stock
     * @type {number}
     */
    let totalItem;
    if (!(verbose <= -1)) {//checks if the value of the stock left is not less than or equal to -1
        // multiplying the quantity by the price of the product/item/service to get its total price
        totalItem = price * quantity;

        // assigns the value to the added product's/item's/services' total price view
        $(`#${totalID}`).val(parseFloat(totalItem).toFixed(2) * 1);

    } else {
        // shows stock error since there's not enough stock of that product/item/service
        $.toast({
            head: "Not Enough Stock",
            text: `You don't have enough stock <br> Current Stock Available for this Item: ${stkQuant}`,
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right",
            bgColor: '#f5365c',
            textColor: 'white',
            hideAfter: 5000,
        })
        x=$(`#${quantityID}`);
        // changes the quantity back to 1
        x.val("1");
        // changes the price to the corresponding value of the quantity
        $(`#${totalID}`).val(parseFloat(price * 1).toFixed(2));

        // notifies the user which items quantity needs attention
        x.addClass("form-control-danger");
        setTimeout(()=>{
            x.removeClass("form-control-danger");
        }, 5000);

    }

}


/**
 * calculates the sum of the content of an array
 * @param {array} array the array of numbers to be summed up
 * @return {number} the summed up figure
 */
function array_sum(array){
    let result = 0;
    for (i=0; i<array.length; i++){
        result += Number(array[i]);
    }
    return result;
}


/**
 * calculates the overall total of all the products on the cart table (including the VAT)
 * @param {string} sumClass the class name of all the total prices of each product on the cart
 */
function overallSumm(sumClass) {
    // gets the value of the class name
    let overallSum = $(`.${sumClass}`);
    // an array to store all the totals of product prices
    var sum_arr;
    sum_arr = [];

    // loop to push the totals to the array. the idea is to able to sum the content of the array
    // to get the overall total
    for (var i = 0; i < overallSum.length; i++) {
        sum_arr.push(overallSum.eq(i).val());
    }

    // summing the the content if the array.
    // let ans = parseFloat(sum_arr.reduce((a, b) => a + b, 0)).toFixed(2);

    let ans = array_sum(sum_arr);

    // id of the cart table's total UI
    let vTotal = $('#tableTotal');
    // keeps the value of the VAT
    let vat;

    // gets the value of the VAT switch
    let checkr = $("#js-success").prop('checked');

    // check for the value of the VAT switch if off changes to vat value to 0 else
    // it uses the original VAT value
    if (checkr === false) {
        vat = 0;
    } else {
        vat = $('#vat_percentage').val();
    }

    // calculates the value of VAT on the total amount
    val = (vat / 100) * ans;

    $('#vat_amount').val(val);

    console.log("ans: " + ans)
    console.log("vat divided by 100 times ans: " + val)

    // adds the VAT value of the total amount to the total amount
    let toPay = (val) + (ans);

    // assigns the value to the cart table's total UI
    vTotal.html(
        parseFloat(toPay).toFixed(2).toString()
            .replace(
            /\B(?=(\d{3})+(?!\d))/g, ","
            ) // this includes comma before every three place values
    );

    console.log(toPay)
    return toPay;

}


/**
 * calculates the overall total of all the products on the cart table (including the VAT)
 * but also checks the amount paid as well
 * @param {string} sumClass the class name of all the total prices of each product on the cart
 */
function overallSuM(sumClass) {
    let sums = $(`.${sumClass}`);
    let {length} = sums;
    let sum_arr;
    sum_arr = [];
    for (let i = 0; i < length; i++) {
        sum_arr.push(parseFloat(sums.eq(i).val()).toFixed(2));
    }

    let ans = array_sum(sum_arr)

    let vTotal = $('#tableTotal');
    let vat;

    // parseFloat(document.getElementById('vat').innerText).toFixed(2);
    let tots = parseFloat(vTotal.text()).toFixed(2);


    let checkr = $("#js-success").prop("checked");


    if (checkr === false) {
        vat = 0;
    } else {
        vat = $('#vat_percentage').val();
    }

    let val = (vat / 100) * ans;
    $('#vat_amount').val(val);

    let topay;
    topay = (val) + (ans);
    vTotal.html(
        parseFloat(topay).toFixed(2).toString()
            .replace(
                /\B(?=(\d{3})+(?!\d))/g, ","
            )
    );

    let paid = parseFloat($("#paid").val()).toFixed(2) * 1;
    let total_amount = parseFloat(topay).toFixed(2) * 1
    $('#chang').val(parseFloat(total_amount - paid).toFixed(2) * -1);
    if (paid < total_amount) {
        $.toast({
            head: "Insufficient Payment",
            text: "Amount Paid is Insufficient..<br>Please Check Amount Paid!",
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right",
            bgColor: '#f5365c',
            textColor: 'white',
            hideAfter: 5000,
        });
    }
}


/**
 * calculates the change
 */
function calChange() {
    let ob = $("#paid")

        // get the value of the amount paid
        let paid = parseFloat($("#paid").val()).toFixed(2) * 1;
    if (ob.length < 0) {
        // get the total amount from the cart
        let total_amount = parseFloat($("#tableTotal").text().replaceAll(",", "")).toFixed(2) * 1;

        // checks if the amount paid has been entered before performing the calculations
        if (paid !== 0) {
            $('#chang').val(parseFloat(total_amount - paid).toFixed(2) * -1);
            console.log((total_amount - paid) * -1);
        }
        $("#totalAmount").val($("#tableTotal").text());
    }
}


let count = Array(0,0,0,0);
/**
 * calculates the discount on the total of all the products on the cart table (including the VAT) and discounts
 * price
 * @var {string} tableTotal the id of total overall price of the products on the cart
 */
function discount(tableTotal) {

    let content = $("#discount_text").val();
    let cartTotal = $(`#${tableTotal}`);

    let discount_type = $("#discount_type");
    let discount_amount = $("#discount_amount");
    let promo = $("#promo");
    let total;

    if (content === "" || content === null || isNaN(content)){
        content = "0.00";
    }

    if ($("#noDiscount").prop("checked")){
        overallSumm("subtotals");
        calChange();
         if (count[0] === 0) {

             count[0] = 1;
             count[1] = 0;
             count[2] = 0;
             count[3] = 0;

             $.toast({
                 text: 'You have discarded the discount',
                 showHideTransition: 'fade',
                 icon: 'success',
                 position: "top-right",
                 bgColor: '#2dce89',
                 textColor: 'white'
             })
         }

         discount_type.val("");
         discount_amount.val("");
         promo.val("")

    }else if ($("#discountAmount").prop("checked")) {


        let total = overallSumm("subtotals");

        total = total- Number(content)
        console.log( "discount price: ", total )

        // this includes comma before every three place values "sum total: ",total,
        total = parseFloat(total).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        cartTotal.text(total);
        calChange();

        let reference = parseFloat(content.replace(/,/g,"")).toFixed(2) * 1;
        reference = Math.abs(reference);
        reference = reference.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")

        discount_type.val("Amount");
        discount_amount.val(content)
        promo.val("")

        if (count[1] === 0) {

            count[0] = 0;
            count[1] = 1;
            count[2] = 0;
            count[3] = 0;

            $.toast({
                text: 'You have applied discount.<br>Price is reduced by GH₵' + reference,
                showHideTransition: 'fade',
                icon: 'success',
                position: "top-right",
                bgColor: '#2dce89',
                textColor: 'white'
            })
        }



    } else if ($("#discountPercentage").prop("checked")) {

    } else if ($("#discountPromo").prop("checked")) {

    }
    return total;

}


/**
 * deletes rows corresponding the delete button element UI
 * @param id the id of the row to be deleted
 */
function deleteRow(id) {
    // deletes the the row by the id
    $('#row' + id + '').remove();

    // calculates the overall total
    overallSumm('subtotals');

    // calculates the change
    calChange();

}


//*** Select Customer ***//
$(document).on('change', '#customer_select', function() {
    // splits the info into an array
    cusInfo = $('#customer_select').val().split(",");

    // send th values to the cart for posting
    $("#cus_id").val(cusInfo[0].trim());
    $("#cus_name").val(cusInfo[1].trim());
});
//*** End Select Customer ***/


//*** Add to cart By Item Image ***//
$(document).on('click', '.img-thumbnail', function() {

    // gets the button id
    var button_id = $(this).attr("id");

    // extracts the barcode number the id
    barcode = button_id.replace("img", "");

    // combines the barcode number with "#" to call a <p> tag that contains the various info of
    // the item to be added to the cart
    id = `#${barcode}`

    // finds the various info of item
    name = $(id).find("span").eq(1).text();
    price = $(id).find("span").eq(3).text();

    category = $(`#categoryInfo${barcode}`).text()
    category = category.split(",")

    item_id = $(`#item_id${barcode}`).text()

    // variable used to track the number times and item has been added to the cart
    // this number always increases by 1 anytime an item is added to the cart
    var i;

    // tracking number UI element keeps the a number used to track the history of the number
    // of items that have been added to the cart
    let track_number = $("#track_number")
    i = track_number.val();
    i++;

    //checks if the item is already on the cart
    if ($("#cart-table").find("#name" + barcode).length) {
        // gets the id of the added rows for updates
        let q = `#q${barcode}`;
        // adds 1 to the quantity
        $(q).val(parseInt($(q).val()) + 1);

        // recalculates the content in the cart
        addContent('q' + barcode, 'p' + barcode, 't' + barcode, 'stk' + barcode);
        overallSumm('subtotals');
        discount('tableTotal');
        toolTipRender(barcode, '#q' + barcode)

        // calculates the change
        calChange();
    } else {
        // else its add a new row of the item added with all needed info including the
        // name, price, quantity, total, category and id
        $('#cart-table').append(
            '<tr id="row' + i + '" class="item_row"><td hidden><input type="text" name="item_id[]" value="'+item_id.trim()+'"/></td>' +
            '<td><input type="text" id="name' + barcode + '" readonly="readonly" name="item[]" value="' + name + '" ' +
            'class="form-control"/></td><td><input type="text" readonly="readonly" id="p' + barcode + '" ' +
            'name="price[]" value="' + price + '" class="form-control"/></td><td><input type="number" step="0.01" ' +
            'min="1" name="quantity[]" id="q' + barcode + '" onchange = "addContent(\'q' + barcode + '\',\'p' +
            barcode + '\',\'t' + barcode + '\',\'stk' + barcode + '\'); overallSumm(\'subtotals\'); ' +
            'toolTipRender(barcode, \'#q\' + barcode)" onkeyup = "' +
            'addContent(\'q' + barcode + '\',\'p' + barcode + '\',\'t' + barcode + '\',\'stk' + barcode + '\'); ' +
            'overallSumm(\'subtotals\'); discount(\'tableTotal\');" value="1" class="form-control quantities"/><td><input type="text" ' +
            'readonly="readonly" id="t' + barcode + '" name="amount[]"  value="' + price + '" ' +
            'class="form-control subtotals"/></td><td><button type="button" name="remove" id="' + i + '" ' +
            'onclick="deleteRow(' + i + '); toolTipRender(barcode, \'#q\' + barcode)"  class="btn btn-danger btn_remove"><i class=\'ik ik-trash-2\'></i>' +
            '</button></td> <td hidden><input type="text" name="cat_id[]" value="'+category[0].trim()+'"/></td> ' +
            '<td hidden><input type="text" name="cat_name[]" value="'+category[1].trim()+'"/></td></tr>'
        );
        // calculates the content on the cart
        addContent('q' + barcode, 'p' + barcode, 't' + barcode, 'stk' + barcode);
        overallSumm('subtotals');
        discount('tableTotal');
        toolTipRender(barcode, '#q' + barcode)

        // calculates the change
        calChange();
    }
    // forward the current track number to the UI so it does not alter irregularly
    track_number.val(i);
});
//*** End Add to cart By Item Image ***//


//*** Add to cart By Selecting from Dropdown List ***//
$(document).on('change', '#product_select', function() {
    // gets the id of the selected option
    let  option_id = $(this).val();

    // extracts the info of the added item from the option id into an array
    let barcode = option_id.split(",");

    // clears white spaces around the string
    for (let i = 0; i < barcode.length; i++){
        barcode[i] = barcode[i].trim();
    }

    // gets the name and price of selected item and splits the info into 2
    selectProduct = $("#select2-product_select-container").text()
    name = selectProduct.split(":")[0].trim();
    price = selectProduct.split(":")[1].trim();

    // gets the category info of the selected item and splits it into and array
    category = $(`#categoryInfo${barcode[1]}`).text()
    category = category.split(",")

    // gets the id of the selected item
    item_id = $(`#item_id${barcode[1]}`).text()

    // variable used to track the number times and item has been added to the cart
    // this number always increases by 1 anytime an item is added to the cart
    var i;

    // tracking number UI element keeps the a number used to track the history of the number
    // of items that have been added to the cart
    let track_number = $("#track_number")
    i = track_number.val();
    i++;

    //checks if the item is already on the cart
    if ($("#cart-table").find("#name" + barcode[1]).length) {
        // adds 1 to the quantity
        $("#q" + barcode[1]).val(parseInt($("#q" + barcode[1]).val()) + 1)

        // recalculates the content in the cart
        addContent('q' + barcode[1], 'p' + barcode[1], 't' + barcode[1], 'stk'+ barcode[1]);
        overallSumm('subtotals');
        discount('tableTotal');
        toolTipRender(barcode[1], '#q' + barcode[1])

        // calculates the change
        calChange();
    } else {
        // else its add a new row of the item added with all needed info including the
        // name, price, quantity, total, category and id
        $('#cart-table').append(
            '<tr id="row' + i + '" class="item_row"><td hidden><input type="text" name="item_id[]" value="'+item_id.trim()+'"/></td>' +
            '<td><input type="text" id="name' +
            barcode[1] + '" readonly="readonly" name="item[]" value="' +
            name + '" class="form-control"/>' +
            '</td><td><input type="text" readonly="readonly" id="p' +
            barcode[1] + '" name="price[]" value="' +
            price + '" class="form-control"/></td><td>' +
            '<input type="number" step="0.01" min="1" name="quantity[]" id="q' + barcode[1] + '"' +
            'onchange = "addContents(\'q' + barcode[1] + '\',\'p' + barcode[1] + '\',\'t' + barcode[1] + '\',\'' +
            'stk'+barcode[1] + '\'); overallSumm(\'subtotals\'); toolTipRender(barcode[1], \'#q\' + barcode[1])" ' +
            'onkeyup = "addContent(\'q' + barcode[1] + '\',\'p' + barcode[1] + '\',\'t' + barcode[1] + '\',\'' +
            barcode[1] + '\'); overallSumm(\'subtotals\'); discount(\'tableTotal\');" value="1" class="form-control quantities"/><td>' +
            '<input type="text" readonly="readonly" id="t' + barcode[1] + '" name="amount[]"  value="' + price +
            '" class="form-control subtotals"/></td><td><button type="button" onclick="deleteRow(' + i + ');' +
            'toolTipRender(barcode[1], \'#q\' + barcode[1])" ' +
            'name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class=\'ik ik-trash-2\'></i>' +
            '</button></td> <td hidden><input type="text" name="cat_id[]" value="'+category[0].trim()+'"/></td> ' +
            '<td hidden><input type="text" name="cat_name[]" value="'+category[1].trim()+'"/></td></tr>'
        );

        // calculates the content on the cart
        addContents('q' + barcode[1], 'p' + barcode[1], 't' + barcode[1], 'stk'+barcode[1]);
        overallSumm('subtotals');
        discount('tableTotal');
        toolTipRender(barcode[1], '#q' + barcode[1])

        // calculates the change
        calChange();
    }
    // forward the current track number to the UI so it does not alter irregularly
    track_number.val(i);
});
//*** End Add to cart By Selecting from Dropdown List ***//


//*** Add to cart by barcode scan ***//
$("#barcode_no").on("keypress" , function(event) {

    // CHECKS IF THE KEYSTROKE PRESSED IS THE "enter" KEY
    if (event.keyCode === 13) {
        // gets the barcode number from the input box where the scan takes place
        barcode = $("#barcode_no").val()
        x = "#" + barcode;

        // gets name and price of the product
        name = $(x).find("span").eq(1).text();
        price = $(x).find("span").eq(3).text();

        // gets the category info of the product
        category = $(`#categoryInfo${barcode}`).text()
        category = category.split(",")

        // gets the id of the added product
        item_id = $(`#item_id${barcode}`).text()

        /// variable used to track the number times and item has been added to the cart
        // this number always increases by 1 anytime an item is added to the cart
        var i;

        // tracking number UI element keeps the a number used to track the history of the number
        // of items that have been added to the cart
        let track_number = $("#track_number")
        i = track_number.val();
        i++;

        //checks if the item is already on the cart
        if ($("#cart-table").find("#name" + x.replace("#", "")).length) {
            // adds 1 to the quantity
            $("#q" + x.replace("#", "")).val(parseInt($("#q" + x.replace("#", "")).val()) + 1)

            // recalculates the content in the cart
            addContent('q' + x.replace("#", ""), 'p' + x.replace("#", ""), 't' + x.replace("#", ""), 'stk' + x.replace("#", ""));
            overallSumm('subtotals');
            discount('tableTotal');
            toolTipRender(x.replace("#", ""), '#q' + x.replace("#", ""))

            // calculates the change
            calChange();
        } else {
            // checks if the barcode corresponds with any item in inventory
            if(name !== ""){
            // if it does it adds a new row of the item added with all needed info including the
            // name, price, quantity, total, category and id
            $('#cart-table').append(
                '<tr id="row' + i + '" class="item_row"><td hidden><input type="text" name="item_id[]" value="'+
                item_id.trim()+'"/></td>' + '<td><input type="text" id="name' + x.replace("#", "") +
                '" readonly="readonly" name="item[]" value="' + name + '" class="form-control"/></td>' +
                '<td><input type="text" readonly="readonly" id="p' + x.replace("#", "") + '" name="price[]" value="' +
                price + '" class="form-control"/></td><td>' +
                '<input type="number" step="0.01" min="1" name="quantity[]" id="q' + x.replace("#", "") +
                '" onchange = "addContent(\'q' + x.replace("#", "") + '\',\'p' + x.replace("#", "") + '\',\'t' +
                x.replace("#", "") + '\',\'stk' + x.replace("#", "") + '\'); overallSumm(\'subtotals\'); toolTipRender(' +
                'x.replace(\'#\',\'\'), \'#q\' + x.replace(\'#\', \'\'))" ' +
                'onkeyup = "addContent(\'q' + x.replace("#", "") + '\',\'p' + x.replace("#", "") + '\',\'t' +
                x.replace("#", "") + '\',\'stk' + x.replace("#", "") + '\'); overallSumm(\'subtotals\'); discount(\'tableTotal\')" ' +
                'value="1" class="form-control quantities"/><td><input type="text" readonly="readonly" id="t' +
                x.replace("#", "") + '" name="amount[]"  value="' + price + '" class="form-control subtotals"/>' +
                '</td><td><button type="button" onclick="deleteRow(' + i + '); toolTipRender(x.replace(\'#\', \'\'), ' +
                '\'#q\' + x.replace(\'#\', \'\'))" name="remove" id="' + i +
                '" class="btn btn-danger btn_remove"><i class=\'ik ik-trash-2\'></i></button></td> <td hidden>' +
                '<input type="text" name="cat_id[]" value="'+category[0].trim()+'"/></td> ' +
                '<td hidden><input type="text" name="cat_name[]" value="'+category[1].trim()+'"/></td></tr>'
            );

            // recalculates the content in the cart
            addContent('q' + x.replace("#", ""), 'p' + x.replace("#", ""), 't' + x.replace("#", ""), 'stk' + x.replace("#", ""));
            overallSumm('subtotals');
            discount('tableTotal');
            toolTipRender(x.replace("#", ""), '#q' + x.replace("#", ""))

            // calculates the change
            calChange();
            }else {
                // shows an error that product does not exist corresponding to this barcode number
                $.toast({
                    head: "Product Error",
                    text: "Product does not exist in your inventory!",
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: "top-right",
                    bgColor: '#f5365c',
                    textColor: 'white',
                    hideAfter: 5000,
                });
            }
        }
        // forward the current track number to the UI so it does not alter irregularly
        track_number.val(i);
    }




    // clears content of the scan input box for another scan
    setTimeout(()=>{
        $("#barcode_no").val("");
    }, 250);
});


//*** Tooltip Img ***//
/**
 * Renders to the tooltip of the products icon on the cart page showing the quantity left
 * @param {string} barcode
 * @param {string} quantityID
 */
function toolTipRender(barcode,quantityID) {
    let titleTip = document.getElementById("img"+barcode);
    let title = titleTip.getAttribute("data-original-title");
    let stock = $("#stk"+barcode).text();
    let quantity = $(quantityID).val();
    if (quantity == null){
        quantity = 0;
    }
    title = title.split(" ");
    let left = parseFloat(stock).toFixed(2) - parseFloat(quantity).toFixed(2);

    titleTip.setAttribute("data-original-title",left+" "+title[1]);
}
//*** End Tooltip Img ***//


/**
 * flip-flop switch that switches between direct sales and credit sales
 */
function toggle_sale_mode(){

    let toggle = $("#cart_toggle");
    let sale_type = $("#sale_type");

    if (toggle.prop("class").search("credit") !== -1) {
        toggle.removeClass("credit bg-blue");
        toggle.addClass("sales bg-orange");
        // sales.remove();

        $(".item_row").remove();
        // clears amount paid and change
        $("#paid").val("");
        $("#chang").val("");
        $("#subm").prop("id","subc")

        // tars the figures
        overallSumm("subtotals");
        calChange();

        // $("#paid").hide();
        // $("#chang").hide();
        $("#disappear").hide();
        sale_type.val('credit')


        $.toast({
            text: 'Swapped to Credit Sales',
            showHideTransition: 'fade',
            icon: 'success',
            position: "top-right",
            bgColor: '#ffa830',
            textColor: 'white'
        })
        
    }else{
        toggle.removeClass("sales bg-orange")
        toggle.addClass("credit bg-blue")
        // credit.remove()
        $(".item_row").remove();
        // clears amount paid and change
        $("#paid").val("");
        $("#chang").val("");
        // $("#subc").prop("id","subm")


        // tars the figures
        overallSumm("subtotals");
        calChange();

        // $("#paid").show();
        // $("#chang").show();

        $("#disappear").show();
        sale_type.val('direct')

        $.toast({
            text: 'Swapped to Direct Sales',
            showHideTransition: 'fade',
            icon: 'success',
            position: "top-right",
            bgColor: '#ffa830',
            textColor: 'white'
        })

    }

}


