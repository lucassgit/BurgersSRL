<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido_proucto extends Model
{

    protected $table = 'pedido_productos';
    public $timestamps = false;

    protected $fillable = [ //Campos en la tabla de la BDD...
        'idpedido_producto', 'fk_idpedido', 'fk_idproducto', 'cantidad', 'precio_unitario', 'total',
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  fk_idpedido
                  fk_idproducto
                  cantidad
                  precio_unitario
                  total
                FROM pedido_productos ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idpedido_producto)
    {
        $sql = "SELECT
                  fk_idpedido
                  fk_idproducto
                  cantidad
                  precio_unitario
                  total
                FROM pedido_productos WHERE idpedido_producto = $idpedido_producto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido_producto = $lstRetorno[0]->idpedido_producto;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->precio_unitario = $lstRetorno[0]->precio_unitario;
            $this->total = $lstRetorno[0]->total;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE pedido_productos SET
            fk_idpedido='$this->fk_idpedido',
            fk_idproducto='$this->fk_idproducto',
            cantidad='$this->cantidad',
            precio_unitario='$this->precio_unitario',
            total='$this->total',
            WHERE idpedido_producto=?";
        $affected = DB::update($sql, [$this->idpedido_producto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedido_productos WHERE
            idpedido_producto=?";
        $affected = DB::delete($sql, [$this->idpedido_producto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedido_productos (
                fk_idpedido,
                fk_idproducto,
                cantidad,
                precio_unitario,
                total,
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idpedido,
            $this->fk_idproducto,
            $this->cantidad,
            $this->precio_unitario,
            $this->total,
        ]);
        return $this->idpedido_producto = DB::getPdo()->lastInsertId();
    }
}