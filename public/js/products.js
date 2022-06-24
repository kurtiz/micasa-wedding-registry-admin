$("#submit").click(function() {
    sellingP = parseFloat($("#sellingprice").val()).toFixed(2) * 1;
    costP = parseFloat($("#costprice").val()).toFixed(2) * 1;


    if ($("#productname").val() == "") {

        $.toast({
            heading: 'Error',
            text: 'You must enter product name',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })
        $("#productname").addClass("form-control-danger");


    } else if (sellingP < costP) {

        $.toast({
            heading: 'Error',
            text: 'Selling price must be more than Cost price',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })
        $("#sellingprice").addClass("form-control-danger");

        $("#costprice").addClass("form-control-danger");
    } else {
        //shows a loading screen overlay
        loading_overlay(1)

        //submits form
        $("#item-form").submit();
    }
});

$("#costprice").keyup(function() {
    sellingP = parseFloat($("#sellingprice").val()).toFixed(2) * 1;
    costP = parseFloat($("#costprice").val()).toFixed(2) * 1;
    if (sellingP > costP) {
        console.log("selling: " + sellingP + "\ncost: " + costP);

        $("#sellingprice").removeClass("form-control-danger");

        $("#costprice").removeClass("form-control-danger");

    } else {

        console.log("selling: " + sellingP + "\ncost: " + costP);
        $.toast({
            heading: 'Error',
            text: 'Selling price must be more than Cost price',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })
        $("#sellingprice").addClass("form-control-danger");

        $("#costprice").addClass("form-control-danger");
    }

});

$("#productname").keyup(function() {

    if ($("#productname").val() == "") {
        $.toast({
            heading: 'Error',
            text: 'Name of product is required',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })
        $("#productname").addClass("form-control-danger");
    } else {
        $("#productname").removeClass("form-control-danger");
    }

});