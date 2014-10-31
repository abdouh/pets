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



            <!--user ptofile header start-->
            <div class="small-12 columns" style="background:#1dd4f1;">

                <div  style=" height:160px; width:160px; float:right; position:relative; top:-0.9375em; right:0; border:1px solid #999;">
                    <img src="<?= TEMPLATE_URL; ?>/users_img/<?= !empty($user_info['img']) ? $user_info['img'] : 'default_profile.jpeg'; ?>">
                </div>

                <div style="padding:26px; z-index:1000px; display:inline-block;">
                    <h5 style=" color:#fff !important;">رقم العضوية  <?= $user_info['id']; ?></h5>
                    <h5 style=" color:#fff !important;"><? if (!empty($user_info['username'])) echo $user_info['username']; ?></h5>
                    <h5 style=" color:#fff !important;"><?= $user_info['email']; ?></h5>
                    <h5 style=" color:#fff !important;"><? if ($user_info['phone']) echo $user_info['phone']; ?></h5>
                </div>

                <a href="/user/edit" class="CloseLightBox" style="color:#fff;">تعديل</a>

            </div>
            <!--user ptofile header end-->


            <div class="small-12 columns" style="padding:0 !important;">

                <dl class="tabs" data-tab style=" display:inline-block; margin:16px 0 !important; ">
                    <dd class="active"><a href="#panel1">الحالية</a></dd>
                    <dd><a href="#panel2">انتظار</a></dd>
                    <dd><a href="#panel4">المرفوضة</a></dd>
                </dl>

                <div class="tabs-content" style="padding:0 !important;">

                    <div class="content active" id="panel1" style="width:100% !important;">

                        <ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-3 ads_view" style="padding:0;">
                            <? echo empty($ads1) ? 'لا يوجد اعلانات للعرض' : Temp::ad_container_list($ads1); ?>
                        </ul>

                    </div>


                    <div class="content" id="panel2" style="width:100% !important;">

                        <ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-3 ads_view" style="padding:0;">
                            <? echo empty($ads2) ? 'لا يوجد اعلانات للعرض' : Temp::ad_container_list($ads2); ?>
                        </ul>

                    </div>

                    <div class="content" id="panel4" style="width:100% !important;">

                        <ul id="ads" class="small-block-grid-1 medium-block-grid-1 large-block-grid-3 ads_view" style="padding:0;">
                            <? echo empty($ads4) ? 'لا يوجد اعلانات للعرض' : Temp::ad_container_list($ads4); ?>
                        </ul>

                    </div>
                </div>

            </div>
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


    <script src="<?= TEMPLATE_URL; ?>/js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>

    <? require_once 'foot.php'; ?>
</body>
</html>
