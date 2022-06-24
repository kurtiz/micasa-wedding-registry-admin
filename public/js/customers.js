$(document).ready(function() {
    $('#category').select2();
    $('#cusrole').select2();
});

$('#datepicker').datetimepicker({
    format: 'L'
});

$("#submit").click(function() {

    if ($("#cusname").val() == "") {

        $.toast({
            heading: 'Error',
            text: 'You must enter customer name',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })
        $("#cusname").addClass("form-control-danger");


    } else {
        $("#item-form").submit();
    }
});


$("#cusname").keyup(function() {

    if ($("#cusname").val() == "") {
        $.toast({
            heading: 'Error',
            text: 'Name of customer is required',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })
        $("#cusname").addClass("form-control-danger");
    } else {
        $("#cusname").removeClass("form-control-danger");
    }

});

$("#cususername").keyup(function() {

    if ($("#cususername").val() == "") {
        $.toast({
            heading: 'Error',
            text: 'Username is required',
            showHideTransition: 'fade',
            icon: 'error',
            position: "top-right"
        })
        $("#cususername").removeClass("form-control-success");
        $("#cususername").addClass("form-control-danger");

        $("#username_error").text("Please enter your username")
        $("#username_error").removeClass("form-control-success");
        $("#username_error").addClass("form-control-danger");
    }else {
        url = ("http://localhost/myci4/users/validateusername/" + $("#cususername").val());
        $.post( url, function( data ) {
            data = JSON.parse(data);
            if (data.msg === "success"){
                $("#cususername").removeClass("form-control-danger");
                $("#cususername").addClass("form-control-success");

                $("#username_error").text("username available");
                $("#username_error").removeClass("form-control-danger");
                $("#username_error").addClass("form-control-success");
            }else{
                $("#cususername").removeClass("form-control-success");
                $("#cususername").addClass("form-control-danger");

                $("#username_error").text("username already used");
                $("#username_error").removeClass("form-control-success");
                $("#username_error").addClass("form-control-danger");
            }
        })
    }
});

$("#user-form").on("submit", function (){
   let x = $("#cususername").prop("class").split(" ")
   for(i = 0; i < x.length; i++) {
       if (x[i].toString() === "form-control-danger") {
           console.log("danger")
       }else if (x[i].toString() === "form-control-success"){
           console.log("success")
       }
   }
});