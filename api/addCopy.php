<?php
include_once('dbcheck.php');
$res = null;
if(isset($_POST['DocID'],$_POST['CopyNo'],$_POST['LibID'], $_POST['Position'])
    &&$_POST['DocID']!=""&&$_POST['CopyNo']!=""&&$_POST['LibID']!=""&&$_POST['Position']!="") {
    $DocID = $_POST['DocID'];
    $CopyNo = $_POST['CopyNo'];
    $LibID = $_POST['LibID'];
    $Position = $_POST['Position'];
    $sql = "INSERT INTO COPY(DOCID, COPYNO, LIBID, POSITION)
                VALUES('$DocID','$CopyNo','$LibID','$Position') ";

    if ($conn->query($sql) === TRUE) {
        $res->msg = "Copy has been added.";
    }else{
        $res->error =  "Error: " . $sql . "<br>" . $conn->error;
    }
}
else{
    $res->error = "Please fill required fields";
}

echo json_encode($res);
$conn->close();
?>
