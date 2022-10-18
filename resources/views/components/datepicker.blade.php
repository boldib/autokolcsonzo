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

<script>
    var fp = flatpickr(".date", {
        inline: true,
        mode: "range",
        minDate: new Date().fp_incr(1),
        maxDate: new Date().fp_incr(180),
        dateFormat: "Y-m-d",
        locale: "en",
    })
</script>