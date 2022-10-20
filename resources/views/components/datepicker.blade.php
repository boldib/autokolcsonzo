<form id="date" method="get" action="{{ route('cars.datefinder') }}">

    <input style="display:none;" type="datetime-local" id="date" name="date" class="date" style="width:300px; border: 0px" />

    <div class="submit-button mt-3">
        <p class="text-center">
            <button class="btn btn-primary">Search</button>
        </p>
    </div>
    </div>
    </p>

    <div class="pl-2 mr-4 col-sm"></div>
    </div>
    </div>
</form>

<?php

if (isset($_GET['date'])) {
    $dates = explode(' to ', $_GET['date']);

    if (isset($dates[1])) {
        $start = $dates[0];
        $end = $dates[1];
    } else {
        $start = $dates[0];
        $end = $start;
    }
} else {
    $start = null;
    $end = null;
}

?>

<script>
    var fp = flatpickr(".date", {
        inline: true,
        mode: "range",
        minDate: new Date().fp_incr(1),
        maxDate: new Date().fp_incr(180),
        dateFormat: "Y-m-d",
        locale: "en",
        <?php if($start != null) echo 'defaultDate: ["'.$start.'", "'.$end.'"],'?>
    })
</script>