<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Estado_pedido extends Model
{

    protected $table = 'estado_pedidos';
    public $timestamps = false;

    protected $fillable = [ //Campos en la tabla de la BDD...
        'idestado_pedido', 'fk_idpedido', 'fk_idcliente', 'fk_idestado', 'fecha',
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  fk_idpedido
                  fk_idcliente
                  fk_idestado
                  fecha
                FROM estado_pedidos ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idestado_pedido)
    {
        $sql = "SELECT
                fk_idpedido
                fk_idcliente
                fk_idestado
                fecha
              FROM estado_pedidos WHERE idestado_pedido = $idestado_pedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idestado_pedido = $lstRetorno[0]->idestado_pedido;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;
            $this->fecha = $lstRetorno[0]->fecha;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE clientes SET
            fk_idpedido='$this->fk_idpedido',
            fk_idcliente='$this->fk_idcliente',
            fk_idestado='$this->fk_idestado',
            fecha='$this->fecha'
            WHERE idestado_pedido=?";
        $affected = DB::update($sql, [$this->idestado_pedido]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM clientes WHERE
            idestado_pedido=?";
        $affected = DB::delete($sql, [$this->idestado_pedido]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO estado_pedidos (
                fk_idpedido,
                fk_idcliente,
                fk_idestado,
                fecha
            ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idpedido,
            $this->fk_idcliente,
            $this->fk_idestado,
            $this->fecha,
        ]);
        return $this->idestado_pedido = DB::getPdo()->lastInsertId();
    }
}