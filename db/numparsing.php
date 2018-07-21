<html>
<head>
<meta charset="UTF-8">

<h1>parsing</h1>

</head>
<body>

<?php
  #여기두 비번이 바껴서 비번만 고침 -희원 
  $conn = mysqli_connect("localhost","root","qnwkehlfwlsl","lotto");   
         
 if(mysqli_connect_errno($conn)){
 echo "db연결 실패".mysqli_connect_error();
 }           
 else 
  echo "db 연결성공<br>";


 include_once 'Snoopy/Snoopy.class.php';
 $snoopy = new snoopy;
 $snoopy->fetch("http://m.nlotto.co.kr/gameResult.do?method=byWin");
 $txt = $snoopy->results;
 preg_match('/<h3.+?class="result_title"(.+?)<\/strong>/',$txt,$title);
 $title = preg_replace("/[^0-9]*/s","",$title);
// print_r($title);


 preg_match_all('/ball_(\w+)/m',$txt,$wnum);//
// print_r($wnum);

 preg_match('/<span.*>\((.*?)<\/span>/',$txt,$date);
// print_r($date);  
 $when= preg_replace("/[^0-9]*/s","",$date);

 $i =$when[1];
 $date = substr($i,0,4).".";
 $date .=substr($i,4,2);
 $date .=".";
 $date .=substr($i,6,2);

 
 echo "<br /> 날짜 : ".$when[1]." 자르기: ".$date;
 echo " 회차: ".$title[1];
 $wnum1=$wnum[1][0];
 $wnum2=$wnum[1][1];
 $wnum3=$wnum[1][2];
 $wnum4=$wnum[1][3];
 $wnum5=$wnum[1][4];
 $wnum6=$wnum[1][5];
 $bonus=$wnum[1][6];
// var_dump($wnum);

 preg_match_all('/<td.+?class="rt"(.+?)<\/td>/',$txt,$wprice);
// var_dump($wprice);
 $price= preg_replace("/[^0-9]*/s","",$wprice[1]);
// print_r($price);
 echo "<br /> 1등 :".$price[2]." 2등".$price[5]." 3등".$price[8]." 4등".$price[11]." 5등".$price[14];


try{
   $sql = "INSERT INTO wnumbers (id,date,one,two,three,four,five,six,bonus)
   VALUES($title[1],'$date',$wnum1,$wnum2,$wnum3,$wnum4,$wnum5,$wnum6,$bonus)";
   $result = mysqli_query($conn, $sql);

   $sql2 = "INSERT INTO wprice (id,first_price,second_price,third_price,forth_price,fifth_price)
    VALUES($title[1],$price[2],$price[5],$price[8],$price[11],$price[14])";
   $result2 = mysqli_query($conn, $sql2);

   syslog(LOG_INFO,'parsing!');
   } catch(Exception $e){
    echo $e->getMessage();
   }
?>

</body>

</html>
