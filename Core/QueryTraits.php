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
}