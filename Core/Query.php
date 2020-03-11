<?php
namespace Core;

use Core\ConstructQuery as Construct;
use Core\PrepareQuery;

class Query extends Construct
{
    public function table($tabla)
    {
        $table = Construct::identifyTable($tabla);
        return $this;
    }
    
    public function insert($array = [])
    {
        $this->executeQUERY(Construct::methodInsert($array));
        return $this;
    }

    private function executeQUERY($query)
    {
        $DB = new PrepareQuery;
        $return = $DB->consultQuery($query);
        if ($return['resultado']->execute()) {
            $data = $return['resultado']->fetchAll();
            if(empty($data)) {
                return array('ejecutado' => true, 'ultimoID' => $return['ultimoID']->lastInsertId());
            }
            else {
                return array('respuesta' => $data);
            }
        } else {
            return array('error' => $return['resultado']->errorInfo());
        }
    }
}
