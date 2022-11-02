<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{

    protected $table = 'sistema_proveedores';
    public $timestamps = false;

    protected $fillable = [ //Campos en la tabla de la BDD...
        'idproveedor', 'nombre', 'direccion', 'telefono', 'correo',
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idproveedor
                  nombre
                  direccion
                  telefono
                  correo
                FROM sistema_proveedores ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idproveedor)
    {
        $sql = "SELECT
                  idproveedor
                  nombre
                  direccion
                  telefono
                  correo
                FROM sistema_proveedores WHERE idproveedor = $idproveedor";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproveedor = $lstRetorno[0]->idproveedor;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->correo = $lstRetorno[0]->correo;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE sistema_proveedores SET
            nombre='$this->nombre',
            direccion='$this->direccion',
            telefono='$this->telefono',
            correo='$this->correo'
            WHERE idproveedor=?";
        $affected = DB::update($sql, [$this->idproveedor]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM sistema_proveedores WHERE
            idproveedor=?";
        $affected = DB::delete($sql, [$this->idproveedor]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO sistema_proveedores (
                  nombre,
                  direccion,
                  telefono,
                  correo
            ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->direccion,
            $this->telefono,
            $this->correo,
        ]);
        return $this->idcarrito = DB::getPdo()->lastInsertId();
    }
}
