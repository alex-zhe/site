<?
session_start();
if(isset($_SESSION['id']))
{
$add = ($_SESSION['id']);
}
if(isset($_SESSION['message']))
{
$add = ($_SESSION['message']);
}

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
//$result['left']=$add['id'];	
//выбрать запись стаким айди
echo json_encode($result);
}
?>