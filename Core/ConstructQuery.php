<?php

namespace Core;

abstract class ConstructQuery
{
    use QueryTraits;

    private static $insertInto = "INSERT INTO ";

    private static $values     = " VALUES ";

    private static $table;

    protected static function identifyTable($table)
    {
        self::$table = $table;
    }

    protected static function methodInsert($arrayInsert = [])
    {
      $response      = self::constructionValueField($arrayInsert);
      return self::constructSQL('insert',$response);
    }

    private static function constructSQL($type, $request)
    {
        switch ($type) {
            case 'insert':
                return self::$insertInto . self::$table . $request[0] . self::$values . $request[1];
                break;
            default:
                throw new Exception("No hay tipo definido de consulta");
                break;
        }
    }
}