$("#addCopy-form").on('submit',function(event) {
    event.preventDefault()
    var DocID = event.target.DocID.value
    var CopyNo = event.target.CopyNo.value
    var LibID = event.target.LibID.value
    var Position = event.target.Position.value
    addCopy(DocID,CopyNo,LibID,Position,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert(res.msg)
        }
    })
})

function addCopy(DocID,CopyNo,LibID,Position, response) {
    $.ajax("api/addCopy.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            DocID:DocID,
            CopyNo:CopyNo,
            LibID:LibID,
            Position:Position
        }
    })
}
