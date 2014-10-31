<?
if (!defined('WEB'))
    exit();
?>

<!--accounts lightbox start-->
<div class="lighbox_container accounts">

    <div class="lighbox  small-10 small-offset-1 meduim-8 meduim-offset-2 large-6 large-offset-3 columns">

        <a class="CloseLightBox">X</a>

        <h3 class="text-center">مرحبا بك</h3>

        <form id="register_form" class="signup">
            <div id="register_errors" style="color:red;"></div>
            <label> اسم المستخدم
                <input type="text" name="reg_username">
            </label>

            <label> البريد الاليكترونى
                <input type="text" name="reg_email" >
            </label>

            <label> كلمة المرور
                <input type="password" name="reg_password">
            </label>

            <label> اعادة كلمة المرور
                <input type="password" name="reg_confirm_pass">
            </label>

            <input type="submit" onClick="register();
                    return false;" class="button expand" value="انشاء عضوية جديدة">

            <a href="javascript:void(0);" class="GoToLogin">لدى عضوية , تسجيل الدخول</a>


        </form>


        <form id="forgot_form" class="forgetPass">
            <p style="color:#09c;">برجاء ادخال البريد الاليكترونى وسيتم ارسال رسالة لتتمكن من استعادة كلمة المرور</p>

            <div id="forgot_errors" style="color:red;"></div>
            <label> البريد الاليكترونى
                <input type="text" name="forgot_email">
            </label>

            <input type="submit" onClick="forgot_pass();
                    return false;" class="button expand" value="استعادة كلمة المرور">

            <a href="javascript:void(0);" class="GoToLogin"> تسجيل الدخول</a>

        </form>




        <form id="login_form" class="login">
            <div id="login_errors" style="color:red;"></div>

            <label> البريد الاليكترونى
                <input type="text" name="email">
            </label>

            <label> كلمة المرور
                <input type="password" name="password">
            </label>
            <div id="captcha_display" style="display:none;float:right;">
                <a href="#" onclick="document.getElementById('captcha').src = '/index/captcha?' + Math.random();
                        return false">كود أخر</a>
                <img id="captcha" src="/index/captcha" alt="CAPTCHA Image" />
                <label style="width:100px;"> أدخل الكود
                    <input type="text" name="captcha_code" width="50" maxlength="6">
                </label>
            </div>

            <input type="submit" onClick="login();
                    return false;" class="button expand" value="تسجيل الدخول">

            <a href="javascript:void(0);" class="GoForgetPass">نسيت كلمة المرور</a>
            <br>
            <a href="javascript:void(0);" class="GoToSignup">ليس لدى عضوية , انشاء عضوية جديدة </a>

        </form>


    </div>


</div>
<!--accounts lightbox end-->

<!--search lightbox start-->
<div class="lighbox_container searching">

    <div class="lighbox  small-10 small-offset-1 meduim-8 meduim-offset-2 large-6 large-offset-3 columns">

        <a class="CloseLightBox">X</a>

        <h3 class="text-center">البحث</h3>

        <form id="search" method="get" action="/index">


            <div class="large-8 small-12 meduim-8 columns">
                <input type="text" name="words" placeholder="ادخل كلمات البحث" style="height:44px;">
            </div>

            <div class="large-4 small-12 meduim-4 columns">
                <a href="#" onClick="$('#search').submit();" class="button expand" style="margin-top:0;">بحث</a>
            </div>
            <div class="small-12 meduim-6 large-4 columns">
                <label>ابحث فى
                    <select name="search_for">
                        <option value="1">اعلانات</option>
                        <option value="2">عيادات</option>
                    </select>
                </label>

            </div>

            <div class=" small-12 columns" style="padding:0;">

                <div class="small-12 columns right">
                    <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">فلترة البحث</h5>
                </div>

                <div class="small-12 meduim-6 large-4 columns">


                    <label>الدولة
                        <select id="search_country" name="search_country">
                            <option value="">اختار الدولة</option>
                            <?= Temp::load_list_options('ads_countries'); ?>
                        </select>
                    </label>

                </div>

                <div class="small-12 meduim-6 large-4 columns">

                    <label>المدينة
                        <select id="search_city" name="search_city">
                            <option value="">اختار المدينة</option>
                        </select>
                    </label>

                </div>

                <div class="small-12 meduim-6 large-4 columns">

                    <label>المنطقة
                        <select id="search_region" name="search_region">
                            <option value="">اختار المنطقة</option>
                        </select>
                    </label>

                </div>

            </div>


        </form>


    </div>


</div>
<!--search lightbox end-->

<!--menu section start-->  
<div class="menu_section">
    <?
    if (!$no_add_ad) {
        if (Login::get_instance()->check_login() != 'valid') {
            $click = <<<HERE
<script>
            $('#add_ad').click(function(event){
                event.preventDefault();
                $(".lighbox_container.accounts").show();
                $(".login").show();
            });    
        </script>
HERE;
        } else {
            $click = '';
        }
        ?>
        <a id="add_ad" href="/ads" class="button success expand" style="padding:0; margin-top:0; line-height:38px;">إضافة إعلان جديد +</a>
        <?= $click; ?>
    <? } ?>

    <!--menu start-->
    <ul class="main_menu">

        <!--main menu trigger-->
        <li class="menu_trigger">
            <div class="icon menu"></div>
            <div class="text"> القائمة</div>
        </li>

        <li>
            <div class="icon dogs"></div>
            <div class="text"> كلاب</div>
        </li>

        <!--first level-->
        <ul class="sub_menu1">

            <li>كلاب للبيع</li>

            <!--second level-->
            <ul class="sub_menu2">

                <li>Giant Dog Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(1, 1, 1); ?>
                </ul>

                <li>Large Dog Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(1, 2, 1); ?>
                </ul>

                <li>Medium Dog Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(1, 3, 1); ?>
                </ul>

                <li>Small Dog Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(1, 4, 1); ?>
                </ul>

            </ul>



            <li>ذكور للزواج</li>

            <!--second level-->
            <ul class="sub_menu2">

                <li>Giant Dog Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(1, 1, 2); ?>
                </ul>

                <li>Large Dog Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(1, 2, 2); ?>
                </ul>

                <li>Medium Dog Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(1, 3, 2); ?>
                </ul>

                <li>Small Dog Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(1, 4, 2); ?>
                </ul>

            </ul>



            <li><a href="<?= READ_ONLY . '/?c=1&ty=4'; ?>">كلاب مفقودة</a></li>
            <li><a href="<?= READ_ONLY . '/?c=1&ty=3'; ?>">كلاب للتبنى</a></li>
            <li>مستلزمات كلاب</li>
            <ul class="sub_menu2">
                <li><a href="<?= READ_ONLY . '/?c=1&ty=5&pt=1'; ?>">اكسسورات للكلاب</a></li>
                <li><a href="<?= READ_ONLY . '/?c=1&ty=5&pt=2'; ?>">اكل للكلاب</a></li>
                <li><a href="<?= READ_ONLY . '/?c=1&ty=5&pt=3'; ?>">ادوية بيطرية للكلاب</a></li>
            </ul>
        </ul>


        <li>
            <div class="icon cats"></div>
            <div class="text"> قطط</div>
        </li>


        <!--first level-->
        <ul class="sub_menu1">

            <li>قطط للبيع</li>

            <!--second level-->
            <ul class="sub_menu2">

                <li>Giant Cat Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(2, 1, 1); ?>
                </ul>

                <li>Large Cat Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(2, 2, 1); ?>
                </ul>

                <li>Medium Cat Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(2, 3, 1); ?>
                </ul>

                <li>Small Cat Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(2, 4, 1); ?>
                </ul>

            </ul>



            <li>ذكور للزواج</li>

            <!--second level-->
            <ul class="sub_menu2">

                <li>Giant Cat Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(2, 1, 2); ?>
                </ul>

                <li>Large Cat Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(2, 2, 2); ?>
                </ul>

                <li>Medium Cat Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(2, 3, 2); ?>
                </ul>

                <li>Small Cat Breed</li>

                <!--third level-->
                <ul class="sub_menu3">
                    <?= menu::load_pets(2, 4, 2); ?>
                </ul>

            </ul>



            <li><a href="<?= READ_ONLY . '/?c=2&ty=4'; ?>">قطط مفقودة</a></li>
            <li><a href="<?= READ_ONLY . '/?c=2&ty=3'; ?>">قطط للتبنى</a></li>
            <li>مستلزمات قطط</li>
            <ul class="sub_menu2">
                <li><a href="<?= READ_ONLY . '/?c=2&ty=5&pt=1'; ?>">اكسسورات للقطط</a></li>
                <li><a href="<?= READ_ONLY . '/?c=2&ty=5&pt=2'; ?>">اكل للقطط</a></li>
                <li><a href="<?= READ_ONLY . '/?c=2&ty=5&pt=3'; ?>">ادوية بيطرية للقطط</a></li>
            </ul>
        </ul>


        <li>
            <div class="icon birds"></div>
            <div class="text">طيور زينة</div>
        </li>
        <!--first level-->
        <ul class="sub_menu1">            
            <!--second level-->
            <li><a href="<?= READ_ONLY . '/?c=3'; ?>">طيور زينة للبيع</a></li>
            <li>مستلزمات الطيور الزينة</li>
            <ul class="sub_menu2">
                <li><a href="<?= READ_ONLY . '/?c=3&ty=5&pt=1'; ?>">اكسسورات للطيور الزينة</a></li>
                <li><a href="<?= READ_ONLY . '/?c=3&ty=5&pt=2'; ?>">اكل للطيور الزينة</a></li>
                <li><a href="<?= READ_ONLY . '/?c=3&ty=5&pt=3'; ?>">ادوية بيطرية للطيور الزينة</a></li>
            </ul>
        </ul>

        <li>
            <div class="icon fish"></div>
            <div class="text">اسماك زينة</div>
        </li>
        <!--first level-->
        <ul class="sub_menu1">            
            <!--second level-->
            <li><a href="<?= READ_ONLY . '/?c=4'; ?>">أسماك زينة للبيع</a></li>
            <li>مستلزمات الأسماك الزينة</li>
            <ul class="sub_menu2">
                <li><a href="<?= READ_ONLY . '/?c=4&ty=5&pt=1'; ?>">اكسسورات لأسماك الزينة</a></li>
                <li><a href="<?= READ_ONLY . '/?c=4&ty=5&pt=2'; ?>">اكل لأسماك الزينة</a></li>
                <li><a href="<?= READ_ONLY . '/?c=4&ty=5&pt=3'; ?>">ادوية بيطرية لأسماك الزينة</a></li>
            </ul>
        </ul>

        <li>
            <div class="icon turtles"></div>
            <div class="text">زواحف</div>
        </li>
        <!--first level-->
        <ul class="sub_menu1">            
            <!--second level-->
            <li><a href="<?= READ_ONLY . '/?c=5'; ?>">زواحف للبيع</a></li>
            <li>مستلزمات زواحف</li>
            <ul class="sub_menu2">
                <li><a href="<?= READ_ONLY . '/?c=5&ty=5&pt=1'; ?>">اكسسورات للزواحف</a></li>
                <li><a href="<?= READ_ONLY . '/?c=5&ty=5&pt=2'; ?>">اكل للزواحف</a></li>
                <li><a href="<?= READ_ONLY . '/?c=5&ty=5&pt=3'; ?>">ادوية بيطرية للزواحف</a></li>
            </ul>
        </ul>

        <li>
            <div class="icon horses"></div>
            <div class="text">خيول</div>
        </li>
        <!--first level-->
        <ul class="sub_menu1">            
            <!--second level-->
            <li><a href="<?= READ_ONLY . '/?c=6'; ?>">خيول للبيع</a></li>
            <li>مستلزمات الخيول</li>
            <ul class="sub_menu2">
                <li><a href="<?= READ_ONLY . '/?c=6&ty=5&pt=1'; ?>">اكسسورات للخيول</a></li>
                <li><a href="<?= READ_ONLY . '/?c=6&ty=5&pt=2'; ?>">اكل للخيول</a></li>
                <li><a href="<?= READ_ONLY . '/?c=6&ty=5&pt=3'; ?>">ادوية بيطرية للخيول</a></li>
            </ul>
        </ul>

        <li>
            <div class="icon vet"></div>
            <div class="text"> <a href="<?= READ_ONLY . '/?search_for=2'; ?>">العيادات</a></div>
        </li>

        <li>
            <div class="icon about"></div>
            <div class="text"> <a href="<?= READ_ONLY . '/aboutus'; ?>">عن الموقع</a></div>
        </li>

        <li>
            <div class="icon contact"></div>
            <div class="text"> <a href="<?= READ_ONLY . '/contactus'; ?>">اتصل بنا</a></div>
        </li>

        <? if (Login::get_instance()->check_login() == 'valid') { ?>
            <li>
                <div class="icon account"></div>
                <div class="text"><a href="/index/logout">تسجيل خروج</a></div>
            </li>
        <? } else { ?>
            <li>
                <div id="account" class="icon account"></div>
                <div class="text"> تسجيل</div>
            </li>
        <? } ?>

        <li>
            <div class="icon search"></div>
            <div class="text">البحث</div>
        </li>



    </ul>
    <!--menu end-->

</div>
<!--menu section end--> 
