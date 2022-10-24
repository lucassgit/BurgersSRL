<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table = 'categorias';
    public $timestamps = false;

    protected $fillable = [ //Campos en la tabla clientes de la BDD...
        'idcategoria', 'nombre',
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  nombre
                FROM categorias ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idcategoria)
    {
        $sql = "SELECT
                  nombre
                FROM categorias WHERE idcategoria = $idcategoria";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcategoria = $lstRetorno[0]->idcategoria;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

}