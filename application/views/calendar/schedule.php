<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-9 main-chart">
                <div class="container" >
                    <div class="span7 bottom15">

                    <!--<h3><i class="fa fa-angle-right"></i> Calendar</h3>-->
                    <!-- page start-->
                            <section class="panel">
                                <div class="panel-body">
                                    <div id="calendar" class="has-toolbar">


                                    </div>
                                </div>
                            </section>

                    </div>
                </div>
            </div>



<!-- js placed at the end of the document so the pages load faster -->
<!--<script src="../../../public/assets/js/jquery.js"></script>-->
<script src="/public/assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/public/assets/js/fullcalendar/fullcalendar.min.js"></script>
<script src="/public/assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="/public/assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/public/assets/js/jquery.scrollTo.min.js"></script>
<script src="/public/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


<!--common script for all pages-->
<!--<script src="../../../public/assets/js/common-scripts.js"></script>-->

<!--script for this page-->
<script src="/public/assets/js/calendar-conf-events.js"></script>

<script>
    //custom select box
    $(function(){
        $("select.styled").customSelect();
    });

</script>
<script> calendar_shot(<?php echo $result_schedule ?>); </script>
