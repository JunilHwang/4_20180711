<h2 class="content-title">추천 코스 여행</h2>
<?php if ($param->isMember) { ?>
<div class="row">
    <div class="right">
        <a href="<?php echo "{$param->get_page}/write"?>" class="btn blue waves-effect waves-light layerOpener">작성</a>
    </div>
</div>
<?php } ?>
<div class="row">
    <?php for ($i=0;$i<8;$i++): ?>
    <article class="course">
        <a href="<?php echo "{$param->get_page}/view/1"?>" class="mask layerOpener"></a>
        <div class="img_wrap" style="background-image:url(<?php echo IMG_URL?>/1.jpg)"></div>
        <div class="info">
            <h3 class="subject">Lorem ipsum</h3>
            <ul>
                <li class="writer">
                    <i class="material-icons tiny">brush</i>
                    writer
                </li>
                <li class="date">
                    <i class="material-icons tiny">access_time</i>
                    기본 200분 소요
                </li>
                <li class="date">
                    <i class="material-icons tiny">access_time</i>
                    최단 거리 이동 시 150분 소요
                </li>
            </ul>
            <p class="list">
                Lorem <i class="material-icons">navigate_next</i>
                ipsum <i class="material-icons">navigate_next</i>
                dolor <i class="material-icons">navigate_next</i>
                sit <i class="material-icons">navigate_next</i>
                amet <i class="material-icons">navigate_next</i>
                consectetur <i class="material-icons">navigate_next</i>
                adipisicing <i class="material-icons">navigate_next</i>
                elit <i class="material-icons">navigate_next</i>
                Ab <i class="material-icons">navigate_next</i>
                delectus
            </p>
            <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio illum perspiciatis debitis nostrum sit in similique deleniti sapiente recusandae, iusto, nobis, consectetur repudiandae possimus quod dignissimos! Ad praesentium ipsum quae magni placeat quo, commodi eum cumque eveniet itaque illo enim odio deserunt, provident, iste maxime sapiente sunt tempore? Molestias minus fugit voluptatibus possimus. Dolores ea, porro sapiente temporibus quibusdam doloribus... [더보기]</p>
        </div>
    </article>
    <?php endfor ?>
</div>
<ul class="pagination center">
    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
    <li class="active"><a href="#!">1</a></li>
    <li class="waves-effect"><a href="#!">2</a></li>
    <li class="waves-effect"><a href="#!">3</a></li>
    <li class="waves-effect"><a href="#!">4</a></li>
    <li class="waves-effect"><a href="#!">5</a></li>
    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
</ul>
<script type="text/javascript" src="<?php echo SRC_URL?>/se2/js/HuskyEZCreator.js"></script>