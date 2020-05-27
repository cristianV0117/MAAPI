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

    private static $groupBy    = " GROUP BY ";

    private static $innerJoin  = " INNER JOIN ";

    private static $on         = " ON ";

    private static $conwhere;

    private static $conAndWhere;

    private static $conOrWhere;

    private static $table;

    private static $columnSelect;

    private static $limitNum;

    private static $orderElements;

    private static $groupElements;

    private static $inner;

    private static $onInner;

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
    }

    protected static function methodAndWhere($array = [])
    {
        self::$conAndWhere = self::constructionMethodAndWhere($array);
    }

    protected static function methodOrWhere($array = [])
    {
        self::$conOrWhere = self::constructionMethodOrWhere($array);
    }

    protected static function methodLimit($limit)
    {
        self::$limitNum = $limit;
    }

    protected static function methodGroupBy($type)
    {
        self::$groupElements = $type;
    }

    protected static function methodOrderBy($type, $order)
    {
        self::$orderElements = $type . " " . $order;
    }

    protected static function methodJoin($array = [])
    {
        $arrayJoin = self::constructionMethodJoin($array);
        self::$inner   = $arrayJoin[0];
        self::$onInner = $arrayJoin[1];
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
                if (empty(self::$conwhere)) {
                    if (empty(self::$inner)) {
                        return self::$selection . self::$columnSelect . self::$from . self::$table;
                    } else {
                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner;
                    }
                } else { 
                    if (empty(self::$conAndWhere)) {
                        if (empty(self::$conOrWhere)) {
                            if (empty(self::$orderElements)) {
                                if (empty(self::$groupElements)) {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere;
                                    }
                                } else {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$groupBy . self::$groupElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$groupBy . self::$groupElements;
                                    }
                                }
                            } else {
                                if (empty(self::$groupElements)) {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$orderBy . self::$orderElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$orderBy . self::$orderElements;
                                    }
                                } else {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$groupBy . self::$groupElements . self::$orderBy . self::$orderElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$groupBy . self::$groupElements . self::$orderBy . self::$orderElements;
                                    }
                                }
                            }
                        } else {
                            if (empty(self::$orderElements)) {
                                if (empty($groupElements)) {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$or . self::$conOrWhere;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$or . self::$conOrWhere;
                                    }
                                } else {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$or . self::$conOrWhere . self::$groupBy . self::$groupElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$or . self::$conOrWhere . self::$groupBy . self::$groupElements;
                                    }
                                }
                            } else {
                                if (empty($groupElements)) {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$or . self::$conOrWhere . self::$orderBy . self::$orderElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$or . self::$conOrWhere . self::$orderBy . self::$orderElements;
                                    }
                                } else {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$or . self::$conOrWhere . self::$groupBy . self::$groupElements . self::$orderBy . self::$orderElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$or . self::$conOrWhere . self::$groupBy . self::$groupElements . self::$orderBy . self::$orderElements;
                                    }
                                    
                                }
                            }
                        }
                    } else {
                        if (empty(self::$conOrWhere)) {
                            if (empty(self::$orderElements)) {
                                if (empty(self::$groupElements)) {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$and . self::$conAndWhere;
                                    }
                                } else {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$groupBy . self::$groupElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$groupBy . self::$groupElements;
                                    }
                                }
                            } else {
                                if (empty(self::$groupElements)) {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$orderBy . self::$orderElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$orderBy . self::$orderElements;
                                    }
                                } else {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$groupBy . self::$groupElements . self::$orderBy . self::$orderElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$groupBy . self::$groupElements . self::$orderBy . self::$orderElements;
                                    }
                                }
                            }
                        } else {
                            if (empty(self::$orderElements)) {
                                if (empty(self::$groupElements)) {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$or . self::$conOrWhere;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$or . self::$conOrWhere;
                                    }
                                } else {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$or . self::$conOrWhere . self::$groupBy . self::$groupElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$or . self::$conOrWhere . self::$groupBy . self::$groupElements;
                                    }
                                }
                            } else {
                                if (empty(self::$groupElements)) {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$or . self::$conOrWhere . self::$orderBy . self::$orderElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$or . self::$conOrWhere . self::$orderBy . self::$orderElements;
                                    }
                                } else {
                                    if (empty(self::$inner)) {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$or . self::$conOrWhere . self::$groupBy . self::$groupElements . self::$orderBy . self::$orderElements;
                                    } else {
                                        return self::$selection . self::$columnSelect . self::$from . self::$table . self::$innerJoin . self::$inner . self::$on . self::$onInner . self::$where . self::$conwhere . self::$and . self::$conAndWhere . self::$or . self::$conOrWhere . self::$groupBy . self::$groupElements . self::$orderBy . self::$orderElements;
                                    } 
                                }
                            }
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