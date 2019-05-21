<div class="container min-height">
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
    </div>
    <div class="form-group">
        <label for="tip">Izaberite Tip polise</label>
        <select class="form-control" id="tip">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Unesi</button>
    </form>
</div>