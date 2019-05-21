<?php
include "views/partials/head.php";
include "views/partials/nav.php";
if(isset($_GET['page']))
{
    switch($_GET['page'])
    {
        case "pregled":
            require_once "views/pregled_polisa.php";
            break;
        default:
            require_once "views/unos_polise.php";
            break;
    }

}
else 
{
    include "views/unos_polise.php";   
}
include "views/partials/footer.php";
?>