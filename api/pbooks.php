<?php
include_once('dbcheck.php');
$res = null;
$sql = "SELECT DOCID, TITLE
FROM (SELECT TOP 10
	FROM (SELECT DOCID, TITLE, COUNT(*)
		FROM DOCUMENT AS D, BORROWS AS B
		WHERE D.DOCID = B.DOCID 
		GROUP BY DOCID)
	ORDER BY COUNT(BORNUMBER) )
";
$sql = "SELECT * FROM DOCUMENT";
$result = $conn->query($sql);
if($result->num_rows > 0){
    $res->msg = "";
    $i = 1;
    while($row = $result->fetch_assoc()){
        $res->msg = $res->msg.$i.". "."Document ID: ".$row['DOCID'].", Title: ".$row['TITLE']."\n";
        $i++;
    }
}else{
    $res->error = "No result";
}

if(!$res){
    $res->error = "Unknown error occurred. Please try again later.";
}
echo json_encode($res);
$conn->close();
