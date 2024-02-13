<?php
// ----------Conexion a la base de datos mediante PDO----------------------
class Conexion extends PDO
{
    private $tipo_de_base = 'mysql';
    private $host = 'bbdd.darielsmartinezedib.com';
    private $nombre_de_base = 'ddb219218';
    private $usuario = 'ddb219218';
    private $contrasena = 'vmKvQ1Iix+JXr)';

    public function __construct()
    {
        try {
            parent::__construct(
                $this->tipo_de_base . ':host=' .
                    $this->host . ';dbname=' .
                    $this->nombre_de_base,
                $this->usuario,
                $this->contrasena
            );
            echo 'Conexión exitosa';
        } catch (PDOException $e) {
            echo 'Error al conectar a la base de datos: ' . $e->getMessage();
        }
    }
}