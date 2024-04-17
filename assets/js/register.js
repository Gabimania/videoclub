$(".password").keyup((e)=>{
    if(($("#password").val() == $("#repassword").val()) && $("#password").val().length > 3){
        $("#bntregister").prop("disabled", false);
    } else {
        $("#bntregister").prop("disabled", true);
    }
});
