<?
require_once('class.nativeDB.php');
session_start();
$id=false;
$message=false;
$data="";
if(isset($_SESSION['id']))
{
$id = ($_SESSION['id']['id'][0]);
}
if(isset($_SESSION['message']))
{
$message = ($_SESSION['message']);
unset($_SESSION['message']);
}

if($id)
{
$tpl_var=array('%NAME','%SECONDNAME','%BIRTHDAY','%PHOTO','%HOBBIES','%CINEMA','%MUSIC');
$db=nativeDB::get_instance();
$db->init_connection();
$db->tables="users";
$db->fields="*";
$db->where="id='$id'";
$data = $db->select();
$name = $data['name'][0];
$secondname= $data['secondname'][0];
$birthday=$data['birthday'][0];
$male=$data['male'][0];
$photo =  $data['photo'][0];
$hobbies=$data['hobbies'][0];
$cinema=$data['cinema'][0];
$music=$data['music'][0];
$rplc_var = array($name,$secondname,$birthday,$photo,$hobbies,$cinema,$music);
$template = 'userpage,userpage_text,userpage_menu';
$template = explode(',',$template);
$temp='';
foreach($template as $tpl)
{
$temp.= file_get_contents("tpl/$tpl.tpl");
}
preg_match_all('!<to>(.*)</to>!',$temp,$to);
preg_match_all('!<content>([^0-9]*?)</content>!',$temp,$content);
$i=0;
foreach($to[1] as $key)
{
$result[$key]=str_replace($tpl_var,$rplc_var,$content[1][$i]);
$i++;
}
}

else
{
$template=$_GET['tpl'];
$data='';
if(strstr($template,','))
{
$template=explode(',',$template);
foreach($template as $tpl)
{
$data.= file_get_contents("tpl/$tpl.tpl");
}
preg_match_all('!<to>(.*)</to>!',$data,$to);
preg_match_all('!<content>([^0-9]*?)</content>!',$data,$content);
$i=0;
foreach($to[1] as $key)
{
$result[$key]=$content[1][$i];
$i++;
}
}

if($message)
{
$result['message']=$message;	
}
}
//выбрать запись стаким айди
echo json_encode($result);


?>