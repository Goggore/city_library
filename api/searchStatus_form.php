<?php
include_once('dbcheck.php');
$res = null;
if(isset($_POST['docid'])
    &&$_POST['docid']!=""){
    $docid = $_POST['docid'];
    $sql1 = "SELECT COPYNO,R.READERID
FROM READER AS R, RESERVES AS S
WHERE R.READERID = S.READERID AND R.DOCID = $docid; 
";
    $sql2 = "SELECT COPYNO,R.READERID
FROM READER AS R, BORROWS AS B
WHERE R.READERID = B.READERID AND B.RDTIME is NULL AND B.DOCID = $docid;
";
    $sql3 = "SELECT COPYNO
              FROM COPY
              WHERE DOCID = $docid";
    $a = array();
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);
    if($result3->num_rows > 0){
        $res->msg = "";
        $i = 1;
        while(($result2->num_rows > 0) && $row2 = $result2->fetch_assoc()){
            $res->msg = $res->msg.$i.". "."Copy No.: ".$row2['COPYNO'].", Status: Borrowed by ".$row2['READERID']."\n";
            $i++;
            if(!in_array($row2['COPYNO'],$a))array_push($a,$row2['COPYNO']);
        }
        while(($result1->num_rows > 0 )&& $row1 = $result1->fetch_assoc()){
            $res->msg = $res->msg . $i . ". "."Copy No.: " . $row1['COPYNO'] . ", Status: Reserved by " . $row1['READERID'] . "\n";
            $i++;
            if(!in_array($row1['COPYNO'],$a))array_push($a,$row1['COPYNO']);
        }
        while(($row3 = ($result3->fetch_assoc()))) {
            if(!in_array($row3['COPYNO'],$a)){
                $res->msg = $res->msg . $i . ". " . "Copy No.: " . $row3['COPYNO'] . ", Status: Available" . "\n";
                $i++;
            }
        }
    } else{
        $res->error = "No result";
    }
}
else{
    $res->error = "Please provide required information";
}
echo json_encode($res);
$conn->close();
?>
