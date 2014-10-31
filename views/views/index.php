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
                    <?
                    if ($settings['pet_id'] > 0 || $settings['cat_id'] > 0) {
                        echo '<li><a href="' . READ_ONLY . '">الرئيسية</a></li>';
                        if ($settings['type'] > 0) {
                            $list = Lists::ads_types();
                            $cat1 = ($settings['type'] == '5') ? '' : ads::get_cat_name($settings['cat_id']);
                            $cat2 = ($settings['type'] == '5') ? ads::get_cat_name($settings['cat_id']) : '';
                            echo "<li>$cat1 " . $list[$settings['type'] - 1]['text'] . " $cat2</li>";
                        }

                        if ($settings['pet_id'] < 351 && $settings['pet_id'] > 0) {
                            if ($settings['type'] != 5) {
                                echo '<li>' . ads::get_pet_name($settings['pet_id']) . '</li>';
                            } else {
                                $list = Lists::ads_pets($settings['cat_id'], $settings['type']);
                                echo '<li>' . $list[$settings['pet_id'] - 1]['text'] . '</li>';
                            }
                        } else if ($settings['cat_id'] > 2) {
                            echo '<li>' . ads::get_cat_name($settings['cat_id']) . '</li>';
                        }
                    } else if ($search > 0) {
                        echo '<li><a href="' . READ_ONLY . '">الرئيسية</a></li>';

                        if ($search == 2)
                            echo '<li><a href="' . READ_ONLY . '/?search_for=2">العيادات</a></li>';
                        else
                            echo '<li><a href="' . READ_ONLY . '/?search_for=1">الاعلانات</a></li>';

                        if (!empty($settings['words']))
                            echo '<li><span dir="rtl">بحث عن "' . $settings['words'] . '"</span></li>';
                    } else {
                        echo '<li class="current">الرئيسية</li>';
                    }
                    ?>
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
                    <? $msg = ($search == 2) ? 'لا توجد عيادات للعرض' : 'لا توجد اعلانات للعرض'; ?>
                    <? echo empty($ads) ? $msg : Temp::ad_container_list($ads, $search); ?>
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
            <? require_once 'social.php'; ?>
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right; margin-top:0px;"></div>
            <div style="width:300px; height:600px; background:#ccc; margin:12px 0; float:right;"></div>
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right;"></div>
        </div>
        <!--ads section end-->

    </div>

    <? require_once 'foot.php'; ?>

</body>
</html>

