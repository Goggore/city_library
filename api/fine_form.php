<?php
include_once('dbcheck.php');
$res = null;
$seconds = time();
$readerID = $_COOKIE['logged_in'];
$date = date('Y-m-d', $seconds);
if(isset($_POST['copyno'],$_POST['docid'])
    &&$_POST['copyno']!=""&&$_POST['docid']!="") {
    $docid = $_POST['docid'];
    $copyno = $_POST['copyno'];
    $sql = "SELECT DATEDIFF('$date', BDTIME) * 20
          FROM BORROWS
          WHERE RDTIME IS NULL AND DATEDIFF('$date', BDTIME) > 20	AND DOCID = $docid AND COPYNO = $copyno AND READERID = $readerID
           ";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $sum = 0;
        while($row = $result->fetch_array()){
            $sum += (int)$row[0];
        }
        $res->msg =  $sum." cents";
    }else{
        $res->error = "No result";
    }
}
else{
    $res->error = "Please provide required information";
}
echo json_encode($res);
$conn->close();
?>
