<?php
include_once('dbcheck.php');
$res = null;
if(isset($_POST['docid'],$_POST['copyno'],$_POST['libid'],$_COOKIE['logged_in'])
    &&$_POST['docid']!=""&&$_POST['copyno']!=""&&$_POST['libid']!="") {
    $rid = $_COOKIE['logged_in'];
    $copyno = $_POST['copyno'];
    $libid = $_POST['libid'];
    $docid = $_POST['docid'];
    $sql = "INSERT INTO BORROWS (READERID, DOCID, COPYNO, LIBID, BDTIME, RDTIME)
SELECT ReaderId, DocId, CopyNo, LibId, BDateTime, NULL
WHERE NOT EXISTS (
  SELECT *
  FROM BORROWS
  WHERE DOCID = $docid AND COPYNO = $copyno AND LIBID = $libid
)
AND NOT EXISTS (
  SELECT *
  FROM RESERVES
  WHERE DOCID = $docid AND COPYNO = $copyno AND LIBID = $libid
)
AND EXISTS (
  SELECT C
  FROM (
    SELECT COUNT(*) AS C
    FROM (
      SELECT READERID FROM BORROWS WHERE READERID = $rid
      UNION ALL
      SELECT READERID FROM RESERVES WHERE READERID = $rid
    )
  )
  WHERE C < 10
);
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
