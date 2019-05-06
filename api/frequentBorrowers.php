<?php
include_once('dbcheck.php');
$res = null;
if(isset($_POST['libID'])) {
    $libID = $_POST['libID'];
    $sql = "SELECT * FROM (SELECT TOP 10 FROM (SELECT READERID, RNAME, COUNT(*) FROM READER AS R, BORROWS AS B WHERE R.READERID = B.READERID AND LIBID = '$libID' GROUP BY READERID) ORDER BY COUNT(BORNUMBER) );";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $res->msg = "";
        $i = 1;
        while($row = $result->fetch_assoc()){
            $res->msg = $res->msg.$i.". "."ID: ".$row['READERID'].", Name: ".$row['RNAME'].", Number of borrowed books:".$row['COUNT(*)']."\n";
            $i++;
    }
    }else{
        $res->error = "No result";
    }
}
if(!$res){
    $res->error = "Unknown error occurred. Please try again later.";
}
echo json_encode($res);
$conn->close();
