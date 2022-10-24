<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [ //Campos en la tabla clientes de la BDD...
        'idproducto', 'nombre', 'cantidad', 'precio', 'imagen', 'fk_idcategoria',
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  nombre
                  cantidad
                  precio
                  imagen
                  fk_idcategoria
                FROM productos ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idproducto)
    {
        $sql = "SELECT
                  nombre
                  cantidad
                  precio
                  imagen
                  fk_idcategoria
                FROM productos WHERE idproducto = $idproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->precio = $lstRetorno[0]->precio;
            $this->imagen = $lstRetorno[0]->imagen;
            $this->fk_idcategoria = $lstRetorno[0]->fk_idcategoria;
            return $this;
        }
        return null;
    }

}