<?php
require "../vendor/autoload.php";
use Models\Osiguranje;
use Models\DodatniKorisnik;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include "podesavanja.php";
$status = 422;
$response = '';
header('Content-Type: application/json');
extract($_POST);
$greske = array();
if($polisa['ime'] == '')
{
    array_push($greske, "Polje Ime i prezime je obavezno");
}
if($polisa['datum_rodjenja'] == '')
{
    array_push($greske, "Polje Datum rodjenja je obavezno");
}
if($polisa['pasos'] == '')
{
    array_push($greske, "Polje Pasos je obavezno");
}
if($polisa['email'] == '')
{
    array_push($greske, "Polje Email je obavezno");
}
if($polisa['datum_od'] == '')
{
    array_push($greske, "Polje Datum od je obavezno");
}
if($polisa['datum_do'] == '')
{
    array_push($greske, "Polje Datum do je obavezno");
}
if(count($greske) == 0)
{

    $datum = $polisa['datum_rodjenja'];
    $ime = $polisa['ime'];
    $rodjenje = $polisa['datum_rodjenja'];
    $pasos = $polisa['pasos'];
    $telefon = $polisa['telefon'];
    $datum1 = strtotime($datum);
    $datum2 = $polisa['datum_od'];
    $datum3 = $polisa['datum_do'];
    $datum_od = strtotime($datum2);
    $datum_do = strtotime($datum3);
    $email = $polisa['email'];
    $dani = $polisa['broj_dana'];
    $tip = $polisa['tip_polise']==1?"Pojedično":"Grupno";
    $pdf = "<table>
    <thead>
      <tr>
        <th>Ime i Prezime</th>
        <th>Datum rodjenja</th>
        <th>Broj Pasosa</th>
        <th>Telefon</th>
        <th>Email</th>
        <th>Datum putovanja od</th>
        <th>Datum putovanja do</th>
        <th>Broj dana</th>
        <th>Tip polise</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>$ime</td>
        <td>$rodjenje</td>
        <td>$pasos</td>
        <td>$telefon</td>
        <td>$email</td>
        <td>$datum2</td>
        <td>$datum3</td>
        <td>$dani</td>
        <td>$tip</td>
      </tr>
      </tbody></table>";
    $osiguranje = new Osiguranje($ime, $datum1, $pasos,  $telefon, $email, $datum_od, $datum_do, $dani, $polisa['tip_polise']);
    $osiguranje_id = $osiguranje->sacuvaj();
    if(isset($korisnici) && $polisa['tip_polise'] == 2)
    {
        $pdf .= "<h1>Dodatni korisnici osiguranja:</h1><table><thead>
        <tr>
          <th>Ime i Prezime</th>
          <th>Datum rodjenja</th>
          <th>Broj Pasosa</th>
        </tr>
      </thead><tbody>";
        foreach($korisnici as $korisnik)
        {
            $rodjenje = $korisnik['datum_rodjenja'];
            $ime = $korisnik['ime_prezime'];
            $pasos = $korisnik['broj_pasosa'];
            $rodjenje_timestamp = strtotime($rodjenje);
            $pdf.="<tr>
            <td>$ime</td>
            <td>$rodjenje</td>
            <td>$pasos</td></tr>";
            $korisnik = new DodatniKorisnik($ime,  $rodjenje_timestamp, $pasos, $osiguranje_id);
            $korisnik->sacuvaj();
        }
        $pdf.="</tbody></table>";
    }
    
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($pdf);
    $fajl = $mpdf->Output('../tmp/file.pdf', 'F');
    $mail = new PHPMailer();
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = HOST; 
    $mail->SMTPAuth = true; 
    $mail->Username = USER_NAME;                 
    $mail->Password = PASSWORD;
    $mail->SMTPSecure = 'tls';
    $mail->Port = PORT;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->setFrom('jokanovic.ignjat@gmail.com', 'Mailer');
    $mail->addAddress($email); 
    $mail->isHTML(true);
    $mail->Subject = 'Informacije o vasoj polisi';
    $mail->Body = '<p>Postovani,</p><p>U prilogu vam saljemo pdf fajl sa informacijama o vasoj polisi</p>';
    $mail->addAttachment('../tmp/file.pdf');
    if($mail->send()){
        unlink('../tmp/file.pdf');
    }
    

    $status = 200;
    $response = 'Uspesno ste napravili polisu';
}
else {
    
    $response = $greske;
}

http_response_code($status);
echo json_encode($response);

?>