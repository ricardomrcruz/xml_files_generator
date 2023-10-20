<?php 

// this function calculates date interval between the input date and current date in year
//cette function retourne la difference date entre un date especifique et la date actuel

// //a implemente dans un classe calculatrice plus tard si besoin

function calculateDateInterval($dateTime) {
    
    $dateInt = new DateTime($dateTime);
    $currentDate = new DateTime();

    $dateInBetween = $dateInt->diff($currentDate);

    return $dateInBetween->y;

    // y pour retourne en années de difference
}



