require(['jquery'], function ($) {
    "use strict";
        // Not so clean ToDO refactor 
        $("tbody tr td.value .ampmtimeformat").on('change', function () {
            var AMPM = $("tbody tr td.value .ampmtimeformat option:selected").val();
            $("tbody:last tr td.value .hour option:selected").each(
                function () {
                    if (AMPM == "12h") {
                        if (this.value > 12) {
                            var hour = parseInt(this.value) - 12;

                            $(this).val(hour);
                            $(this).find("tbody tr td.value .ampm:first option:selected").val('PM');
                        }
                        if (parseInt(this.value) == 12) {
                            $("tbody tr td.value .ampm:first option:selected").val('PM');

                        } 
                        if (parseInt(this.value) < 12) {    
                            $("tbody tr td.value .ampm:first option:selected").val('AM');

                        }

                    } else {
                        if ($("tbody tr td.value .ampm:first option:selected").val() == 'AM') {
                            if (parseInt(this.value) == 12) {
                                var hour = parseInt(this.value) - 12;
                                $(this).val(hour);
                            }
                        }
                        else{
                            if (parseInt(this.value) !== 12){
                                console.log('zzzgggggggggggggggzzzzzzzzzzz');
                                var hour = parseInt(this.value) + 12;
                                $(this).val(hour); 
                            }
                        }
                    }
                });
            // $("#save").click();
        });
});
