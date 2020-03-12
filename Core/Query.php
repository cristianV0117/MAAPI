<?php
namespace Core;

use Core\ConstructQuery as Construct;

use Core\PrepareQuery;

use Core\Response;

class Query extends Construct
{
    private $execute;

    private $get;
    
    public function table($tabla)
    {
        Construct::identifyTable($tabla);
        return $this;
    }
    
    public function insert($array = [])
    {
        $this->execute = Construct::methodInsert($array);
        return $this;
    }

    public function select($column)
    {
        $this->get = Construct::methodSelect($column);
        return $this;
    }

    public function save()
    {
        $this->executeQUERY($this->execute);
        return $this;
    }

    public function get()
    {
        $this->executeQUERY($this->get);
    }

    private function executeQUERY($query)
    {
        $DB = new PrepareQuery;
        $return = $DB->consultQuery($query);
        if ($return['resultado']->execute()) {
            $data = $return['resultado']->fetchAll(\PDO::FETCH_CLASS);
            if(empty($data)) {
                Response::responseData(array('error' => false, 'message' => 'Registrado correctamente','ultimoID' => $return['ultimoID']->lastInsertId()), 201);
            }
            else {
                Response::responseData(array('error' => false, 'message' => $data), 200);
            }
        } else {
            Response::responseData(array('error' => true, 'message' => $return['resultado']->errorInfo()), 400);
        }
    }
}
