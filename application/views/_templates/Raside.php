    <div id="rsidebar" class="col-lg-3 ds" style="z-index: 999">

        <!-- --------------------------------------------------------------->
        <ul id="myTab" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a data-target="#friends" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Friends</a></li>
            <li role="presentation" class=""><a data-target="#teams" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Teams</a></li>
            <li role="presentation" class=""><a data-target="#ownTeam" role="tab" id="ownTeam-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">소속팀</a></li>

        </ul>

        <!-- 즐겨찾기 유저 상세보기 -->
        <div id="myTabContent" class="tab-content">

            <div role="tabpanel" class="tab-pane fade active in" id="friends" aria-labelledby="home-tab">
                <?php foreach($favorites_User as $row){ ?>
                    <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $row -> user_id?>">
                        <div class="thumb">
                            <img class="img-circle" src="../../../public/img/member_s/<?=$row -> user_psimage?>" align="left">
                        </div>

                        <div class="details" align="center">
                            <p>
                                <?php echo $row -> user_id ?><br/>
                                <muted>Available</muted>
                            </p>
                        </div>
                    </div>

                <?php } ?>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="teams" aria-labelledby="profile-tab">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
            </div>

            <!-- 즐겨찾기 소속팀 상세보기 -->
            <div role="tabpanel" class="tab-pane fade" id="ownTeam" aria-labelledby="ownTeam-tab">
                <?php foreach($own_Team as $row){
                       if(($row->main_team_check) != 0 ){
                           echo "대표팀!";

                    ?>

                    <div class="desc" data-toggle="modal" data-target="#myModal" data-title="ownTeam/<?php echo $row -> team_name?>">
                        <div class="thumb">
                            <img class="img-circle" src="../../../public/img/team_s/<?=$row -> team_psimage?>" width="35px" height="35px" align="">
                        </div>
                        <div class="details">
                            <p>
                                <?php echo $row -> team_name ?><br/>
                                <muted>Available</muted>
                            </p>
                        </div>
                    </div>
                    <?php }else{ echo "대표팀이 없습니다."; ?>
                           <div class="desc" data-toggle="modal" data-target="#myModal" data-title="ownTeam/<?php echo $row -> team_name?>">
                               <div class="thumb">
                                   <img class="img-circle" src="../../../public/img/team_s/<?=$row -> team_psimage?>" width="35px" height="35px" align="">
                               </div>
                               <div class="details">
                                   <p>
                                       <?php echo $row -> team_name ?><br/>
                                       <muted>Available</muted>
                                   </p>
                               </div>
                           </div>
                           <?php }?>
                <?php } ?>
            </div>

        </div>
    </div>

    </section>

    <!-- --------------------------------------------------------------->
