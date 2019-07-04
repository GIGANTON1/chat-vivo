<?php
require_once 'vendor/autoload.php';

use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{
    public $conexiones = [];

    function onOpen(\Ratchet\ConnectionInterface $conn)
    {
        echo 'Hay una nueva conexion';
        foreach ($this->conexiones as $conexion){
            /** @var \Ratchet\ConnectionInterface*/
            $conexion->send("Se ha conectado un nuevo usuario");
            //10.17.0.43:4000
    }
        $this->conexiones[] = $conn;
    }

    function onClose(\Ratchet\ConnectionInterface $conn)
    {
        echo 'Bye';
    }

    function onError(\Ratchet\ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
    }

    function onMessage(\Ratchet\ConnectionInterface $from, $msg)
    {
        foreach ($this->conexiones as $conexion){
            if ($conexion !== $from){
                $conexion->send($msg);
            }
        }
    }
}