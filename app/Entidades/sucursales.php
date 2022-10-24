<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{

    protected $table = 'sucursales';
    public $timestamps = false;

    protected $fillable = [ //Campos en la tabla clientes de la BDD...
        'idsucursal', 'telefono', 'direccion', 'linkmapa',
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  telefono
                  direccion
                  linkmapa
                FROM sucursales ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idsucursal)
    {
        $sql = "SELECT
                  telefono
                  direccion
                  linkmapa
                FROM sucursales WHERE idsucursal = $idsucursal";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->linkmapa = $lstRetorno[0]->linkmapa;
            return $this;
        }
        return null;
    }

}