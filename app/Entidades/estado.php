<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    protected $table = 'estados';
    public $timestamps = false;

    protected $fillable = [ //Campos en la tabla clientes de la BDD...
        'idestado', 'nombre',
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  nombre
                FROM estados ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idestado)
    {
        $sql = "SELECT
                nombre
                FROM estados WHERE idestado = $idestado";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idestado = $lstRetorno[0]->idestado;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

}