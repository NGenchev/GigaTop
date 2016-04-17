<? 
include("conf.php"); 
$calc = $time - $dtime; 
$total = mysqli_num_rows(mysqli_query($db_conn, "SELECT COUNT(ip) FROM $dbtable WHERE ctime < \"$calc\"")); 
$i = 0; 
while($i < $total) { 
$sql = mysqli_query($db_conn, "DELETE from $dbtable WHERE ctime < \"$calc\""); 
$i++; 
} 
echo "Ненужните записи са изтрити успешно!"; 
?> 