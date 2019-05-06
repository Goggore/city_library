$("#readerMenu").click(function () {
    $("#login-form").hide()
    $("#reader-form").show()

})
$("#adminMenu").click(function () {
    $("#reader-form").hide()
    $("#login-form").show()
})
$("#reader-form").on('submit',function(event) {
    event.preventDefault()
    var cardNO = event.target.CardNO.value
    login(cardNO,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert("Welcome back,"+res.name)
            window.location.href = "home.php"
        }
    })
})
function adminCheck() {
    event.preventDefault()
    if(document.getElementById("IDInput").value == 123 && document.getElementById("PasswordInput").value == 123){
        $.Cookie("logged-in", "admin", { path: '/', exipires: 1000 });
        $(location).attr("href","home.php")
    }else{
        alert("Invalid account information")
    }
}
function login(cardNO, response) {
    $.ajax("api/login.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            cardNO:cardNO
        }
    })
}
