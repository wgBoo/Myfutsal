

function calendar_shot (obj){

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month, basicWeek, basicDay'
        },

        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar !!!

        events: obj,


    });
}

/*
var Script = function () {


    /!* initialize the external events
     -----------------------------------------------------------------*!/


    /!* initialize the calendar
     -----------------------------------------------------------------*!/
    console.log(schedule);

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!

        events: schedule
    });


}();*/
