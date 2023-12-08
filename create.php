
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css?version=52" rel="stylesheet" type="text/css"media="screen" ></link>
</head>
<body>
<div ><a href="index.php">Strona Główna</a></div>

</form><?php

if(isset($_POST["logout"])){
unset($_COOKIE["user"]);

}

  
?>
<p class="h2 ">Użytkownik:<?php
    //Ten kod wypisuje nazwę użytkownika i przekierowuje na stronę logowania, jeżeli nikt nie jest zalogowany.
if((isset($_COOKIE["user"])) && ($_COOKIE["user"]) != ""){
    echo $_COOKIE["user"];
}
else{

        header("Location:login.php");
}
    
    
?>
<form action="" method="POST"></p>
<input type='submit' class="sub" name='logout' value='Wyloguj się'> </input>
</form><?php
//Ten kod odpowiada za wylogowanie się.
if(isset($_POST["logout"])){

$_COOKIE["user"] = "";
header("Location:login.php");

}
    
    
    
?>
<form action= "create.php" method="post"><input type="text" name="series" placeholder="nazwa serii"></input>
<input type="text" name="name" placeholder="nazwa posta"></input>


<textarea name="content" placeholder="treść"></textarea>
<textarea name="bts" placeholder="za kulisami"></textarea>
<input type="submit" value="Utwórz"></input>


</form>
<?php
 //zmienia nazwę na taką, która nadaje się do pliku.
function name_to_file($name){


$array1 = [' ',':','/'];
$array2 = ['_',"_",'/'];
return str_replace($array1,$array2,(strtolower($name)));


}

//Sprawdza czy POST zostało wysłane.
if(isset($_POST["name"]) &&isset($_POST["content"])){


  if($_POST["name"] != '' && $_POST["content"]!= ''){


  //Łączy się z bazą danych.
  $db = mysqli_connect("localhost","root","","blog");
  
  //Pobiera id serii z bazy danych.
  $series_name = "";
  $s_n = "";
  $u_id = mysqli_fetch_array(mysqli_query($db,"SELECT id FROM users Where login1='".$_COOKIE["user"]."';"))["id"];
    if(isset($_POST["series"]) && $_POST["series"]!= "" ){
   
    $series_name = strval($_POST["series"]);
    $s_n = name_to_file($series_name);
    $id = mysqli_query($db,"SELECT id FROM series Where name='".$s_n."';");


//fetchuje id serii w tablicę.
    $s = mysqli_fetch_array($id);

   
      if(!isset($s) || $s == false){
      $v =mysqli_query($db,"INSERT INTO series(name) values('".$s_n."');");
    
      $id = mysqli_query($db,"SELECT id FROM series Where name='".$s_n."';");
      $s = mysqli_fetch_array($id);
      

      }



    }
    else{
    $id = 1;
    $s = mysqli_fetch_array(mysqli_query($db,"SELECT id FROM series Where name='one_shoty';"));
    $s_n= 'one_shoty';
    $series_name = $s_n;
    
    } 
   mkdir($s_n);
   //Sprawdza czy seria istnieje, a w przeciwnym wypadku ją tworzy (w bazie danych i folderach).
   
   
    //sprawdza czy istnieje już strona o tym samym tytule w tej samej serii,
  //$query_row1 = mysqli_fetch_row(mysqli_query($db,"SELECT 1 FROM posts where series_id LIKE ".$s["id"].";"));
  $query_row1 = mysqli_fetch_row(mysqli_query($db,"SELECT 1 FROM posts where name LIKE '".$_POST["name"]."' and series_id LIKE ".$s["id"].";"));
  
  if (isset($query_row1[0]) ){
  echo "Taka strona już istnieje!";
  }
  else{

  /*
  if(is_dir($_POST["series"])){
  $s = name_to_file($_POST["series"]);
  }*/
  //Tworzy plik, w którym będzie nowa strona.
  $n = name_to_file(strval($_POST["name"]));
  $new_file = fopen($s_n."/".$n.".php","w");

  //Tworzy stronę.
    function create_site($file,$db1,$s1,$u_id1){
     

  $name =strval($_POST['name']);
  $query3 = mysqli_query($db1,"INSERT INTO posts (series_id,name,user_id) values(".$s1[0].",'".$name."',".$u_id1.");");
  $query4 = mysqli_query($db1,"SELECT id FROM posts where series_id=".$s1[0]." and name ='".$name."';"); 
  $query5 = mysqli_query($db1,"SELECT login1 FROM users where id=".$u_id1[0].";"); 
    fwrite($file,"<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n<meta charset=\"UTF-8\">\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n<title>Document</title>\n<link href=\"../style.css?version=52\" rel=\"stylesheet\" type=\"text/css\"media=\"screen\" ></link>\n</head>\n<body>\n<div ><a href=\"../index.php\">Strona Główna</a></div><?php
    //Ten kod wypisuje nazwę użytkownika i przekierowuje na stronę logowania, jeżeli nikt nie jest zalogowany.
    \$db = mysqli_connect(\"localhost\",\"root\",\"\",\"blog\");
    if((isset(\$_COOKIE[\"user\"])) && \$_COOKIE[\"user\"] != \"\"){\n
    echo \"<p class='h2'>Użytkownik:\".\$_COOKIE[\"user\"].\"<form action='' method='POST'></p><input type='submit' class='sub' name='logout' value='Wyloguj się'></input>\";\n
    if(\$_COOKIE[\"user\"] =='".mysqli_fetch_row($query5)[0]."'){
     echo \"<input type='submit' class='sub' value='Usuń post' name='delete'>  </input>\";}
     else
     {echo \"<a href='login.php'>Zaloguj się</a>\";}}
    
    if(isset(\$_POST[\"delete\"])){
      \$qu2 = mysqli_query(\$db,\"Delete from posts where id=".mysqli_fetch_row($query4)[0].";\");
      unlink('".name_to_file($name).".php');
      header(\"Location:index.php\");
      }
        
    ?>
    </form><?php
    
    if(isset(\$_POST[\"logout\"])){
    \$_COOKIE[\"user\"] = \"\";
    
    }
    ?>");
    }
  create_site($new_file,$db,$s,$u_id);
    //Wypełnia stronę treścią.
    function create_info($file,$column,$name){
    fwrite($file,"<b>".$name.":</b>");
    fwrite($file,"<p>".$_POST[$column]."</p>");

    }
  create_info($new_file,"series","Seria");
  create_info($new_file,"name","Tytuł");
  create_info($new_file,"content","Treść");
  create_info($new_file,"bts","Za kulisami");

    //kończy stronę.
    function end_site($file){
    fwrite($file,"</body>\n</html>");
    }
  end_site($new_file);


  
  /*$query4 = mysqli_query($db,"SELECT id from series where name = '".$s."';");
  if(isset($query4)){
  $query_row2 = mysqli_fetch_row(mysqli_query($db,"SELECT id from series where name = '".$s."';"));
  }
  else{
  $query_row2 = mysqli_fetch_row(mysqli_query($db,"INSERT INTO series(name) values('".$s."');"));
  }*/
  //if(isset($query_row1['id'])){
  
  /*}
  else{
  $query3andhalf = mysqli_query($db,"INSERT INTO series (name) values('".$s."');");
  $query3andhalf2 = mysqli_fetch_array(mysqli_query($db,"Select id from series where name='".$s."');"));
  $query3 = mysqli_query($db,"INSERT INTO works (series_id,name) values('".$query3andhalf2['id']."','".$n."');");
  } */
  //closes the database
  mysqli_close($db);
  //heads to newly created site.
  header("Location:".$s_n."/".$n.".php");
  }



  //
 
  

}
else{
echo "<p class=\"warning\">Post musi zawierać tytuł i treść.</p>";
}
}
?>
</body>
</html>