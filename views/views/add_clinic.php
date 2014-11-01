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
                    <li><a href="<?= READ_ONLY; ?>">الرئيسية</a></li>
                    <li><a href="<?= READ_ONLY; ?>/?search_for=2">العيادات</a></li>
                    <li class="current">اضافة عيادة</li>
                </ul>
            </div>
            <!--Breadcrumbs end-->



            <!--ad info code start-->
            <form id="clinic_data" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= isset($clinic['id']) ? $clinic['id'] : 'null'; ?>">
                <!--نوع الاعلان-->
                <div class=" small-12  meduim-12  large-4 columns" style="border-left:1px solid #ccc;">
                    <div id="rt_errors" style="color:#D20909;"></div>
                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">معلومات التواصل</h5>
                    </div>

                    <div class="small-12 columns right">


                        <label>اسم الدكتور
                            <input type="text" name="doc_name" value="<?= $clinic['doc_name']; ?>">
                        </label>


                        <label>رقم التليفون 1
                            <input type="text" name="phone1"value="<?= $clinic['phone1'] ? $clinic['phone1'] : ''; ?>" >
                        </label>


                        <label>رقم التليفون 2
                            <input type="text" name="phone2"value="<?= $clinic['phone2'] ? $clinic['phone2'] : ''; ?>" >
                        </label>


                        <label>رقم التليفون 3
                            <input type="text" name="phone3" value="<?= $clinic['phone3'] ? $clinic['phone3'] : ''; ?>" >
                        </label>

                    </div>


                </div>


                <!--معلومات الاعلان-->
                <div class=" small-12 meduim-2  large-4 columns" style="border-left:1px solid #ccc;">
                    <div id="md_errors" style="color:#D20909;"></div>
                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">معلومات العيادة</h5>
                    </div>

                    <div class="small-12 columns right">

                        <label>اسم العيادة هنا
                            <input type="text" name="name" value="<?= $clinic['name']; ?>" placeholder="" />
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>مواعيد عمل العيادة
                            <textarea dir="rtl" name="desc" style="height:200px;"><?= $clinic['desc']; ?></textarea>
                        </label>

                    </div>
                    <div class="right">
                        <label>شعار العيادة
                            <input id="user_img" type="file" name="clinic_img" value="اختار صورة">
                        </label>
                    </div>

                </div>


                <!--موقع الاعلان-->
                <div class=" small-12  meduim-12 large-4 columns">
                    <div id="lt_errors" style="color:#D20909;"></div>
                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">موقع العيادة</h5>
                    </div>

                    <div class="small-12 columns right">

                        <label>عنوان العيادة
                            <input name="address" value="<?= $clinic['address']; ?>" type="text" placeholder="" />
                        </label>

                        <label>الدولة
                            <select id="country" name="country">
                                <option value="">اختار الدولة</option>
                                <?= Temp::load_list_options('ads_countries', $clinic['country']); ?>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>المدينة
                            <select id="city" name="city">
                                <option value="">اختار المدينة</option>
                                <?
                                if (is_array($clinic) && !empty($clinic))
                                    echo Temp::load_list_options('ads_cities', $clinic['city'], array($clinic['country']));
                                ?>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>المنطقة
                            <select id="region" name="region">
                                <option value="">اختار المنطقة</option>
                                <?
                                if (is_array($clinic) && !empty($clinic))
                                    echo Temp::load_list_options('ads_regions', $clinic['region'], array($clinic['city']));
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
