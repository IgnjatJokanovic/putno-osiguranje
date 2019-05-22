<?php
require "vendor/autoload.php";
use Models\Tip;
$tipovi = Tip::svi();

?>



<div class="container min-height">
    <div id="greske">

    </div>
    <form>
    <div class="form-group">
        <label for="ime_prezime">Ime i Prezime</label>
        <input type="text" class="form-control" id="ime_prezime" placeholder="Unesite Ime i Prezime">
    </div>
    <div class="form-group">
        <label for="datum_rodjenja" class="control-label">Datum Rođenja</label>
        <input type="date" class="form-control" id="datum_rodjenja" placeholder="Datum Rodjenja">
    </div>
    <div class="form-group">
        <label for="broj_pasosa">Broj pasoša</label>
        <input type="text" class="form-control" id="broj_pasosa" placeholder="Unesite Broj Pasoša">
    </div>
    <div class="form-group">
        <label for="telefon">Telefon</label>
        <input type="text" class="form-control" id="telefon" placeholder="Unesite Telefon">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Unesite Email">
    </div>
    <div class="form-group">
        <label class="control-label">Datum Putovanja</label>
        <div class="row">
            <div class="col-6">
                <label for="od" class="control-label">OD</label>
                <input type="date" class="col-5 form-control" id="od" placeholder="Datum Rodjenja">
            </div>
            <div class="col-6">
                <label for="do" class="control-label">DO</label>
                <input type="date" class="col-5 form-control" id="do" placeholder="Datum Rodjenja">
            </div>
        </div>
        <div id="dani"></div>
    </div>
    <div class="form-group">
        <label for="tip">Izaberite Tip polise</label>
        <select class="form-control" id="tip">
            <?php foreach($tipovi as $tip):?>
            <option value="<?=$tip->id?>"><?=$tip->naziv?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group d-none" id="dodatni_korisnici">
        <label>Dodatni korisnici:</label>
        <div class="row">
            <div class="col-9">
                <div class="row" id="korisnici">
                    <div class="col-3 mt-3 dodatni-korisnik border rounded">
                        <form>
                            <div class="form-group">
                                <label for="ime_prezime">Ime i Prezime</label>
                                <input type="text" class="form-control ime" placeholder="Unesite Ime i Prezime">
                            </div>
                            <div class="form-group">
                                <label for="datum_rodjenja" class="control-label">Datum Rođenja</label>
                                <input type="date" class="form-control datum" placeholder="Datum Rodjenja">
                            </div>
                            <div class="form-group">
                                <label for="broj_pasosa">Broj pasoša</label>
                                <input type="text" class="form-control pasos" placeholder="Unesite Broj Pasoša">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3 my-auto">
                <button type="button" class="btn btn-primary btn-lg" id="btn_dodaj">
                    <span class="glyphicon glyphicon-home"></span>+
                </button>
            </div>
        </div>
    </div>
    
    <button type="submit" id="unos" class="btn btn-primary">Unesite</button>
    </form>
</div>