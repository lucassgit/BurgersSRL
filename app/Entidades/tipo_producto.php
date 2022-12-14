<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Tipo_producto extends Model
{

    protected $table = 'tipo_productos';
    public $timestamps = false;

    protected $fillable = [ //Campos en la tabla clientes de la BDD...
        'idtipoproducto', 'nombre',
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  nombre
                FROM tipo_productos ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idtipoproducto)
    {
        $sql = "SELECT
                nombre
                FROM tipo_productos WHERE idtipoproducto = $idtipoproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idtipoproducto = $lstRetorno[0]->idtipoproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

}