<?php
namespace Core;

trait Ext
{
    public static function JSONdecode($request)
    {
        return json_decode($request, true);
    }

    public static function JSONencode($request)
    {
        return json_encode($request);
    }
}