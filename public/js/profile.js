//*** Edit / Cancel Button ***//
editBtn = $("#editBtn")
form =  $(".form-horizontal")
editBtn.on("click", function(){
    if (editBtn.text() === "Edit") {
        editBtn.removeClass("btn-success");
        editBtn.addClass("btn-danger");
        editBtn.text("Cancel");
        $("#updateBtn").show();
        form.inputEnable();
    }else {
        editBtn.removeClass("btn-danger");
        editBtn.addClass("btn-success");
        editBtn.text("Edit");
        $("#updateBtn").hide();
        form.inputDisable();
    }
})
//*** End Edit / Cancel Button ***//

//*** Update Profile Button ***//
updateBtn = $("#updateBtn");
domain = $("#domain").prop("href");
let url = domain + "/profile/profileupdate"
updateBtn.on("click",function(){
    let a = $("#fullname");
    let b = $("#email");
    let c = $("#mobile");
    let d = $("#description");

    let fullname = a.val() ;
    let email = b.val();
    let mobile = c.val();
    let description = d.val();

    $.post( url,{fullname: fullname, email: email, mobile: mobile, description: description},
        function( data ) {
        data = JSON.parse(data);
        if (data.msg === "success"){
            $.toast({
                text: 'Profile successfully updated',
                showHideTransition: 'fade',
                icon: 'success',
                position: "top-right",
                bgColor: '#2dce89',
                textColor: 'white'
            });
            form.inputDisable();
            $("#updateBtn").hide();
            editBtn.removeClass("btn-danger");
            editBtn.addClass("btn-success");
            editBtn.text("Edit");

            $("#card_name").text(fullname);
            $("#card_email").text(email);
            $("#card_mobile").text(mobile);

            $("#card-name").text(fullname);
            $("#card-email").text(email);
            $("#card-mobile").text(mobile);
            $("#card-description").text(description);



        }else {
            $.toast({
                text: "An error occur. Please try again later!!",
                showHideTransition: 'fade',
                icon: 'error',
                position: "top-right",
                bgColor: '#f5365c',
                textColor: 'white',
                hideAfter: 5000,
            });
        }
    });
})
//*** End Update Profile Button ***//