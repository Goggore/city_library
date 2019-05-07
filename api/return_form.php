<?php
include_once('dbcheck.php');
$res = null;
$seconds = time();
$date = date('Y-m-d', $seconds);
if(isset($_POST['bno'],$_POST['libid'])
    &&$_POST['bno']!=""&&$_POST['libid']!="") {
    $libid = $_POST['libid'];
    $bno = $_POST['bno'];
    $sql = "UPDATE BORROWS
SET RDTIME = $date
WHERE BORNUMBER = ($bno AND
LIBID = $libid);
;
 ";
    if ($conn->query($sql) === TRUE) {
        $res->msg =  "Successful!";
    } else {
        $res->error =  "Error: " . $sql . "<br>" . $conn->error;
    }
}
else{
    $res->error = "Please provide required information";
}
echo json_encode($res);
$conn->close();
?>
