<?php
namespace Models;
use Models\DB;

class Osiguranje
{
    public $ime_prezime;
    public $datum_rodjenja;
    public $pasos;
    public $telefon;
    public $email;
    public $datum_od;
    public $datum_do;
    public $broj_dana;
    public $tip;
    public $greske = array();

    public function __construct($ime, $datum, $pasos, $telefon, $email, $od, $do, $dani, $tip)
    {
        $this->ime_prezime = $ime;
        $this->datum_rodjenja = $datum;
        $this->pasos = $pasos;
        $this->telefon = $telefon;
        $this->email = $email;
        $this->datum_od = $od;
        $this->datum_do = $do;
        $this->broj_dana = $dani;
        $this->tip = $tip;
    }

    public function sacuvaj()
    {
        $con = DB::getInstance()->getConnection();
        $vreme_pravljenja = time();
        $stmt = $con->prepare("insert into polisa values(null, :ime, :datum_rodjenja, :pasos, :telefon, :email, :datum_od, :datum_do, :broj_dana, $vreme_pravljenja, :tip)");
        $stmt->bindParam(":ime", $this->ime_prezime);
        $stmt->bindParam(":datum_rodjenja", $this->datum_rodjenja);
        $stmt->bindParam(":pasos", $this->pasos);
        $stmt->bindParam(":telefon", $this->telefon);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":datum_od", $this->datum_od);
        $stmt->bindParam(":datum_do", $this->datum_do);
        $stmt->bindParam(":broj_dana", $this->broj_dana);
        $stmt->bindParam(":tip", $this->tip);
        if($stmt->execute())
        {
            return $con->lastInsertId();
        }
    }

    public static function svi()
    {
        $con = DB::getInstance()->getConnection();
        return $con->query("select p.id as id, p.ime_prezime as ime, p.datum_rodjenja as datum,
        p.broj_pasosa as pasos, p.telefon as telefon, p.email as email,
        p.datum_od as od, p.datum_do as do, p.trajanje as trajanje, 
        p.datum_pravljenja as pravljenje, 
        t.naziv as naziv, t.id as tip_id from polisa p join tip t on p.tip_id=t.id")->fetchAll();
    }

    public static function jedan($id)
    {
        $con = DB::getInstance()->getConnection();
        return $con->query("select p.id as id, p.ime_prezime as ime, p.datum_rodjenja as datum,
        p.broj_pasosa as pasos, p.telefon as telefon, p.email as email,
        p.datum_od as od, p.datum_do as do, p.trajanje as trajanje, 
        p.datum_pravljenja as pravljenje, 
        t.naziv as naziv, t.id as tip_id from polisa p join tip t on p.tip_id=t.id where p.id=$id")->fetch();


    }
}
