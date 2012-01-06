<?
require('class.nativeDB.php');
session_start();

$login = mysql_real_Escape_string($_POST['login']);
$pass = mysql_real_escape_string($_POST['pass']);
$pass=md5($pass);

$db = nativeDB::get_instance();
$db->init_connection();
$db->tables='users';
$db->fields='id';
$db->where="login='$login' AND pass='$pass'";
$result = $db->select();
if(!empty($result))
{
$_SESSION['id']=$result;
echo '202';
}
else
{
$_SESSION['message']='Wrong login/password';
echo '404';
}

?>