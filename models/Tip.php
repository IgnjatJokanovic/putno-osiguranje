<?php
namespace Models;
use Models\DB;

class Tip
{
    public static function svi()
    {
        $con = DB::getInstance()->getConnection();
        return $con->query("select * from tip")->fetchAll();
    }
}