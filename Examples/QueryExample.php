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
        //return $this;
    }
    
    public function insert($array = [])
    {
        $this->execute = Construct::methodInsert($array);
        //return $this;
    }

    public function select($column)
    {
        $this->get = Construct::methodSelect($column);
        //return $this;
    }

    public function delete()
    {
        $this->execute = Construct::methodDelete();
        //return $this;
    }

    public function update($array = [])
    {
        $this->execute = Construct::methodUpdate($array);
        //return $this;
    }

    public function where($start,$delimiting = null,$final)
    {
        Construct::methodWhere($start,$delimiting,$final);
        //return $this;
    }

    public function andWhere($array = [])
    {
        $this->get = Construct::methodAndWhere($array);
        //return $this;
    }

    public function orWhere($array = [])
    {
        $this->get = Construct::methodOrWhere($array);
        //return $this;
    }

    public function limit($limit)
    {
        $this->get = Construct::methodLimit($limit);
        //return $this;
    }

    public function orderBy($type, $order)
    {
       $this->get = Construct::methodOrderBy($type, $order);
       //return $this;
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
        /*$DB = new PrepareQuery;
        $return = $DB->consultQuery($query);
        if ($return['resultado']->execute()) {
            $data = $return['resultado']->fetchAll(\PDO::FETCH_ASSOC);
            if(empty($data)) {
                return (array('error' => false, 'message' => 'OK', 'last_id' => $return['ultimoID']->lastInsertId()));
            }
            else {
                return (array('error' => false, 'message' => $data));
            }
        } else {
            return (array('error' => true, 'message' => $return['resultado']->errorInfo(), 'status' => 400));
        }*/
    }
}
