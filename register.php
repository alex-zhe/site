<?
var_dump($_FILES);
$str='';
$username=$_POST['login'];
$password=$_POST['pass'];
$confirm=$_POST['confirm'];
$path=$_FILES['error'];
echo $username,"<br>",$password,"<br>",$confirm,"<br>",$path;
?>