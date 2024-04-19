$(".password").keyup((e)=>{
    if(($("#password").val() == $("#repassword").val()) && $("#password").val().length > 3){
        $("#bntregister").prop("disabled", false);
    } else {
        $("#bntregister").prop("disabled", true);
    }
});


function returnFilm(idfilm){
fetch("devolution.php", {
    method: 'POST',
    body: JSON.stringify({idfilm: idfilm}),
    headers: {
        'Content-Type': 'application/json'
    },
}).then(response=>response.json())
.then(data=>()=>{
    let link = `<a href='rent.php?idfilm=${data.idfilm}'><button>Rent this film</button></a>`;
   
    document.getElementById("ShowCorrectBtn").innerHTML = link;
})
}