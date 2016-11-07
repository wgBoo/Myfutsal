


$(document).ready(function() {
    $('#schedule').click(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $.ajax({

            url: '/calendar',

            dataType:"JSON",
            success:function(data){
                alert('2');
                createCalendarDateResult(data);     // 새로고침
            }
        });
    });
});



function createCalendarDateResult(resp){  //제이슨으로 캘린더 이벤트 등록형식에 맞게 뿌리기

    var result = resp;

    alert('3');

    var eventData = [];
    if(result){

        var date = result;


        for(var i = 0; i < date.length; i++)
        {
            eventData.push({
                title : date[i].title,
                start : date[i].start,
                end : date[i].end
            });
        }

    }

    calendarEvent( eventData );        //캘린더 메소드 호출
}


function calendarEvent( eventData  )
{


    console.log(eventData);

    /*
     *   var location = $('#please').text();
     *   alert(location);
     */

    start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
    end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");


    $('.row').fullCalendar({

        header: {               // 캘린더 헤더목록
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },

        editable: false,
        eventLimit: false,      //드레그로 날짜변경 가능여부

        events : eventData
    });



        /*var calendar = $('#calendar').fullCalendar({

            height: 900,            //달력크기 조정
            header: {          //캘린더 헤더목록
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },


        eventClick : function(calEvent,jsEvent,view){  //달력 이벤트 클릭 - 이 소스에서는 false
            return false;
        },
        selectable: true,      // 사용자가 클릭 및 드래그하여 선택을 할 수 있도록
        selectHelper: false,    // 사용자가 드래그되는 동안 자리 이벤트를 그릴것인 여부를 지정할수있음
        select: function(start, end, allDay) {
            location.href = "../board/schedule.jsp";  //일정,프로젝트를 입력하는 페이지로 이동.
            if (title) {
                calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: start,
                        end: end,
                    },
                    true // make the event "stick"
                );
            }
            calendar.fullCalendar('unselect'); //선택취소 메소드
        },
        editable: false,
        eventLimit: true,      //드레그로 날짜변경 가능여부

        events : eventData
    });*/
}

