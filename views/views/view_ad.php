<?
if (!defined('WEB'))
    exit();
?>
<? require_once 'head.php'; ?>
<body>
    <? require_once 'header.php'; ?>
    <div class="row" style="margin-top:36px;">
        <?
        require_once 'side_bar.php';
        ?>  

        <!--main content start-->
        <div class="content" style="float:right; padding:0 16px; margin:0;">
            <? if ($activate) { ?>
                <div class="row">
                    <form action="" method="post">

                        <div class="small-12  meduim-3 large-3 columns">
                            <input type="hidden" name="type" value="1">
                            <input type="hidden" name="count" value="<?= $offset; ?>">
                            <input type="submit" class="button expand" value="التالى >" style="background:gray; margin-top:0;">
                        </div>
                    </form>

                    <div class="small-12  meduim-3 large-3 columns">
                        <input id="activate" type="submit" class="button expand" value="تفعيل" style="margin-top:0;">
                    </div>

                    <input type="hidden" name="id" value="<?= $ad['id']; ?>">
                    <div class="small-12  meduim-3 large-3 columns">
                        <input id="deactivate" type="submit" class="button expand" value="الغاء" style="background:red; margin-top:0;">
                    </div>
                    <form action="" method="post">

                        <div class="small-12  meduim-3 large-3 columns">
                            <input type="hidden" name="type" value="2">
                            <input type="hidden" name="count" value="<?= $offset; ?>">
                            <input type="submit" class="button expand" value="< السابق" style="background:gray; margin-top:0;">
                        </div>

                    </form>
                </div>
            <? } ?>
            <div id="errors" style="color:green;"></div>
            <!--Breadcrumbs start-->
            <div class="row" style="margin:0 0 16px 0;">
                <ul class="breadcrumbs">
                    <li><a href="<?= READ_ONLY; ?>">الرئيسية</a></li>
                    <? if (!empty($ad)) { ?>
                        <? if ($ad['pet_id'] != '351') { ?>
                            <li><?
                                $list = Lists::ads_types();
                                $cat1 = ($ad['type'] == '5') ? '' : ads::get_cat_name($ad['cat_id']);
                                $cat2 = ($ad['type'] == '5') ? ads::get_cat_name($ad['cat_id']) : '';
                                echo "$cat1 " . $list[$ad['type'] - 1]['text'] . " $cat2";
                                ?></li>
                            <li><a href="<?= READ_ONLY; ?>/?pt=<?= $ad['pet_id']; ?>&ty=<?= $ad['type']; ?>&c=<?= $ad['cat_id']; ?>"><?
                                    if ($ad['type'] != 5) {
                                        echo ads::get_pet_name($ad['pet_id']);
                                    } else {
                                        $list = Lists::ads_pets($ad['cat_id'], $ad['type']);
                                        echo $list[$ad['pet_id'] - 1]['text'];
                                    }
                                    ?></a></li>
                        <? } else { ?>
                            <li><a href="<?= READ_ONLY; ?>/?c=<?= $ad['cat_id']; ?>"><?= ads::get_cat_name($ad['cat_id']); ?></a></li>        
                        <? } ?>
                        <li class="current"><?= $ad['title']; ?></li>
                    <? } ?>

                </ul>
            </div>
            <!--Breadcrumbs end-->

            <? if (!empty($ad)) { ?>
                <!--ad image code start-->
                <input type="hidden" name="ad_id" value="<?= $ad['id']; ?>">
                <div class=" small-12 medium-12  large-7  columns left" style="padding:0 !important;">

                    <div class="price">
                        <span class="price_number"><?= $ad['price']; ?></span>
                        <span class="price_currency"><?= ads::get_currency_name($ad['currency']); ?></span>
                    </div>


                    <script>
                        $(document).ready(function () {
                            $(".ad_img_thumb").click(function () {
                                var current = $(this).attr('src');
                                $(".ad_img_preview").attr("src", current);

                                $(this).addClass("current_image");
                                $(this).siblings().removeClass("current_image");

                            })

                            /*open photo light box*/
                            $(".ad_img_preview").click(function () {
                                $(".lighbox_container.adss").show();
                                var preview = $(this).attr('src');
                                $(".lighbox_container.adss > div > img").attr("src", preview);
                            })

                            /*close light box*/
                            $(".CloseLightBox").click(function () {
                                $(this).parent().parent().hide();
                            })

                        });
                    </script>

                    <div class="lighbox_container adss">
                        <div class="lighbox  small-10 small-offset-1 meduim-10 meduim-offset-1 large-6 large-offset-3 columns">
                            <a class="CloseLightBox">X</a>
                            <img src="">
                        </div>
                    </div>

                    <img class="ad_img_preview" src="<?= TEMPLATE_URL; ?>/ads_img/<?= $ad['img'][0]; ?>">
                    <? foreach ($ad['img'] as $img) { ?>
                        <img class="ad_img_thumb" src="<?= TEMPLATE_URL; ?>/ads_img/<?= $img; ?>" style="width:18%; float:right; margin:2% 0 2% 0;">
                    <? } ?>
                </div>
                <!--ad image code end-->


                <!--ad info code start-->
                <div class=" small-12  large-5 columns  right" style="padding-right:0 !important;">
                    <? if ($edit) { ?>
                        <div class="ad_info_element">
                            <h5><a href="/ads/edit/?id=<?= $ad['id']; ?>">تعديل الاعلان</a></h5>
                        </div>
                    <? } ?>
                    <div class="ad_info_element">
                        <h5>وصف الاعلان</h5>

                        <p>
                            <?= $ad['desc']; ?>
                        </p>
                    </div>

                    <div class="ad_info_element">
                        <span>للإتصال : </span>
                        <span id="show_number"><a href="#">اظهر الرقم</a></span>
                        <span id="number"></span>
                    </div>

                    <div class="ad_info_element">
                        <span>المكان : </span>
                        <span><?= ads::get_country_name($ad['country']); ?></span>
                        <span>, </span>
                        <span><?= ads::get_city_name($ad['city']); ?></span>
                        <span>, </span>
                        <span><?= ads::get_region_name($ad['region']); ?></span>
                    </div>

                    <div class="ad_info_element">
                        <span> <?= date('Y M d', $ad['time_added']); ?> : </span>
                        <span>تاريخ الاضافة</span>

                    </div>

                </div>
                <!--ad info code end-->
            <? } else { ?>
                <div class=" small-12  large-5 columns  right" style="padding-right:0 !important;">

                    <div class="ad_info_element">
                        <h5>لا يوجد اعلان للتفعيل</h5>
                    </div>
                </div>
            <? } ?>

        </div>
        <!--main content end-->


        <!--ads section start-->
        <div class="ads" style="  float:left; display:inline-block; left:0;">
            <? require_once 'social.php'; ?>
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right;  margin-top:0px;"></div>
            <div style="width:300px; height:600px; background:#ccc; margin:12px 0; float:right;"></div>
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right;"></div>
            <div style="width:300px; height:600px; background:#ccc; margin:12px 0; float:right;"></div>
        </div>
        <!--ads section start-->



    </div>
    <? require_once 'foot.php'; ?>
</body>
</html>
