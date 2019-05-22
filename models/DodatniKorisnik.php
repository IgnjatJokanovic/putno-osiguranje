<?php
namespace Models;
use Models\DB;

class DodatniKorisnik
{
    public $ime_prezime;
    public $datum_rodjenja;
    public $broj_pasosa;
    public $nosilac_id;

    public function __construct($ime, $datum, $pasos, $nosilac)
    {
        $this->ime_prezime = $ime;
        $this->datum_rodjenja = $datum;
        $this->broj_pasosa = $pasos;
        $this->nosilac_id = $nosilac;
    }

    public function sacuvaj()
    {
        $con = DB::getInstance()->getConnection();
        $stmt = $con->prepare("insert into dodatni_korisnik values(null, :ime, :datum, :pasos, :nosilac_id)");
        $stmt->bindParam(":ime", $this->ime_prezime);
        $stmt->bindParam(":datum", $this->datum_rodjenja);
        $stmt->bindParam(":pasos", $this->broj_pasosa);
        $stmt->bindParam(":nosilac_id", $this->nosilac_id);
        $stmt->execute();

    }

    public static function korisnici($nosilac_id)
    {
        $con = DB::getInstance()->getConnection();
        return $con->query("select * from dodatni_korisnik where nosilac_id=$nosilac_id")->fetchAll();

    }
}
