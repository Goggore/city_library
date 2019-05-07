<?php
include_once('dbcheck.php');
$res = null;
if(isset($_POST['name'],$_POST['address'],$_POST['type'])
    &&$_POST['name']!=""&&$_POST['address']!=""&&$_POST['type']!="") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $type = $_POST['type'];
    $sql = "INSERT INTO READER(RTYPE, RNAME, ADDRESS)
                VALUES('$type','$name','$address') ";
    if(isset($_POST['RID'])&&$_POST['RID']!=""){
        $RID =$_POST['RID'];
        $sql = "INSERT INTO READER(READERID, RTYPE, RNAME, ADDRESS)
                VALUES('$RID','$type','$name','$address') ";
    }else{
        $RID = "";
    }
    if ($conn->query($sql) === TRUE) {
        $res->msg =  $RID;
    } else {
        $res->error =  "Error: " . $sql . "<br>" . $conn->error;
    }
}
else{
    $res->error = "Please fill required fields";
}

echo json_encode($res);
$conn->close();
?>
