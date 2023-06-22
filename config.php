<?
error_reporting(E_ALL ^E_NOTICE ^E_WARNING);

//Database Settings
$calender['dbhost'] = '(local)\SQLEXPRESS';
$calender['database'] = 'dbname';
$calender['dbuser'] = 'dbuser';
$calender['dbpassword'] = 'dbpass';

$connect = @mssql_connect($calender['dbhost'], $calender['dbuser'], $calender['dbpassword'], true);
$select_db = @mssql_select_db($calender['database']);

If (!$connect) die ("<img src=images/warning.gif> Cannot connect to SQL Server.");
If (!$select_db) die ("<img src=images/warning.gif> Connection with SQL Server database Failed!");
?>
