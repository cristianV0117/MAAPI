<?php
class AutoLoad
{
    private function loadClass($class)
    {
        try {
            $path = str_replace('\\','/',$class).'.php';
            require_once $path;
		} catch (Exception $e) {
			die("Excepcion Capturada: " . $e->getMessage() . "\n");
		}
    }

    public function load()
    {
        try {
            spl_autoload_register(array($this,'loadClass'));
		} catch (Exception $e) {
			die("Excepcion Capturada: " . $e->getMessage() . "\n");
		}
    }
}