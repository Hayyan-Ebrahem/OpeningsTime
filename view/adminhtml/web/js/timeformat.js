require(['jquery'], function ($) {
    "use strict";
    $("tbody tr td.value .ampmtimeformat").on('change', function () {
        var AMPM = $("tbody tr td.value .ampmtimeformat option:selected").val();

        $("tbody:last tr td.value .hour option:selected").each(
            function () {
                if (AMPM == "12h") {
                    parseInt(this.value, 10) >= 12 ? $("td.value .ampm option:selected").val('PM') : $("td.value .ampm option:selected").val('AM');
                    var hour = (parseInt(this.value, 10) % 12) || 12;
                    $(this).val(hour);

                } else {

                    if (($("td.value .ampm option:selected").val() == 'AM') && (parseInt(this.value, 10)) == 12) {
                        var hour = parseInt('0', 10);
                        console.log($("td.value .ampm option:selected").val());
                        $(this).val(hour);

                    }
        
                    if ($("td.value .ampm option:selected").val() == 'PM' && parseInt(this.value, 10) !== 12) {
                        console.log('dddddddddddd');
                        var hour = parseInt(this.value, 10) + 12;
                        $(this).val(hour);

                    }
                }
            });
        $("#save").click();

    });
});
