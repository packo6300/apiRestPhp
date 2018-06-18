<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Db{
    private $tipo_de_base   = 'sqlsrv';
    private $host           = 'SQL01\AXR3';
    private $nombre_de_base = 'PRODR3';
    private $usuario        = 'reports';
    private $contrasena     = 'avanceytec';
    private function getConection() {
        try{
            $conexionDB= new PDO($this->tipo_de_base.':Server='.$this->host.';Database='.$this->nombre_de_base, $this->usuario, $this->contrasena);
            return $conexionDB;
        }
        catch (PDOException $e){
            return $e;
        }
    }
    public function query($sql,$params=array()) {
        try{
            $conexion= $this->getConection();
            $statement= $conexion->prepare($sql);
            $statement->execute($params);
            $result=array();
            $resultSet=$statement->fetchAll();
            foreach ($resultSet as $k => $v) {
                $cuenta=  (count($resultSet[$k])/2);
                $d=array();
                for($i=0;$i<$cuenta;$i++){
                   $d[$i]=$v[$i];                       
                }
               $result[]=$d;
            }
            return $result ;
        }
        catch (PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
}