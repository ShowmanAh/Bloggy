<?php
function Redirect_to($newLocation){
    header ('location:'.$newLocation);
    exit();

}
