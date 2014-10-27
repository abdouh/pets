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

            <form id="user_form" enctype="multipart/form-data" method="post" action="/user/update">
                <div class="small-12 columns" style="padding:0 !important;">
                    <div class="small-12 meduim-6 large-6 columns" style="padding:0 !important;">
                        <div  style=" height:160px; width:160px; float:right; display:inline-block; border:1px solid #999;">
                            <img src="<?= TEMPLATE_URL; ?>/users_img/<?= !empty($user_info['img']) ? $user_info['img'] : 'default_profile.jpeg'; ?>">
                        </div>

                        <div style="float:right; padding-right:36px;">
                            <h5 style="border-bottom:1px solid #09c; padding-bottom:6px; color:#09c;">تعديل الصورة الشخصية</h5>
                            <input id="user_img" type="file" name="user_img" value="اختار صورة">
                        </div>

                    </div>
                </div>


                <div class="small-12 columns" style="padding:0 !important; margin-top:16px;">

                    <div class="small-12 meduim-6 large-6 columns" style="padding:0 !important;">
                        <div id="errors" style="color:#D20909;"></div>
                        <label>  كلمة المرور
                            <input name="old_pass" type="password"> 
                        </label>
                        <h5 style="border-bottom:1px solid #09c; padding-bottom:6px; color:#09c;">تعديل المعلومات الشخصية</h5>
                        <label> تغيير اسم المستخدم
                            <input type="text" name="username" value="<?= $user_info['username']; ?>">
                        </label>

                        <label> تغيير البريد الاليكترونى
                            <input type="text" name="email" value="<?= $user_info['email']; ?>">
                        </label>

                        <label> تغيير رقم الهاتف<small style="font-family: arial;"> (كود الدولة ثم الرقم) مثال : <b>002</b>01000000000</small>
                            <input type="text" name="phone" value="<?= empty($user_info['phone']) ? '' : '00' . $user_info['phone']; ?>">
                        </label>


                        <h5 style="border-bottom:1px solid #09c; padding-bottom:6px; color:#09c;">تعديل كلمة المرور</h5>

                        <label>  كلمة المرور الجديدة
                            <input name="new_pass" type="password"> 
                        </label>

                        <label>  اعد ادخال كلمة المرور الجديدة
                            <input name="new_pass_confirm" type="password"> 
                        </label>

                        <div class="small-12  meduim-3 large-3 columns " style="padding:0;">
                            <input onClick="window.location = '/user';return false;" type="submit" class="button expand" value="إالغاء" style="background:gray;">
                        </div>

                        <div class="small-12  meduim-3 large-3 columns" style="padding:0;">
                            <input type="submit" class="button expand" value="تعديل" >
                        </div>

                    </div>
                </div>
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


    <script src="<?= TEMPLATE_URL; ?>/js/foundation.min.js"></script>
    <script>
        $(document).foundation();    
    </script>
</body>
</html>
