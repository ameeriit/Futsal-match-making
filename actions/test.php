<?php
include "../connections/db.php";
// $query=mysqli_query($con,"SELECT * from futsal where fid=1");
// $result=mysqli_fetch_assoc($query);
// $s_time=$result['opening_time'];
// $e_time=$result['closing_time'];
// Echo("printing retrived time"."<br>");
// echo($s_time);
// echo("<br>".$e_time."<br>");
// Echo("printing type");
// echo "<br>";
// echo("s_time:");
// echo(gettype($s_time));
// echo "<br>";
// echo("e_time:");
// echo(gettype($e_time));

// //inserting into array and exploding using :
// $arry1=explode(":",$s_time);
// $arry2=explode(":",$e_time);
// $st=$arry1[0];
// $et=$arry2[0];
// echo "<br>";
// echo("Print first value of array"."<br>");
// echo("s_time: ".$st."<br>"."e_time: ".$et);
// echo "<br>";
// echo("types"."<br>");
// echo(gettype($st));
// echo "<br>";
// echo(gettype($et));
// $st=$st+0;
// $et=$et+0;
// echo "<br>";
// echo("After changing type"."<br>");
// echo(gettype($st));
// echo "<br>";
// echo(gettype($et));
// echo "<br>";
// echo $st."<br>".$et;
// $st++;
// echo "<br>";
// echo "Value of s_time after +1 is : ".$st;
// echo(gettype($st));
// $s_time=$st;
// if($s_time<10){
// 	$s_time=(string)$st;
// 	echo("<br>"."After converting back to string st"."<br>");
// 	echo(gettype($s_time));
// 	$s_time='0'.$st.':00:00';
// 	echo "<br>";
// 	echo $s_time;
// 	echo "<br>";
// 	echo(gettype($s_time));
// }else{
// 	$s_time=(string)$st;
// 	echo("<br>"."After converting back to string st"."<br>");
// 	echo(gettype($s_time));
// 	$s_time=$st.':00:00';
// 	echo "<br>";
// 	echo $s_time;
// 	echo "<br>";
// 	echo(gettype($s_time));
// }

// echo("<br>"."After ")
//echo($st."<br>".$arry1[0]);
$bank_query1=mysqli_query($con,"SELECT bnk_id from bank where uid=49 or uid=37");
if(!$bank_query1){
	echo("Error");
}else{
	echo "Success";
}
?>
