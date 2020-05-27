<?php

namespace Core;

trait QueryTraits
{

    function constructionValueField($arrayInsert)
    {
        $scapeArray = self::escapeArrayData($arrayInsert);
        $temporal  = '';
        $tmpValues = '';
        foreach ($scapeArray as $key => $value) {
            $temporal .= "$key" . ",";
            if (is_numeric($value)) {
                $tmpValues .= "$value" . ",";
            } elseif ($value == 'CURRENT_TIMESTAMP') {
                $tmpValues .= "$value" . ",";
            } else {
                $tmpValues .= "'$value'" . ",";
            }
        }
        $fieldValue = substr($temporal, 0, -1);
        $valueField = substr($tmpValues, 0, -1);
        $fieldValue = "(".$fieldValue.")";
        $valueField = "(".$valueField.")";
        return array($fieldValue, $valueField);
    }

    function constructionValueFieldUpdate($arrayUpdate)
    {
        $scapeArray = self::escapeArrayData($arrayUpdate);
        $temporal = '';
		foreach ($scapeArray as $key => $value) {
			if (is_numeric($value)) {
				$temporal .= $key . " = ". $value . ",";
			} elseif ($value == 'CURRENT_TIMESTAMP') {
				$temporal .= $key . " = ". $value . ",";
			} else {
				$temporal .= $key . " = ". "'$value'" . ",";
			}
		}
		$campo = substr($temporal, 0, -1);
		return $campo;
    }

    function escapeArrayData($arrayWalk)
    {
        array_walk($arrayWalk,function(& $value){
            $value = htmlentities(addslashes($value));
        });
        return $arrayWalk;
    }

    function constructionMethodWhere($start,$delimiting,$final)
    {
        if (is_numeric($final)) {
			$final = $final;
        } else {
			$final = "'$final'";
        }
        
        return $start ." ".$delimiting." ".$final;
    }

    function constructionMethodAndWhere($array)
    {
        $result = '';
        for ($i=0; $i < count($array); $i++) { 
			if (is_numeric($array[$i][2])) {
                $array[$i][2] = $array[$i][2];
			} else {
				$valor = $array[$i][2];
				$array[$i][2] = "'$valor'";
			}
        }
		$new = '';
		if (count($array) === 1) {	
			foreach ($array[0] as $value) {
				$result .= $value . " ";
			}
		}
		for ($i=0; $i < count($array); $i++) { 
			$new .= $array[$i][0] . $array[$i][1] . $array[$i][2] . ' AND ';	
		}
		$result = substr($new,0,-4);
        return $result;
    }

    function constructionMethodOrWhere($array)
    {

        $result = '';
        for ($i=0; $i < count($array); $i++) { 
		    if (is_numeric($array[$i][2])) {
				$array[$i][2] = $array[$i][2];
			} else {
				$valor = $array[$i][2];
				$array[$i][2] = "'$valor'";		
			}
		}
		$new = '';
		if (count($array) === 1) {	
			foreach ($array[0] as $value) {
				$result .= $value . " ";
			}
		}
		for ($i=0; $i < count($array); $i++) { 
			$new .= $array[$i][0] . $array[$i][1] . $array[$i][2] . ' OR ';
		}
		$result = substr($new,0,-4);
		return $result;
    }

    function constructionMethodJoin($array)
    {
        $new = '';
        if (count($array) === 1) {
            return array($array[0][0], $array[0][1] . " " . $array[0][2] . " " . $array[0][3]);
        } else {
            $a = 0;
			for ($i=0; $i < count($array); $i++) { 
			    if ($i == 0) {
				    $a = $a - 1;
                }
                $a++;
                if ($a == 0) {
                    $a = $a + 1;
                }
                $new .=  $array[$i][1] ." ".$array[$i][2]." ". $array[$i][3]."," . ' INNER JOIN ' . $array[isset($array[$a]) ? $a : $a - 1][0] . " ON ";
            }
			$new = explode(",",$new);
			array_pop($new);
			$resultado = implode(" ", $new);											
            return array($array[0][0], $resultado);
        }
    }
}