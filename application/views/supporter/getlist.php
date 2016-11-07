<section id="main-content">
    <section class="wrapper">


            <div class="col-lg-9 main-chart">

                <button class="btn btn-default" onclick="location.href='/supporter/writev'">글쓰기</button>


                    <?php
                    $last_num = 0;
                    foreach($supporter_getList as $row) {
                        $last_num = $row -> spt_num;
                        ?>
                        <table class="table table-bordered">

                            <tr align="center">
                                <td width="15%">
                                    <?php echo $row->spt_starttime ?> ~ <?php echo $row->spt_endtime ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning" onclick="location.href='/supporter/view/<?php echo $row->spt_num ?>'">자세히보기</button>
                                </td>
                                <td rowspan="4">
                                    <?php if($row->spt_status == 0 ) { ?>
                                        모집중
                                    <?php }else{?>
                                        모집완료
                                    <?php }?>
                                </td>
                            </tr>
                            <tr align="center">

                                <td rowspan="3">
                                    <img src="../../public/img/member/<?=$row->user_pfimage?>">
                                </td>
                                <td><?php echo $row->spt_writer ?></td>
                            </tr>
                            <tr align="center">
                                <td><?php echo $row->spt_number ?></td>
                            </tr>
                            <tr align="center">
                                <td><?php echo $row->spt_address ?></td>
                            </tr>
                        </table>
                        <br>
                    <?php } ?>
                    <div id="scroll">
                    </div>

                    <script type="text/javascript">
                        var last_num = <?php echo "$last_num"; ?>;

                    </script>
                    <p id="loader" style="text-align: center; display: none"><img src="../../public/assets/img/loader.gif"></p>

            </div>