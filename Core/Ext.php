<?php
namespace Core;

trait Ext
{
    public static function JSONdecode($request)
    {
        return json_decode($request, true);
    }
}