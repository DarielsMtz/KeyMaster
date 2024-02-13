<?php
// session_start();

// // Datos de acceso a Mysql
// $host = "bbdd.darielsmartinezedib.com";
// $user = "ddb219218";
// $pass = "vmKvQ1Iix+JXr";
// $bd = "";

// // Realización de la conexion 
// $conexion = mysqli_connect($host, $user, $pass, $bd);
// if ($conexion) {
//     echo "Conexion exitosa";

//     // Creacion de la base de datos keymaster
//     $sql = "CREATE DATABASE IF NOT EXISTS keymaster";
//     $resultado = mysqli_query($conexion, $sql);
//     if ($resultado) {
//         echo "<br>Base de datos '<b>keymaster</b>' creada";

//         // Creacion de las tablas de la base de datos
//         $sql = "CREATE TABLE IF NOT EXISTS keymaster.usuarios (
//                 id_usuario INT NOT NULL AUTO_INCREMENT,
//                 nombre VARCHAR(255) NOT NULL,
//                 correo VARCHAR(255) NOT NULL,
//                 contrasena VARCHAR(255) NOT NULL,
//                 PRIMARY KEY (id_usuario))";

//         $resultado = mysqli_query($conexion, $sql);
//         if ($resultado) {
//             echo "<br>Tabla '<b>usuarios</b>' creada";
//         } else {
//             echo "<br>Tabla '<b>usuarios</b>' no creada";
//         }
//     } else {
//         echo "Error al crear la base de datos keymaster";
//     }

//     // Creacion de la tabla de contraseñas
//     $sql = "CREATE TABLE IF NOT EXISTS keymaster.contrasenas (
//         id INT AUTO_INCREMENT PRIMARY KEY,
//         contrasena VARCHAR(255) NOT NULL,
//         fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//         id_usuario INT NOT NULL,
//         usuario VARCHAR(225) NOT NULL
//       );";

//     $resultado = mysqli_query($conexion, $sql);
//     if ($resultado) {
//         echo "<br>Tabla '<b>contrasenas</b>' creada";
//     } else {
//         echo "<br>Tabla '<b>contrasenas</b>' no creada";
//     }
// } else {
//     echo "Error al conectar a la base de datos";
// }

// ----------------- Insercion de datos de prueba -----------------
// Calse de datos de conexion a la BBDD keymaster
class Conexion extends PDO
{
    private $host = "bbdd.darielsmartinezedib.com";
    private $user = "ddb219218";
    private $pass = "vmKvQ1Iix+JXr)";
    private $bd = "ddb219218";

    public function __construct()
    {
        try {
            parent::__construct(
                'mysql:host=' . $this->host .
                    ';dbname=' . $this->bd,
                $this->user,
                $this->pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4')
            );
            echo "Conexion exitosa";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}