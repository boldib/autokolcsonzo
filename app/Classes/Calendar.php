<?php 
namespace App\Classes;

use DateTime;
use DateInterval;

class Calendar 
{
    public static function calendarJS($car){

        if(isset($_GET['date'])){
            $dates = explode(' to ', $_GET['date']);

            if(isset($dates[1])){
                $start = $dates[0];
                $end = $dates[1];
            } else{
                $start = $dates[0];
                $end = $start;
            }

        } else{
            $start = null;
            $end = null;
        }

        
            echo '<script> 
            
            function action'.$car->id.'() {
                document.getElementById("car").value = "'.$car->id.'";
                }
                
                var fp'.$car->id.' = flatpickr(".date'.$car->id.'", {
                    inline: true,
                    mode: "range",
                    minDate: new Date().fp_incr(1),
                    maxDate: new Date().fp_incr(180),
                    dateFormat: "Y-m-d",
                    defaultDate: ["'.$start.'", "'.$end.'"],
                    disable: [';
                foreach($car->rental as $r){           
                    echo '{
                        from: "'. $r->date_start .'",
                        to: "'. $r->date_end .'",
                    },';
                }
                echo '],
                    locale: "en",
        
                })
        </script>';
    }
}