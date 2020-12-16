require(['jquery'], function ($) {
    "use strict";
    $("tbody tr td.value .ampmtimeformat").on('change', function () {
        var AMPM = $("tbody tr td.value .ampmtimeformat option:selected").val();
        $("tbody:last tr td.value .hour option:selected").each(
            function () {
                if (AMPM == "12h") {
                    parseInt(this.value, 10) >= 12 ? $(this).closest('tr').next('tr').find('.ampm option:selected').val('PM') : $(this).closest('tr').next('tr').find('.ampm option:selected').val('AM');
                    var hour = (parseInt(this.value, 10) % 12) || 12;
                    $(this).val(hour);

                } else {
                    if (($(this).closest('tr').next('tr').find('.ampm option:selected').val() == 'AM') && (parseInt(this.value, 10)) == 12) {
                        var hour = parseInt('0', 10);
                        $(this).val(hour);

                    }
                    if ($(this).closest('tr').next('tr').find('.ampm option:selected').val() == 'PM') {
                        var hour = parseInt(this.value, 10) + 12;
                        $(this).val(hour);

                    }
                }
            });
        $("#save").click();

    });
});
