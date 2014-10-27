<?
if (!defined('WEB'))
    exit();
?>
<? require_once 'head.php'; ?>
<body>
    <? require_once 'header.php'; ?>

    <div class="row" style="margin-top:36px;">
        <?
        $no_add_ad = true;
        require_once 'side_bar.php';
        ?>
        <!--main content start-->
        <div class="content" style="float:right; padding:0 16px; margin:0;">

            <!--Breadcrumbs start-->
            <div class="row" style="margin:0 0 16px 0;">
                <ul class="breadcrumbs">
                    <li><a href="#">كلاب للبيع</a></li>
                    <li><a href="#">سلالات كبيرة</a></li>
                    <li class="current"><a href="#">جيرمن شيبرد</a></li>
                </ul>
            </div>
            <!--Breadcrumbs end-->



            <!--ad info code start-->
            <form id="ad_data">
                <input type="hidden" name="id" value="<?= isset($ad['id']) ? $ad['id'] : 'null'; ?>">
                <!--نوع الاعلان-->
                <div class=" small-12  meduim-12  large-4 columns" style="border-left:1px solid #ccc;">
                    <div id="rt_errors" style="color:#D20909;">
                    </div>
                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">نوع الاعلان</h5>
                    </div>

                    <div class="small-12 columns right">
                        <label>نوع الحيوان الاليف
                            <select name="cat" id="category">
                                <option value="">اختار النوع</option>
                                <?= Temp::load_list_options('ads_cats', $ad['cat_id']); ?>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>نوع الاعلان
                            <select id="ad_type" name="type">
                                <option value="">اختار النوع</option>
                                <?= Temp::load_list_options('ads_types', $ad['type']); ?>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>تفاصيل
                            <select id="pet" name="pet">
                                <option value="351">الكل</option>
                                <?
                                if (is_array($ad) && !empty($ad))
                                    echo Temp::load_list_options('ads_pets', $ad['pet_id'], array($ad['cat_id'], $ad['type']));
                                ?>
                            </select>
                        </label>

                    </div>

                </div>


                <!--معلومات الاعلان-->
                <div class=" small-12 meduim-2  large-4 columns" style="border-left:1px solid #ccc;">
                    <div id="md_errors" style="color:#D20909;">
                    </div>
                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">معلومات الاعلان</h5>
                    </div>

                    <div class="small-12 columns right">

                        <label>اسم الاعلان هنا
                            <input type="text" name="title" value="<?= $ad['title']; ?>" placeholder="" />
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>معلومات الاعلان هنا
                            <textarea name="desc" style="height:120px;"><?= $ad['desc']; ?></textarea>
                        </label>

                    </div>

                </div>


                <!--موقع الاعلان-->
                <div class=" small-12  meduim-12 large-4 columns">
                    <div id="lt_errors" style="color:#D20909;">
                    </div>
                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">موقع الاعلان</h5>
                    </div>

                    <div class="small-12 columns right">


                        <label>الدولة
                            <select id="country" name="country">
                                <option value="">اختار الدولة</option>
                                <?= Temp::load_list_options('ads_countries', $ad['country']); ?>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>المدينة
                            <select id="city" name="city">
                                <option value="">اختار المدينة</option>
                                <?
                                if (is_array($ad) && !empty($ad))
                                    echo Temp::load_list_options('ads_cities', $ad['city'], array($ad['country']));
                                ?>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>المنطقة
                            <select id="region" name="region">
                                <option value="">اختار المنطقة</option>
                                <?
                                if (is_array($ad) && !empty($ad))
                                    echo Temp::load_list_options('ads_regions', $ad['region'], array($ad['city']));
                                ?>
                            </select>
                        </label>

                    </div>

                </div>
                <div class="small-12  meduim-3 large-3 columns right">
                    <input type="submit" class="button expand" value="<?= $button; ?>" >
                </div>

                <!--ad info code end-->



            </form>
            <!--ad image code start-->
            <div class=" small-12 medium-12  large-12 columns" style=" margin-top:26px;">

                <div id="dropbox">
                    <form action="/ads/file_upload"  class="dropzone"></form>
                </div>

            </div>
            <!--ad image code end-->
        </div>
        <!--main content end-->

        <!--ads section start-->
        <div class="ads" style="  float:left; display:inline-block; left:0;">
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right;  margin-top:0px;"></div>
            <div style="width:300px; height:600px; background:#ccc; margin:12px 0; float:right;"></div>
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right;"></div>
            <div style="width:300px; height:600px; background:#ccc; margin:12px 0; float:right;"></div>
        </div>
        <!--ads section start-->



    </div>
</body>
</html>

