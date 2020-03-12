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

    function escapeArrayData($arrayWalk)
    {
        array_walk($arrayWalk,function(& $value){
            $value = htmlentities(addslashes($value));
        });
        return $arrayWalk;
    }
}