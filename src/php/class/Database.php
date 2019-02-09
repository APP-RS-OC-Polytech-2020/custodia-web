<?php

class Database
{
	public static $connection;
//    private $host = "localhost:/var/run/mysql/mysql_tp.sock";
//    private $user = "rsoc_20";
//    private $password = "yd72vctb";
    private $db = "rsoc_20";

    private $host = "192.168.1.20";
    private $user = "pi";
    private $password = "narradium";

	public function __construct()
	{
		self::$connection = @mysql_pconnect($this->host, $this->user, $this->password);
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db);
	}

	public static function getInstance() {
	    if (!isset(self::$connection)) {
	        self::$connection = new Database();
        }
	    return self::$connection;
    }

	public function query($query)
	{
		$res = mysql_query($query);
		return $res;
	}

	public function close()
	{
		mysql_close();
	}
}
