<?
if (!defined('WEB'))
    exit();
?>
<? require_once 'head.php'; ?>
<body>
    <? require_once 'header.php'; ?>

    <div class="row" style="margin-top:36px;">
        <? require_once 'side_bar.php'; ?>

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
            <form id="clinic_form">

                <!--نوع الاعلان-->
                <div class=" small-12  meduim-12  large-4 columns" style="border-left:1px solid #ccc;">

                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">معلومات التواصل</h5>
                    </div>

                    <div class="small-12 columns right">


                        <label>اسم الدكتور
                            <input type="text" name="doc_name" >
                        </label>


                        <label>رقم التليفون 1
                            <input type="text" name="phone1" >
                        </label>


                        <label>رقم التليفون 2
                            <input type="text" name="phone2" >
                        </label>


                        <label>رقم التليفون 3
                            <input type="text" name="phone3" >
                        </label>

                    </div>


                </div>


                <!--معلومات الاعلان-->
                <div class=" small-12 meduim-2  large-4 columns" style="border-left:1px solid #ccc;">

                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">معلومات العيادة</h5>
                    </div>

                    <div class="small-12 columns right">

                        <label>اسم العيادة هنا
                            <input type="text" name="name" placeholder="" />
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>معلومات العيادة هنا
                            <textarea name="desc" style="height:200px;"></textarea>
                        </label>

                    </div>

                </div>


                <!--موقع الاعلان-->
                <div class=" small-12  meduim-12 large-4 columns">

                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">موقع العيادة</h5>
                    </div>

                    <div class="small-12 columns right">

                        <label>عنوان العيادة
                            <input name="address" type="text" placeholder="" />
                        </label>

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
                    <input type="submit" class="button expand" value="<?= $button; ?>">
                </div>

                <!--ad info code end-->






            </form>
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
