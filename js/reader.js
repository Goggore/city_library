$(".checkout-btn").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#checkout-form").submit();
    }
});
$("#checkout-form").on('submit',function(event) {
    event.preventDefault()
    var docid = event.target.checkout_form_docid.value
    var copyno = event.target.checkout_form_copyno.value
    var libid = event.target.checkout_form_libid.value
    checkout_form(docid, copyno,libid,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert(res.msg)
        }
    })
})
function checkout_form(docid, copyno,libid,response) {
    $.ajax("api/checkout_form.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            docid:docid,
            copyno:copyno,
            libid:libid
        }
    })
}

$(".return-btn").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#return-form").submit();
    }
});
$("#return-form").on('submit',function(event) {
    event.preventDefault()
    var bno = event.target.return_form_bno.value
    var libid = event.target.return_form_libid.value
    return_form(bno, libid,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert(res.msg)
        }
    })
})
function return_form(bno, libid,response) {
    $.ajax("api/return_form.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            bno: bno,
            libid:libid
        }
    })
}

$("#readerInput").text("Document "+$("#searchBy option:selected").text())
$("#searchBy").change(function () {
    $("#readerInput").text("Document "+$("#searchBy option:selected").text())
})

$("#searchPub").click(function () {
    $("#searchBy, #searchbyDes").hide()
    $("#readerInput").text("Publisher ID")
})

$("#searchDoc").click(function () {
    $("#searchBy, #searchbyDes").show()
    $("#readerInput").text("Document "+$("#searchBy option:selected").text())
})

$(".search-btn").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#search-form").submit();
    }
});
$("#search-form").on('submit',function(event) {
    event.preventDefault()
    var value = event.target.search_form_value.value
    var searchBy = event.target.searchBy.value
    var searchType = $(":radio[name = 'searchType']:checked").val()
    search_form(value, searchBy,searchType,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert(res.msg)
        }
    })
})
function search_form(value, searchBy,searchType,response) {
    $.ajax("api/search_form.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            value: value,
            searchBy:searchBy,
            searchType:searchType
        }
    })
}

$(".fine-btn").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#fine-form").submit();
    }
});
$("#fine-form").on('submit',function(event) {
    event.preventDefault()
    var copyno = event.target.fine_form_copyno.value
    var docid = event.target.fine_form_docid.value
    fine_form(copyno, docid,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert(res.msg)
        }
    })
})
function fine_form(copyno, docid,response) {
    $.ajax("api/fine_form.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            copyno: copyno,
            docid:docid
        }
    })
}


$(".reserve-btn").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#reserve-form").submit();
    }
});
$("#reserve-form").on('submit',function(event) {
    event.preventDefault()
    var docid = event.target.reserve_form_docid.value
    var copyno = event.target.reserve_form_copyno.value
    var libid = event.target.reserve_form_libid.value
    reserve_form(docid, copyno,libid,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert(res.msg)
        }
    })
})
function reserve_form(docid, copyno,libid,response) {
    $.ajax("api/reserve_form.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            docid:docid,
            copyno:copyno,
            libid:libid
        }
    })
}
