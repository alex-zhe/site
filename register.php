<?
require_once('class.nativeDB.php');

$db = nativeDB::get_instance();
$db->init_connection();
$db->tables="users";

foreach($_POST as $key=>$value)
{
	$data[strtolower($key)]=mysql_real_escape_string($value);
}

if(!validate($data)||!check_login($data['login'],$db))
{
	$_SESSION['message']="Некорректные данные";
	exit;
}


if(strlen($_FILES["file"]["name"])<1)
{
	$data['pass']=md5($data['pass']);
	unset($data['confirm']);
	foreach($data as  $key=>$value)
	{
		$fields.=$key.",";
		$values.=$value.",";
	}
	$db->fields=substr($fields,0,-1);
	$db->values=substr($values,0,-1);
	$db->insert();
}
else
{
	if($_FILES["file"]["size"] > 1024*3*1024)
	{
		$_SESSION['message']="Размер файла превышает три мегабайта";
		exit;
	}

	if(is_uploaded_file($_FILES["file"]["tmp_name"]))
	{
		$name = $_FILES["file"]["name"];
		$path = substr(__FILE__,0,strrpos(__FILE__,'\\'));
		$full_path = $path."\public\images\\".($data['login']).$name;
		move_uploaded_file($_FILES["file"]["tmp_name"], $full_path);
		$data['pass']=md5($data['pass']);
	unset($data['confirm']);
	foreach($data as  $key=>$value)
	{
		$fields.=$key.",";
		$values.=$value.",";
	}
	$db->fields=substr($fields,0,-1).",photo";
	$db->values=substr($values,0,-1).",public/images/".$data['login'].$name;
	$db->insert();
		$_SESSION['message']="Регистрация прошла успешно";
		
	} 
	else 
	{
		$_SESSION['message']="Ошибка загрузки файла";
		exit;
	}
}


function validate($data)
{
	foreach($data as $key=>$value)
	{
		switch($key)
		{
		case "pass":
		$errors[] = (strlen($value)>=3&&strlen($value)<=40)?NULL:'1';
		
		break;
		
		case "login":
		$errors[] = (strlen($value)>=4&&strlen($value)<=20&&preg_match('/[a-zA-Zа-яА-Я \-\_\.]/',$value))?NULL:'1';

		break;

		case "Name":
			$errors[] = (strlen($value)>=4&&strlen($value)<=50&&preg_match('/[a-zA-Zа-яА-Я ]/',$value))?NULL:'1';

		break;

		case "Secondname":
			$errors[] = (strlen($value)>=4&&strlen($value)<=50&&preg_match('/[a-zA-Zа-яА-Я ]/',$value))?NULL:'1';

		break;

		case "Male":
			$errors[] = (preg_match('/(Male|Female)/',$value))?NULL:'1';

		break;

		case "birthday":
			$errors[] = (preg_match('/\d{2}\.\d{2}\.\d{4}/',$value))?NULL:'1';

		break;

		}
		
	}
	return (NULL==($errors[0]));
}

function check_login($value,$db)
{
	$db->fields="*";
	$db->where="login='$value'";
	return (!is_array($db->select()));
}
?>