import { Korisnik } from "./korisnik.js";

$(document).ready(function() {
  $("#unos").on("click", function(e) {
    e.preventDefault();
    var ime_prezime = $("#ime_prezime").val();
    var datum_rodjenja = $("#datum_rodjenja").val();
    var pasos = $("#broj_pasosa").val();
    var telefon = $("#telefon").val();
    var email = $("#email").val();
    var datum_od = $("#od").val();
    var datum_do = $("#do").val();
    var tip_polise = $("#tip").val();
    var dodatni_korisnici = Array();
    var greske = Array();
    if (tip_polise != 1) {
      $(".dodatni-korisnik").each(function() {
        var ime = $(this)
          .find(".ime")
          .val();
        var datum = $(this)
          .find(".datum")
          .val();
        var pasos = $(this)
          .find(".pasos")
          .val();
        var korisnik = new Korisnik(ime, datum, pasos);
        dodatni_korisnici.push(korisnik);
      });
    }
    if (ime_prezime == "") {
      greske.push("Polje Ime i prezime je obavezno");
    }
    if (datum_rodjenja == "") {
      greske.push("Polje datum rodjenja je obavezno");
    }
    if (pasos == "") {
      greske.push("Polje pasos je obavezno");
    }
    if (email == "") {
      greske.push("Polje email je obavezno");
    }
    if (datum_od == "") {
      greske.push("Polje datum od je obavezno");
    }
    if (datum_do == "") {
      greske.push("Polje datum do je obavezno");
    }
    if (greske.length == 0) {
      var polisa = {
        ime: ime_prezime,
        datum_rodjenja: datum_rodjenja,
        pasos: pasos,
        telefon: telefon,
        email: email,
        datum_od: datum_od,
        datum_do: datum_do,
        tip_polise: tip_polise,
        broj_dana: window.broj_dana
      };
      $.ajax({
        type: "POST",
        url: "http://localhost/putno-osiguranje/php/unos.php",
        data: { korisnici: dodatni_korisnici, polisa: polisa },
        success: function(response) {
          var txt = `<div class="alert alert-success text-center">${response}</div>`;
          $("#greske").html(txt);
          $("html, body").animate(
            {
              scrollTop: $("#greske")
            },
            1000
          );
        },
        error: function(response) {
          var greske_response = response.responseJSON;
          var text = "";
          $.each(greske_response, function(key, value) {
            text += `<div class="alert alert-danger text-center">${value}</div>`;
          });
          $("#greske").html(response.responseText);
          $("html, body").animate(
            {
              scrollTop: $("#greske")
            },
            1000
          );
        }
      });
    } else {
      var tekst = "";
      $.each(greske, function(key, value) {
        tekst += `<div class="alert alert-danger text-center">${value}</div>`;
      });
      $("#greske").html(tekst);
      $("html, body").animate(
        {
          scrollTop: $("#greske")
        },
        1000
      );
    }
  });

  $("#od").on("change", function() {
    if ($("#do").val() != "" && $(this).val() != "") {
      var dan = 24 * 60 * 60 * 1000;
      var prvi = new Date($(this).val());
      var drugi = new Date($("#do").val());
      window.broj_dana = Math.floor((prvi.getTime() - drugi.getTime()) / dan);
      $("#dani").html(`<div class="alert alert-primary mt-2 text-center">
        Trajanje: ${
          window.broj_dana <= 0 ? "Lose ste uneli podatke" : window.broj_dana
        } dana
    </div>`);
    }
  });

  $("#do").on("change", function() {
    if ($("#od").val() != "" && $(this).val() != "") {
      var dan = 24 * 60 * 60 * 1000;
      var prvi = new Date($(this).val());
      var drugi = new Date($("#od").val());
      window.broj_dana = Math.floor((prvi.getTime() - drugi.getTime()) / dan);
      $("#dani").html(`<div class="alert alert-primary mt-2 text-center">
        Trajanje: ${
          window.broj_dana <= 0 ? "Lose ste uneli podatke" : window.broj_dana
        } dana
    </div>`);
    }
  });

  $("#tip").on("change", function() {
    var tip = $(this).val();
    if (tip == 2) {
      $("#dodatni_korisnici").removeClass("d-none");
    } else {
      $("#dodatni_korisnici").addClass("d-none");
    }
  });

  $("#btn_dodaj").on("click", function() {
    $(
      "#korisnici"
    ).append(`<div class="col-3 dodatni-korisnik mt-3 border rounded">
    <form>
        <div class="form-group">
            <label for="ime_prezime">Ime i Prezime</label>
            <input type="text" class="form-control ime" id="ime_prezime" placeholder="Unesite Ime i Prezime">
        </div>
        <div class="form-group">
            <label for="datum_rodjenja" class="control-label">Datum Rođenja</label>
            <input type="date" class="form-control datum" id="datum_rodjenja" placeholder="Datum Rodjenja">
        </div>
        <div class="form-group">
            <label for="broj_pasosa">Broj pasoša</label>
            <input type="text" class="form-control pasos" id="broj_pasosa" placeholder="Unesite Broj Pasoša">
        </div>
    </form>
</div>`);
  });
});
