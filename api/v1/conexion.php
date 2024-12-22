<?php

class Conexion
{
    private $connection;
    private $host;
    private $username;
    private $password;
    private $db;
    private $port;
    private $server;

    public function __construct()
    {
        $this->server = $_SERVER['SERVER_NAME'];
        $this->connection = null;
        //$this->host = 'localhost';
        $this->host = '127.0.0.1';
        $this->port = 3306; //puerto por default de mysql
        $this->db = 'ev03';
        $this->username = 'ev03';
        $this->password = '1234';

        /*
        SQL: Crear la bd y la tabla

        -- Crear la base de datos
        CREATE DATABASE `ev03`;

        -- Crear el usuario y asignarle una contraseña
        CREATE USER 'ev03'@'localhost' IDENTIFIED BY '1234';

        -- Asignar privilegios al usuario para la base de datos específica
        GRANT ALL PRIVILEGES ON `ev03`.* TO 'ev03'@'localhost';

        -- Aplicar los cambios de privilegios
        FLUSH PRIVILEGES;

        --
        -- Nos conectamos con el usuario recien creado.
        --

        -- Indicamos que se va a utilizar esta base de datos
        use ev03;    */
    }

    public function getConnection()
    {
        try {
            $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db, $this->port);
            mysqli_set_charset($this->connection, 'utf8');
            if (!$this->connection) {
                throw new Exception("Error en la conexión: " . mysqli_connect_error());
            }
            return $this->connection;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            die("Error al conectar a la base de datos.");
        }
    }

    public function closeConnection()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}
