<?php

namespace Src;

use PDO;
use PDOException;

class Conexion
{

    protected static $conexion;

    public function __construct()
    {
        if (self::$conexion == null) {
            self::crearConexion();
        }
    }

    protected static function crearConexion()
    {
        if (self::$conexion != null) {
            return;
        }

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "./../");
        $dotenv->load();

        $user = $_ENV["USER"];
        $pass = $_ENV["PASS"];
        $host = $_ENV["HOST"];
        $db = $_ENV["DATABASE"];

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        $opciones = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try {
            self::$conexion = new PDO($dsn, $user, $pass, $opciones);
        } catch (\PDOException $ex) {
            die("Error en crearConexion():" . $ex->getMessage());
        }
    }
}
