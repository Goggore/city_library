<?php
include_once('dbcheck.php');
$res = null;
$sql = "SELECT AVG(DELAY)*20
FROM (SELECT (RDTIME - BDTIME) AS DELAY
	FROM BORROWS
	WHERE RDTIME - BDTIME > 20	)
GROUP BY READERID
";
$result = $conn->query($sql);
if($result->num_rows > 0){
    if($row = $result->fetch_assoc()){
        $res->msg = "Average fine paid per reader: ".$row['AVG(DELAY)*20'];
    }
}else{
    $res->error = "No result";
}

if(!$res){
    $res->error = "Unknown error occurred. Please try again later.";
}
echo json_encode($res);
$conn->close();
