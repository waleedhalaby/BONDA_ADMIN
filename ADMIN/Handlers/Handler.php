<?php
function GetDateFormat($timestamp){
    $time = explode(' ', $timestamp);

    $today = new DateTime(); // This object represents current date/time
    $today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison
    $match_date = DateTime::createFromFormat( "d-m-y h:i A", $timestamp );
    $match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

    $diff = $today->diff( $match_date );
    $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval
    switch( $diffDays ) {
        case 0:
            return $time[1].' '.$time[2];
            break;
        case -1:
            return "Yesterday ".$time[1].' '.$time[2];
            break;
        case -2:
            return "2 days ago";
            break;
        case -3:
            return "3 days ago";
            break;
        case -4:
            return "4 days ago";
            break;
        case -5:
            return "5 days ago";
            break;
        case -6:
            return "6 days ago";
            break;
        case -7:
        case -8:
        case -9:
        case -10:
        case -11:
        case -12:
        case -13:
        case -14:
            return "1 week ago";
            break;
        case -15:
        case -16:
        case -17:
        case -18:
        case -19:
        case -20:
        case -21:
        case -22:
            return "2 weeks ago";
            break;
        case -23:
        case -24:
        case -25:
        case -26:
        case -27:
        case -28:
        case -29:
        case -30:
            return "3 weeks ago";
            break;
        case -31:
        case -32:
        case -33:
        case -34:
        case -35:
        case -36:
        case -37:
        case -38:
            return "1 month ago";
            break;
        default:
            return $time[0];
    }
}
?>