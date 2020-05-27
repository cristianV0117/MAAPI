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

    private static $update     = " UPDATE ";

    private static $where      = " WHERE ";

    private static $and        = " AND ";

    private static $set        = " SET ";

    private static $limit      = " LIMIT ";

    private static $orderBy    = " ORDER BY ";

    private static $or         = " OR ";

    private static $conwhere;

    private static $conAndWhere;

    private static $conOrWhere;

    private static $table;

    private static $columnSelect;

    private static $limitNum;

    private static $orderElements;

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

    protected static function methodUpdate($arrayUpdate = [])
    {
        return self::constructSQL('update', self::constructionValueFieldUpdate($arrayUpdate));
    }

    protected static function methodWhere($start,$delimiting,$final)
    {
        self::$conwhere = self::constructionMethodWhere($start,$delimiting,$final);
        return self::constructSQL('select');
    }

    protected static function methodAndWhere($array = [])
    {
        self::$conAndWhere = self::constructionMethodAndWhere($array);
        //return self::constructSQL('select');
    }

    protected static function methodOrWhere($array = [])
    {
        self::$conOrWhere = self::constructionMethodOrWhere($array);
        //return self::constructSQL('select');
    }

    protected static function methodLimit($limit)
    {
        self::$limitNum = $limit;
        //return self::constructSQL('limit');
    }

    protected static function methodOrderBy($type, $order)
    {
        self::$orderElements = $type . " " . $order;
        //return self::constructSQL('orderby');
    }
 
    private static function constructSQL($type, $request = null)
    {
        switch ($type) {
            case 'insert':
                return self::$insertInto . self::$table . $request[0] . self::$values . $request[1];
                break;
            case 'update':
                return self::$update . self::$table . self::$set . $request . self::$where . self::$conwhere;
            case 'delete':
                return self::$delete . self::$from . self::$table . self::$where . self::$conwhere;
                break;
            case 'select':
                print_r(self::$conAndWhere);
                if (empty(self::$conwhere)) {
                    return self::$selection . self::$columnSelect . self::$from . self::$table;
                } else { 
                    if (empty(self::$conAndWhere)) {
                        if (empty(self::$conOrWhere)) {
                            
                            return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere;
                        } else {
                            
                            return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$or . self::$conOrWhere;
                        }
                    } else {
                        if (empty(self::$conOrWhere)) {
                            return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere;
                        } else {
                            return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$or . self::$conOrWhere;
                        }
                    }
                }
                break;
            default:
                throw new Exception("No hay tipo definido de consulta");
                break;
        }
    }
}
///////
<?php

namespace Core;

class ConstructQuery
{
    use QueryTraits;

    private  $insertInto = " INSERT INTO ";

    private  $values     = " VALUES ";

    private  $selection  = "SELECT ";

    private  $from       = " FROM ";

    private  $delete     = " DELETE ";

    private  $update     = " UPDATE ";

    private  $where      = " WHERE ";

    private  $and        = " AND ";

    private  $set        = " SET ";

    private  $limit      = " LIMIT ";

    private  $orderBy    = " ORDER BY ";

    private  $or         = " OR ";

    protected  $conwhere;

    protected  $conAndWhere;

    protected  $conOrWhere;

    protected $table;

    protected  $columnSelect;

    protected  $limitNum; 

    protected  $orderElements;

    private function constructSQL($type)
    {
        print_r($this->conwhere);
    }

    protected function identifyTable($table)
    { 
        $this->table = $table;
        
    }

    protected function methodSelect($column)
    {
        $this->columnSelect = $column;
        return $this->constructSQL('select');
    }

    protected function methodWhere($start,$delimiting,$final)
    {
        $this->conwhere = self::constructionMethodWhere($start,$delimiting,$final);
        //return $this;
        //$this->constructSQL('select');
    }

    protected function methodAndWhere($array = [])
    {
        $this->conAndWhere = self::constructionMethodAndWhere($array);
        //return $this;
        //return self::constructSQL('select');
    }

    protected function methodOrWhere($array = [])
    {
        $this->conOrWhere = self::constructionMethodOrWhere($array);
        //return $this;
        //return self::constructSQL('select');
    }

    
} 