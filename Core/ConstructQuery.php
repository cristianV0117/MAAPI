<?php

namespace Core;

abstract class ConstructQuery
{
    use QueryTraits;

    private static $insertInto = "INSERT INTO ";

    private static $values     = " VALUES ";

    private static $selection  = "SELECT ";

    private static $from       = " FROM ";

    private static $table;

    private static $columnSelect;

    protected static function identifyTable($table)
    {
        self::$table = $table;
    }

    protected static function methodInsert($arrayInsert = [])
    {
        $response = self::constructionValueField($arrayInsert);
        return self::constructSQL('insert',$response);
    }

    protected static function methodSelect($column)
    {
        self::$columnSelect = $column;
        return self::constructSQL('select');
    }

    private static function constructSQL($type, $request = null)
    {
        switch ($type) {
            case 'insert':
                return self::$insertInto . self::$table . $request[0] . self::$values . $request[1];
                break;
            case 'select':
                return self::$selection . self::$columnSelect . self::$from . self::$table;
                break;
            default:
                throw new Exception("No hay tipo definido de consulta");
                break;
        }
    }
}