<?php

namespace Core;

abstract class ConstructQuery
{
    use QueryTraits;

    private static $insertInto = "INSERT INTO ";

    private static $values     = " VALUES ";

    private static $selection  = "SELECT ";

    private static $from       = " FROM ";

    private static $delete     = " DELETE ";

    private static $where      = " WHERE ";

    private static $conwhere;

    private static $table;

    private static $columnSelect;

    protected static function identifyTable($table)
    {
        self::$table = $table;
    }

    protected static function methodInsert($arrayInsert = [])
    {
        return self::constructSQL('insert', self::constructionValueField($arrayInsert));
    }

    protected static function methodSelect($column)
    {
        self::$columnSelect = $column;
        return self::constructSQL('select');
    }

    protected static function methodDelete()
    {
        return self::constructSQL('delete');
    }

    protected static function methodWhere($start,$delimiting,$final)
    {
        self::$conwhere = self::constructionMethodWhere($start,$delimiting,$final);
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
            case 'delete':
                return self::$delete . self::$from . self::$table . self::$where . self::$conwhere;
                break;
            default:
                throw new Exception("No hay tipo definido de consulta");
                break;
        }
    }
}