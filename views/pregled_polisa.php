<?php
require "vendor/autoload.php";
use Models\Osiguranje;
$polise = Osiguranje::svi();

?>

<div class="container-fluid min-height">
  <div class="row">
    <div class="col-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Datum unosa</th>
            <th scope="col">Ime i Prezime</th>
            <th scope="col">Datum rodjenja</th>
            <th scope="col">Broj Pasosa</th>
            <th scope="col">Telefon</th>
            <th scope="col">Email</th>
            <th scope="col">Datum putovanja od</th>
            <th scope="col">Datum putovanja do</th>
            <th scope="col">Broj dana</th>
            <th scope="col">Tip osiguranja</th>
          </tr>
        </thead>
        <tbody>
         
          <?php foreach($polise as $polisa): ?>
          <tr>
            <th scope="row"><?= $polisa->id ?></th>
            <td><?= date("d,M,Y", $polisa->pravljenje) ?></td>
            <td><?= $polisa->ime ?></td>
            <td><?= date("d,M,Y", $polisa->datum) ?></td>
            <td><?= $polisa->pasos ?></td>
            <td><?= $polisa->telefon ?></td>
            <td><?= $polisa->email ?></td>
            <td><?= date("d,M,Y", $polisa->od) ?></td>
            <td><?= date("d,M,Y",$polisa->do) ?></td>
            <td><?= $polisa->trajanje ?></td>
            <td><?= $polisa->naziv ?><?= $polisa->tip_id==2?"<br/><a class='btn btn-primary mt-2' href='index.php?page=jedan&id=$polisa->id'>Detaljnije</a>":'' ?></td>
          </tr>
          <?php endforeach;?>
          
        </tbody>
      </table>
    </div>
  </div>
</div>