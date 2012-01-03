<?
require('class.nativeDB.php');

$login = $_POST['login'];
$pass = $_POST['pass'];
$pass=md5($pass);

$db = nativeDB::get_instance();
$db->init_connection();
$db->tables='users';
$db->fields='id';
$db->where="login='$login' AND pass='$pass'";
$result = $db->select();
if(!empty($result))
{
session_start();
$_SESSION['id']=$result;
}
else
{
$_SESSION['message']='Wrong login/password';
}

?>