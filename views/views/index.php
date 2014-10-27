<?
if (!defined('WEB'))
    exit();
?>
<? require_once 'head.php'; ?>
<body>
    <? require_once 'header.php'; ?>

    <?= $out; ?>
    <div class="row" style="margin-top:36px;">

        <? require_once 'side_bar.php'; ?>

        <!--main content start-->
        <div class="content">

            <!--Breadcrumbs start-->
            <div class="row" style="margin:0 0 16px 0;">
                <ul class="breadcrumbs">
                    <li class="current"><a href="<?= READ_ONLY; ?>">الرئيسية</a></li>
                </ul>
            </div>
            <!--Breadcrumbs end-->

            <!--<div class="row" style="margin:0 0 16px 0;">
            <div id="owl-example" class="owl-carousel">
            <div style="border:1px dashed #000; position:relative;"><img src="<?= TEMPLATE_URL; ?>/img/1.jpg"><div class="ad_title_view article"><a href=""> article article </a></div>
            </div>
            <div><img src="<?= TEMPLATE_URL; ?>/img/2.jpg"></div>
            <div><img src="<?= TEMPLATE_URL; ?>/img/1.jpg"></div>
            <div><img src="<?= TEMPLATE_URL; ?>/img/2.jpg"></div>
            <div><img src="<?= TEMPLATE_URL; ?>/img/1.jpg"></div>
            <div><img src="<?= TEMPLATE_URL; ?>/img/2.jpg"></div>
            <div><img src="<?= TEMPLATE_URL; ?>/img/1.jpg"></div>
            ...
          </div>
            </div>-->

            <!--ads grid view start-->
            <div class="row" style="margin:0 0 16px 0;">
                <ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-3 ads_view">
                    <? echo empty($ads) ? 'لا توجد اعلانات للعرض' : Temp::ad_container_list($ads, $search); ?>
                </ul>
            </div>
            <!--ads grid view start-->

            <!--paginatios start-->
            <div class="row" style="margin:0 0 16px 0; padding:0;">
                <?= empty($ads) ? '' : $pagination; ?>
            </div>
            <!--paginatios end-->

        </div>
        <!--main content end-->

        <!--ads section start-->
        <div class="ads">
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right; margin-top:0px;"></div>
            <div style="width:300px; height:600px; background:#ccc; margin:12px 0; float:right;"></div>
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right;"></div>
        </div>
        <!--ads section end-->

    </div>


    <!--footer start-->
    <div class="row" style="background:url('<?= TEMPLATE_URL; ?>/img/transblack.png');  padding:20px; color:#fff; text-align:center;">
        Copyrights reserved to Pets-services.com © 2014  
    </div>
    <!--footer end-->


</body>
</html>

