define(['jquery'], function ($) {
    "use strict";
    $(document).ready(function () {	

        $("tbody tr td.value .ampm").on('change', function() {
            var AMPM = $("tbody tr td.value .ampm option:selected").val();
            $("tbody:last tr td.value .hour option:selected").each(	
                function(){	
                    if (AMPM == "12h"){
                        if(this.value >= 12){
                            console.log('sssssssssssss');

                            var hour = this.value -12;
                            $('option[value="' + hour + '"]').attr("selected", "selected");
                        } 
                    }
                    else {
                  
                    }
                });  
                $("#save").click();
    });
})
});
