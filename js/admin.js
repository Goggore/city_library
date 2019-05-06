
$(".analysis-fb-btn").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $(".analysis-form").submit();
    }
});
$("#analysis-fb").on('submit',function(event) {
    event.preventDefault()
    var libID = event.target.analysis_fb_value.value
    analysis_FB(libID,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert(res.msg)
        }
    })
})
function analysis_FB(libID,response) {
    $.ajax("api/frequentBorrowers.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            libID:libID
        }
    })
}

$(".analysis-books-btn").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $(".analysis-books-form").submit();
    }
});
$("#analysis-books").on('submit',function(event) {
    event.preventDefault()
    var libID = event.target.analysis_books_value.value
    analysis_BK(libID,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert(res.msg)
        }
    })
})
function analysis_BK(libID,response) {
    $.ajax("api/books.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            libID:libID
        }
    })
}

function analysis_PB() {
    $.ajax("api/pbooks.php",{
        method:"post",
        datatype: "json",
        success:function (Res) {
            var res = JSON.parse(Res)
            if(res.error){
                alert(res.error)
            }
            else {
                alert(res.msg)
            }
        },
        data: {
        }
    })
}



function analysis_FINE(response) {
    $.ajax("api/fine.php",{
        method:"post",
        datatype: "json",
        success:function (Res) {
            var res = JSON.parse(Res)
            if(res.error){
                alert(res.error)
            }
            else {
                alert(res.msg)
            }
        },
        data: {
        }
    })
}
