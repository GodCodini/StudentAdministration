<?php
require_once '../project_files/_config.php';

/**
 * Class DB
 */
abstract class DB {
    /**
     * @var PDO
     */
    public static $pdo;


    /**
     * @param $host
     * @param $dbname
     * @param $username
     * @param $password
     * @param string $database
     * @return PDO
     */
    public static function load($host, $dbname, $username, $password, $database = 'mysql') {
        try {
            if ($database == 'sqlsrv') {
                //Benötigt den Microsoft ODBC Driver 11 for SQL Server
                return self::$pdo = new PDO($database . ':server=' . $host . ';Database=' . $dbname . ';ConnectionPooling=0', $username, $password);
            } else {
                return self::$pdo = new PDO($database . ':host=' . $host . ';dbname=' . $dbname, $username, $password);
            }
        }
        catch (Exception $e) {
        }
    }

    public static function close() {
        $pdo = NULL;
    }

    /**
     * @param PDOStatement $query
     * @param array        $input_parameters
     * @return bool
     * @throws Exception
     */
    public static function execute($query, $input_parameters = NULL) {
        $success = $query->execute($input_parameters);

        if (!$success) {
            throw new Exception($query->errorCode() . ' - ' . $query->errorInfo()[2]);
        }
        elseif ($query->rowCount() > 0) {
            return true;
        }
    }

    public static function quote($string, $parameter_type = PDO::PARAM_STR) {
        return self::$pdo->quote($string, $parameter_type);
    }

    /**
     * @param $time
     * @return bool|string
     */
    public static function convertTime($time) {
        if ($time) {
            return date('H:i', strtotime($time));
        }
        else {
            return NULL;
        }
    }

    /**
     * @param $date
     * @return bool|string
     */
    public static function convertDate($date) {
        if ($date) {
            return date('d.m.', strtotime($date));
        }
        else {
            return NULL;
        }
    }
}