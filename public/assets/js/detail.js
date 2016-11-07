$(document).ready(function() {
    $('#userModal').on('show.bs.modal', function (event) {


        var button = $(event.relatedTarget);
        var titleTxt = button.data('title');
        var modal = $(this);
        var strArray = titleTxt.split('/');

        /*
            사람일 경우
            people/user_id
         */

        $.ajax({

            url:'../../../detail',
            type : 'post',
            data : {"param": titleTxt},

            success:function(data){

                modal.find('.modal-title').html(strArray[1]);
                modal.find('.modal-body').html(data);

                /*alert($('#star').text());*/

                if($('#star').text() == "YES"){
                    // 검은별
                    /*document.write('yes..');*/
                    $('#check').removeClass('star').addClass('glyphicon glyphicon-star');
                }

                else {
                    // 하얀별
                    /*document.write('no..');*/
                    $('#check').removeClass('star').addClass('glyphicon glyphicon-star-empty');
                }

                $('#star').hide();

            }
        })
    });
});
