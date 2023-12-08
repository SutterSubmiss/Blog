<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css?version=51" rel="stylesheet"></link>
</head>
<body>

<div class="container">
<div class="log">
<form action="" method="POST">
    <p >Podaj conajmniej dwuznakowy login i conajmniej sześcioznakowe hasło. Ani w jednym, ani w drugim nie może być spacji.</p>
<input type='text' class="tex" name='login'></input>
<input type='password' class="tex" name='haslo'></input>
<input type='submit' class="sub" name="login_button" value='Zaloguj się'> </input>
<input type='submit' class="sub" name="sign_button" value='Zarejestruj się'> </input>
</form>
<?php
//Ten kod odpowiada za pprzekierowanie na stronę główną, jeżeli użytkownik jest już zalogowany.
if(isset(($_COOKIE["user"]))){
    header("Location:index.php");
}
//Ten kod odpowiada za połączenie się z bazą danych.
$db = mysqli_connect('localhost','root','','blog');
$qu_uzytkownicy = mysqli_query($db,"Select * FROM users");

 //Ta funkcja sprawdza, czy tekst spełnia wymagania dla loginu.
function login_requirements($str){
    if(strlen($str) >= 2 && !str_contains($str," ")){

    return True;

    }
    else{

    return False;

    }


}
//Ta funkcja sprawdza, czy tekst spełnia wymagania dla hasła.
function haslo_requirements($str){

    if(strlen($str) >= 6 && !str_contains($str," ")){

    return True;
    }
    else{
    return False;
    }

}
//Ten kod odpowiada za zarejestrowanie się.
if(isset($_POST["sign_button"])){
    $query_row1 = mysqli_fetch_row(mysqli_query($db,"SELECT 1 FROM users where login1 LIKE '".$_POST["login"]."';"));
  
    if (isset($query_row1[0]) ){
    echo "Taki użytkownik już istnieje!";
    }
  else if(haslo_requirements($_POST["haslo"]) && login_requirements($_POST["login"])){

  
    $qu = mysqli_query($db,"Insert Into users(login1,haslo) values('".$_POST['login']."','".$_POST['haslo']."');");
    setcookie("user",$_POST['login']);
    
    header("Location:index.php");

    }
    else{

    echo "<p class= \"row\" \"error1\">Wpisz login i haslo zgodnie z zasadami!</p>";
    
    }

}
//Ten kod odpowiada za zalogowanie się.
if(isset($_POST["login_button"])){

    while($row = mysqli_fetch_array($qu_uzytkownicy)){
        
        if($_POST['login'] == $row['login1'] && $_POST['haslo'] == $row['haslo']){

            setcookie("user",$_POST['login']);
            header("Location:index.php");
        }
    }
    echo "Login lub hasło niepoprawne. Spróbuj ponownie.";

}
?>

</div>
</div>
</body>