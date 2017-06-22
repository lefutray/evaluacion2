<?php

class Conexion {

   private $_user = "root";
   private $_pass = "";
   private $_nombreBase = "bibloteca";
   private $_direccion = "localhost";
   private $_conex;

   public function __construct() {
      $this->_conex = @new mysqli($this->_direccion, $this->_user, $this->_pass, $this->_nombreBase);
      $this->_conex->query("set names 'utf8'");
      if (mysqli_connect_errno()) {
         throw new RuntimeException('Error de conexión');exit;
      }
   }

   public function __destruct() {
         $this->_conex->close();
   }

   public function query($sql) {
      return $this->datosColeccion($this->_conex->query($sql));
   }

   public function execute($sql) {
      $this->_conex->query($sql);
   }

   public function datosColeccion($data) {
      $datos = array();
      while ($fila = mysqli_fetch_assoc($data)) {
         array_push($datos, $fila);
      }
      return $datos;
   }

}
?>
