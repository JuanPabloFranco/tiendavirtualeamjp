<?php

class clsProducto {

    private $id;
    private $codigo_prod;
    private $nombre_prod;
    private $precio;
    private $marca;
    private $imagen;
    private $id_categoria;
    private $id_proveedor;
    private $id_admin;
    private $descripcion_prod;
    private $estado_prod;
    
    function __construct($id, $codigo_prod, $nombre_prod, $precio, $marca, $imagen, $id_categoria, $id_proveedor, $id_admin, $descripcion_prod, $estado_prod) {
        $this->id = $id;
        $this->codigo_prod = $codigo_prod;
        $this->nombre_prod = $nombre_prod;
        $this->precio = $precio;
        $this->marca = $marca;
        $this->imagen = $imagen;
        $this->id_categoria = $id_categoria;
        $this->id_proveedor = $id_proveedor;
        $this->id_admin = $id_admin;
        $this->descripcion_prod = $descripcion_prod;
        $this->estado_prod = $estado_prod;
    }
    
    function getId() {
        return $this->id;
    }

    function getCodigo_prod() {
        return $this->codigo_prod;
    }

    function getNombre_prod() {
        return $this->nombre_prod;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getMarca() {
        return $this->marca;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getId_categoria() {
        return $this->id_categoria;
    }

    function getId_proveedor() {
        return $this->id_proveedor;
    }

    function getId_admin() {
        return $this->id_admin;
    }

    function getDescripcion_prod() {
        return $this->descripcion_prod;
    }

    function getEstado_prod() {
        return $this->estado_prod;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCodigo_prod($codigo_prod) {
        $this->codigo_prod = $codigo_prod;
    }

    function setNombre_prod($nombre_prod) {
        $this->nombre_prod = $nombre_prod;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

    function setId_proveedor($id_proveedor) {
        $this->id_proveedor = $id_proveedor;
    }

    function setId_admin($id_admin) {
        $this->id_admin = $id_admin;
    }

    function setDescripcion_prod($descripcion_prod) {
        $this->descripcion_prod = $descripcion_prod;
    }

    function setEstado_prod($estado_prod) {
        $this->estado_prod = $estado_prod;
    }

}
?>