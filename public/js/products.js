let productname = $("#productname")
let price = $("#costprice")

$("#submit").on("click", function() {

    if (productname.val() === "") {

        $.toast({
            heading: 'Error',
            text: 'You must enter product name',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })

        productname.addClass("form-control-danger");

    } else if(price === "") {
        $.toast({
            heading: 'Error',
            text: 'You must enter price',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })

        price.addClass("form-control-danger");
    } else {
        //shows a loading screen overlay
        loading_overlay(1)

        //submits form
        $("#item-form").submit();
    }
});


productname.keyup(function() {

    if (productname.val() === "") {
        $.toast({
            heading: 'Error',
            text: 'Name of product is required',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })
        productname.addClass("form-control-danger");
    } else {
        productname.removeClass("form-control-danger");
    }

});

price.keyup(function() {
    if (price.val() === "") {
        $.toast({
            heading: 'Error',
            text: 'Price of product is required',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })
        price.addClass("form-control-danger");
    } else {
        price.removeClass("form-control-danger");
    }
});
