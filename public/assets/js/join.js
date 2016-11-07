/**
 * Created by 정제국 on 2016-01-19.
 */
$(document).ready(function(){
    $("#notHangul").keyup(function(event){
        if (!(event.keyCode >=37 && event.keyCode<=40)) {
            var inputVal = $(this).val();
            $(this).val(inputVal.replace(/[^a-z0-9]/gi,''));
        }
    });
});