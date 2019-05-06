$("#addReader-form").on('submit',function(event) {
    event.preventDefault()
    var name = event.target.RName.value
    var address = event.target.RAddress.value
    var RID = event.target.RID.value
    var type = $('input[type=radio][name="Radio"]:checked','#addReader-form').val()
    addReader(name,address,RID,type,function (Res) {
        var res = JSON.parse(Res)
        if(res.error){
            alert(res.error)
        }
        else {
            alert("Reader ID"+res.msg+" is registered")
        }
    })
})

function addReader(name,address,RID,type, response) {
    $.ajax("api/addReader.php",{
        method:"post",
        success:response,
        datatype: "json",
        data: {
            name:name,
            address:address,
            RID:RID,
            type:type
        }
    })
}
