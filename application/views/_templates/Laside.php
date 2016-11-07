    <aside>
        <div id="sidebar"  class="nav-collapse">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <p class="centered">

                    <div class="thumb" align="center">
                        <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?=$timeline_user?>">
                            <img src="../../../public/img/member/<?=$leftImg[0]->user_pfimage?>?" class="img-circle" width="150">
                        </div>
                    </div>

                </p>
                <h5 id="user_id" class="centered"><?=$leftImg[0]->user_id?></h5>
                <br><br><br>


                <li class="sub-menu">
                    <a href="/supporter" >
                        <i class="fa fa-desktop"></i>
                        <span>용병</span>
                    </a>

                </li>

                <li class="sub-menu">
                    <a href="/match" >
                        <i class="fa fa-cogs"></i>
                        <span>매치</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="/recruit" >
                        <i class="fa fa-book"></i>
                        <span>모집</span>
                    </a>
                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->