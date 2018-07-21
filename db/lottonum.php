
<html>
    <head>
        <meta charset="UTF-8">

        <h1>parsing</h1>

    </head>

    <body>

    <?php
	#밑에 커넥하는 부분 디비 비번 바껴서 고것만 고침 -희원 원래 1wALP9GyQ5hy 엿음
        $connect = mysql_connect("localhost", "root", "qnwkehlfwlsl", "lotto");
	mysql_select_db("wnumbers", $connect);

	$result = mysql_query("SELECT id,one,two,three,four,five,six,bonus FROM wnumbers", $connect) or die("넣기 실패");
    	
	if(file_exists('/lottonum.txt'))
	    { unlink('./lottonum.txt'); } #이전에 만든 파일이 있으면 삭제

	$newline = chr(10); #줄바꿈의 ascii 번호

#	$result = mysql_query("SELECT id,one,two,three,four,five,six,bonus FROM wnumbers INTO OUTFILE 'lottonum.txt'", $connect) or die("걍 죽어");

	$fp = fopen("./lottonum.txt","w") or die("lottonum cannot be opened");
  	
	$row = mysql_fetch_array($result)

#	fwrite($fp, $row);
	
	while($row = mysql_fetch_array($result))
	{ 
	    #echo "'$row[id]' '$row[one]'<br> \n"; 

	    $fwrite($fp, $row);
	    $fwrite($fp, $newline);
	    $row = mysql_fetch_array($result);
	}

	fclose($fp);	    
    ?>

    </body>
</html>
