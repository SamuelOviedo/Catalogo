<?php

namespace Dao\Mnt;

use Dao\Table;
use Symfony\Component\HttpFoundation\File\Stream;

class GetCatalogo extends Table
{
    public static function getAll()
    {
        $sqlstr = "Select * from productos;";
        return self::obtenerRegistros($sqlstr, array());
    }

    public static function getByDes(String $invPrdDsc)
    {
        $sqlstr = "SELECT * FROM nw202202.productos where invPrdDsc like :invPrdDsc;";
        $sqlParams = array(
            "invPrdDsc" => "%".$invPrdDsc."%"
        );
        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    public static function getByRng(int $RngMin, int $RngMax)
    {
        $sqlstr = "SELECT * FROM nw202202.productos where invPrdPrc between :invRngMin and :invRngMax;";
        $sqlParams = array(
            "invRngMin" => $RngMin,
            "invRngMax" => $RngMax
        );
        return self::obtenerRegistros($sqlstr, $sqlParams);
    }
}