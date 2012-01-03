<?
class nativeDB
{
	private static $instance=false;
	private static $count=0;
	private static $log = false;
	private $tables=false;
	private $distinct='';
	private $fields=false;
	private $values=false;
	private $where='';
	private $group_by='';
	private $order_by='';
	private $asc_desc='';
	private $limit='';
	private $query='';
	private $query_result=false;
	private $select_result=false;
	private $connection = false;
	
	
	private function __construct()
	{
	}

	public function __clone()
	{
		return false;
	}

	public static function get_instance()
	{
		require('class.logwriter.php');
		if(!self::$instance)
		{
			$className=__CLASS__;
			self::$instance=new $className();
		}
		self::$log = Logwriter::get_instance();
		self::$log->debug('start',__CLASS__);
		self::$log->debug('create new instance of nativeDB class',__CLASS__);
		return self::$instance;
	}

	public function init_connection()
	{
		self::$log->debug('initialization db connecting ...',__CLASS__);
		$this->connection = mysql_connect("localhost","root","");
		/*if(!$this->connection)
		{
			self::$log->error('cannot connect to db ,'.mysql_error(),__CLASS__);
			return false;
		}*/
		$database = mysql_select_db("test",$this->connection);
		/*if(!$database)
		{
			self::$log->debug('cannot select db ,'.mysql_error(),__CLASS__);
			return false;
		}*/
	}


	function __call($name,$arguments)
	{
		if(strstr(CALL_METHODS,$name))
		{
			self::$log->debug("call method $name()",__CLASS__);
			$result = $this->query_build($name);
			$this->query_process($name);
			#validate_result($result);
			if($name=='select')
			{
				$result=$this->select_result;
			}
			else
			{
				$result=$this->query_result;
			}
			return $result;
		}
		else
		{
			self::$log->error("wrong method call $name()",__CLASS__);
		}
	}

	function __set($name,$value)
	{
		if(!strstr(CALL_ATTRIBUTES,$name))
		{
			self::$log->error("trying set wrong attribute $name",__CLASS__);
			return false;
		}
#$this->base_validate_attributes($value);
		switch($name)
		{
		case  'fields':
			$this->fields=$value;
			break;

		case  'tables':
			$this->tables=$value;
			break;

		case  'values':
			$this->values=$value;
			break;

		case  'where':
			$this->where='WHERE '.$value;
			break;

		case  'group_by':
			$this->group_by=$value;
			break;

		case  'order_by':
			$this->order_by=$value;
			break;

		case  'limit':
			$this->limit='LIMIT '.$value;
			break;

		case  'asc_desc':
			$this->asc_desc=$value;
			break;

		case  'distinct':
			$this->distinct=$value;
			break;

		default:break;
		}
	}


	private function query_build($type)
	{
		self::$log->debug("start buildingquery for $type",__CLASS__);
		switch($type)
		{
		case 'select':
			$this->query = "$type $this->fields from $this->tables $this->where $this->group_by $this->order_by $this->asc_desc $this->limit";
			$this->escape_spaces();
			
			break;

		case 'insert':
			$set_part = $this->to_set_format($this->fields,$this->values);
			$this->query = "$type into $this->tables set $set_part";
			
			break;

		case 'update':
			$set_part = $this->to_set_format($this->fields,$this->values);
			$this->query = "$type $this->tables set $set_part $this->where $this->limit";
			
			break;

		case 'delete':
			$this->query = "$type from $this->tables $this->where $this->limit";
			
			break;

		default:brake;
		}
		echo $this->query;

	}

	private function to_set_format($fields,$values)
	{
		$temp_str='';
		if(!strstr($fields,','))
		{
			$temp_str = "$fields = '$values'";
		}
		else
		{
			$fields = explode(',',$fields);
			$values = explode(',',$values);
			$i=0;
			foreach($fields as $field)
			{
				$temp_str .= "$field = '$values[$i]',";
				$i++;
			}
			$temp_str = substr($temp_str,0,-1);
		}
		return $temp_str;
	}

	private function escape_spaces()
	{
		$this->query = preg_replace('/\s{2,}/',' ',$this->query);
	}

	private function query_process($type)
	{
		self::$log->debug("process $type query",__CLASS__);
		$this->query_result = mysql_query($this->query) or die(mysql_error());
		if($type=='select')
		{
			$this->return_result();
		}
	}
	
	private function return_result()
	{
		$return=NULL;
		while($result = mysql_fetch_assoc($this->query_result))
		{
			foreach($result as $key=>$value)
			{
				$return[strtolower($key)][]=$value;
			}
		}
		$this->select_result=$return;
	}
	
	public function __destruct()
	{
		self::$log->debug("end",__CLASS__);
		self::$instance=false;
		self::$count--;
		mysql_close($this->connection);
	}

}
?>