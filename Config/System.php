<?php
namespace Config;
trait System 
{
    private static $boolSystem;
    
    private static function dotenv()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();
    }

    public function system()
    {
        self::dotenv();
        return (self::systemVerify() === 'TRUE') ? TRUE : FALSE;
    }

    private function systemVerify()
    {
        return self::$boolSystem = getenv('SIS_STATUS');
    }

    public function getDATABASE()
    {
        self::dotenv();
        return [
            "database" => [
                "SERVER"   => getenv('DATABASE_SERVER'),
                "DB"       => getenv('DATABASE_DB'),
                "USER"     => getenv('DATABASE_USER'),
                "PASS"     => getenv('DATABASE_PASS')
            ]

        ];
    }

    public function getApyKey()
    {
        self::dotenv();
        return getenv('API_KEY');
    }
}
