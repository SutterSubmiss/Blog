
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link href="style.css?version=51" rel="stylesheet" type="text/css"media="screen" ></link>
</head>
<body>
<container class="cont">
<?php
//Ten kod wypisuje nazwę użytkownika i przekierowuje na stronę logowania, jeżeli nikt nie jest zalogowany.
if((isset($_COOKIE["user"])) && $_COOKIE["user"] != ""){
echo "<p class=\"h2 \">Użytkownik: ".$_COOKIE["user"]."<form action=\"\" method=\"POST\"></p><input type='submit' class=\"sub\" name='logout' value='Wyloguj się'> </input>";
}
else{
    echo "<a href=\"login.php\">Zaloguj się</a>";
}
    
    
?>
</form><?php

if(isset($_POST["logout"])){
unset($_COOKIE["user"]);
header("Location:login.php");

}   
?>
<div class="articles">
<h1 class = "art">Artykuły</h1>
<div class="posts"><h2 >Posty</h2>
<?php
//zmienia nazwę na taką, która nadaje się do pliku.
function name_to_file($name){

$array1 = [' ',':','/'];
$array2 = ['_',"_",'_'];
return str_replace($array1,$array2,(strtolower($name)));

}
//Łączenie się z bazą danych bloga.
$db = mysqli_connect("localhost","root","","blog");
//Wybranie dzieł z bazy.
$query = mysqli_query($db,"SELECT * FROM posts");
//Wypisanie nazw wszystkich postów.
while($array = mysqli_fetch_array($query)){

$query_row2 = mysqli_fetch_row(mysqli_query($db,"SELECT name from series where series.id = ".$array['series_id'].";"));
echo "<p><a href='".name_to_file($query_row2[0])."/".name_to_file($array['name']).".php'>".$array['name']."</a></p>";



}
//Zamknięcie bazy danych fetyszwersum.
mysqli_close($db);
?>

<div><a href="create.php">Utwórz nowe</a></div>
</div>
   
</container>
</div>
</body>
</html>