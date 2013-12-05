<?php


class Base{
	


private static $dblink;



public static function connect() {

$conn = odbc_connect('Troc41', 'admin41', 'azerty') or die('Could not connect !');

return($conn);

}


public static function getConnection() {
if (isset(self::$dblink)) {
return self::$dblink ;
} else {
self::$dblink = self::connect();
return self::$dblink ;
}
}

}



?>
