<?php
namespace Core;

use Core\ConstructQuery as Construct;

use Core\PrepareQuery;

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

    public function delete()
    {
        $this->execute = Construct::methodDelete();
        return $this;
    }

    public function where($start,$delimiting = null,$final)
    {
        Construct::methodWhere($start,$delimiting,$final);
        return $this;
    }

    public function save()
    {
        return $this->executeQUERY($this->execute);
    }

    public function get()
    {
        return $this->executeQUERY($this->get);
    }
    
    private function executeQUERY($query)
    {
        $DB = new PrepareQuery;
        $return = $DB->consultQuery($query);
        if ($return['resultado']->execute()) {
            $data = $return['resultado']->fetchAll(\PDO::FETCH_CLASS);
            if(empty($data)) {
                return (array('error' => false, 'message' => 'OK', 'ultimoID' => $return['ultimoID']->lastInsertId(), 'status' => 201));
            }
            else {
                return (array('error' => false, 'message' => $data, 'status' => 200));
            }
        } else {
            return (array('error' => true, 'message' => $return['resultado']->errorInfo(), 'status' => 400));
        }
    }
}
