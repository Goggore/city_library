function switchPage(btns) {
    btns.forEach(function (i) {
        $(i).click(function () {
            btns.forEach(function (j) {
                if(i!=j){
                    $(j+"Page").hide()
                    $(j).removeClass("active")
                }
            })
            $(i+"Page").show()
            $(i).addClass("active")
        })
    })
}
function logout() {
    document.cookie=('logged_in=;expires=Thu, 06 Jan 2005 01:00:00 GMT')
    window.location.href='login.html'
}
