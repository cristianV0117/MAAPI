<?php

namespace Core;

trait Validations
{
    public static function ifThereIsData($data,$delimiting)
    {
		$var = '';
		foreach ($delimiting as $key => $value) {	
			if (!empty($data[$key])) {
				$var .= 'lleno';
			} else {
				$var .= 'vacio@';
			    break;
			}
		}
		if (!strpos($var,'@')) {
			return true;
		} else {
			return false;
		}
    }
}