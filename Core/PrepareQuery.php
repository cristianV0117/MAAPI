<?php
namespace Core;

use Config\Conexion;

class PrepareQuery extends Conexion
{
    public function consultQuery($query)
    {
        try {
            $this->cone->exec("SET CHARSET utf8");
            $this->consul = $this->cone->prepare($query);
            return array('resultado' => $this->consul, 'ultimoID' => $this->cone);
        } catch (Exception $e) {
            die("Excepcion Capturada: " . $e->getMessage() . "\n");
        }
    }
}