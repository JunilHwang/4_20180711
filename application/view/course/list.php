<h2 class="content-title">추천 코스 여행</h2>
<?php if ($param->isMember) { ?>
<div class="row">
    <div class="right">
        <a href="<?php echo "{$param->get_page}/write"?>" class="btn blue waves-effect waves-light layerOpener">작성</a>
    </div>
</div>
<?php } ?>
<div class="row">
    <?php foreach ($list as $data):
            $default = json_decode($data->list);
            $shortest = json_decode($data->shortest_list);
        ?>
    <article class="course">
        <a href="<?php echo "{$param->get_page}/view/{$data->idx}"?>" class="mask layerOpener"></a>
        <div class="img_wrap<?php echo isset($data->uri) ? "" : ' none'?>" style="background-image:url(<?php echo isset($data->uri) ? $data->uri : IMG_URL."/logo.png"?>)"></div>
        <div class="info">
            <h3 class="subject"><?php echo $data->subject?></h3>
            <p class="writer">
                <i class="material-icons tiny">brush</i>
                <?php echo $data->writer_name?>
            </p>
            <p class="list">
                <?php
                    $label = implode(' <i class="material-icons">navigate_next</i> ', $default->label);
                    echo "<strong>[추천]</strong>".$label;
                ?>
                <span class="cost">
                    <i class="material-icons tiny">access_time</i>
                    <?php echo $default->total?>분 소요
                </span>
            </p>
            <p class="list">
                <?php
                    $label = implode(' <i class="material-icons">navigate_next</i> ', $shortest->label);
                    echo "<strong>[최단]</strong>".$label;
                ?>
                <span class="cost">
                    <i class="material-icons tiny">access_time</i>
                    <?php echo $shortest->total?>분 소요
                </span>
            </p>
            <p class="description"><?php echo shortContent($data->content, 200)?></p>
        </div>
    </article>
    <?php endforeach ?>
</div>
<?php if (count($list) > 0) echo $paginate; ?>
<script type="text/javascript" src="<?php echo SRC_URL?>/se2/js/HuskyEZCreator.js"></script>