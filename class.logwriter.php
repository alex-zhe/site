<?
class Logwriter
{

	private static $instance=false;
	
	private function __construct(){}
	
	public static function get_instance()
	{
		require('conf.php');
		if(!self::$instance)
		{
			$className=__CLASS__;
			self::$instance=new $className();
		}
		return self::$instance;

	}
	
	private function write($type,$msg,$caller)
	{
		$date = date('d-M-Y H:i:s');
		$sep = '>>';
		$text = $date.$sep.$type.$sep.$msg.$sep.$caller.".\r";
		@file_put_contents(LOG_FILE,$text,FILE_APPEND);
	}

	public function __call($name,$attributes)
	{
		if(!strstr(DEBUG_LEVELS,$name))
		{
			return false;
		}
		$this->write($name,$attributes[0],$attributes[1]);
	}

}
?>