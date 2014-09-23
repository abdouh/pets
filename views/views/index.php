<? require_once 'head.php'; ?>
<body>

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

                <input type="submit" onClick="register();return false;" class="button expand" value="انشاء عضوية جديدة">

                <a href="javascript:void(0);" class="GoToLogin">لدى عضوية , تسجيل الدخول</a>


            </form>


            <form id="forgot_form" class="forgetPass">
                <p style="color:#09c;">برجاء ادخال البريد الاليكترونى وسيتم ارسال رسالة لتتمكن من استعادة كلمة المرور</p>
                
                <div id="forgot_errors" style="color:red;"></div>
                <label> البريد الاليكترونى
                    <input type="text" name="forgot_email">
                </label>

                <input type="submit" onClick="forgot_pass();return false;" class="button expand" value="استعادة كلمة المرور">

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
                    <a href="#" onclick="document.getElementById('captcha').src = '/pets/index/captcha?' + Math.random(); return false">كود أخر</a>
                    <img id="captcha" src="/pets/index/captcha" alt="CAPTCHA Image" />
                    <label style="width:100px;"> أدخل الكود
                        <input type="text" name="captcha_code" width="50" maxlength="6">
                    </label>
                </div>

                <input type="submit" onClick="login();return false;" class="button expand" value="تسجيل الدخول">

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

            <form>


                <div class="large-8 small-12 meduim-8 columns">
                    <input type="text" placeholder="ادخل كلمات البحث" style="height:44px;">
                </div>

                <div class="large-4 small-12 meduim-4 columns">
                    <a href="#" class="button expand" style="margin-top:0;">بحث</a>
                </div>

                <div class=" small-12 columns" style="padding:0;">

                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">فلترة البحث</h5>
                    </div>

                    <div class="small-12 meduim-6 large-4 columns">


                        <label>الدولة
                            <select>
                                <option value="">اختار الدولة</option>
                                <option value="مصر">مصر</option>
                                <option value="لبنان">لبنان</option>
                                <option value="المفرب">المفرب</option>
                                <option value="الامارات">الامارات</option>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 meduim-6 large-4 columns">

                        <label>المحافظة
                            <select>
                                <option value="">اختار المحافظة</option>
                                <option value="بنى سويف">بنى سويف</option>
                                <option value="المنيا">المنيا</option>
                                <option value="اسيوط">اسيوط</option>
                                <option value="سوهاج">سوهاج</option>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 meduim-6 large-4 columns">

                        <label>المدينة
                            <select>
                                <option value="">اختار المدينة</option>
                                <option value="بنى سويف">بنى سويف</option>
                                <option value="المنيا">المنيا</option>
                                <option value="اسيوط">اسيوط</option>
                                <option value="سوهاج">سوهاج</option>
                            </select>
                        </label>

                    </div>

                </div>


            </form>


        </div>


    </div>
    <!--search lightbox end-->

    <!--header start-->
    <div class="row header">
        <div class="small-4 small-offset-4  medium-3 medium-offset-0  large-3 large-offset-0 columns">

            <a href="">
                <img src="<?= TEMPLATE_URL; ?>/img/logo.svg" width="150" style="margin-right:26px;"/>
            </a>


        </div>
    </div>
    <!--header end-->



    <div class="row" style="margin-top:36px;">

        <!--menu section start-->  
        <div class="menu_section">

            <a href="#" class="button success expand" style="padding:0; margin-top:0; line-height:38px;">إضافة إعلان جديد +</a>


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

                        <li>سلالات كبيرة</li>

                        <!--third level-->
                        <ul class="sub_menu3">
                            <li>نوع 01</li>
                            <li>نوع 02</li>
                            <li>نوع 03</li>
                            <li>نوع 04</li>
                            <li>نوع 05</li>
                            <li>نوع 06</li>
                            <li>نوع 07</li>
                            <li>نوع 08</li>
                            <li>نوع 09</li>
                            <li>نوع 10</li>
                        </ul>

                        <li>سلالات متوسطة</li>

                        <!--third level-->
                        <ul class="sub_menu3">
                            <li>نوع 01</li>
                            <li>نوع 02</li>
                            <li>نوع 03</li>
                            <li>نوع 04</li>
                            <li>نوع 05</li>
                            <li>نوع 06</li>
                            <li>نوع 07</li>
                            <li>نوع 08</li>
                            <li>نوع 09</li>
                            <li>نوع 10</li>
                        </ul>

                        <li>سلالات صغيرة</li>

                        <!--third level-->
                        <ul class="sub_menu3">
                            <li>نوع 01</li>
                            <li>نوع 02</li>
                            <li>نوع 03</li>
                            <li>نوع 04</li>
                            <li>نوع 05</li>
                            <li>نوع 06</li>
                            <li>نوع 07</li>
                            <li>نوع 08</li>
                            <li>نوع 09</li>
                            <li>نوع 10</li>
                        </ul>

                    </ul>



                    <li>ذكور للزواج</li>

                    <!--second level-->
                    <ul class="sub_menu2">

                        <li>سلالات كبيرة</li>

                        <!--third level-->
                        <ul class="sub_menu3">
                            <li>نوع 01</li>
                            <li>نوع 02</li>
                            <li>نوع 03</li>
                            <li>نوع 04</li>
                            <li>نوع 05</li>
                            <li>نوع 06</li>
                            <li>نوع 07</li>
                            <li>نوع 08</li>
                            <li>نوع 09</li>
                            <li>نوع 10</li>
                        </ul>

                        <li>سلالات متوسطة</li>

                        <!--third level-->
                        <ul class="sub_menu3">
                            <li>نوع 01</li>
                            <li>نوع 02</li>
                            <li>نوع 03</li>
                            <li>نوع 04</li>
                            <li>نوع 05</li>
                            <li>نوع 06</li>
                            <li>نوع 07</li>
                            <li>نوع 08</li>
                            <li>نوع 09</li>
                            <li>نوع 10</li>
                        </ul>

                        <li>سلالات صغيرة</li>

                        <!--third level-->
                        <ul class="sub_menu3">
                            <li>نوع 01</li>
                            <li>نوع 02</li>
                            <li>نوع 03</li>
                            <li>نوع 04</li>
                            <li>نوع 05</li>
                            <li>نوع 06</li>
                            <li>نوع 07</li>
                            <li>نوع 08</li>
                            <li>نوع 09</li>
                            <li>نوع 10</li>
                        </ul>

                    </ul>



                    <li><a href="">كلاب للتبنى</a></li>
                    <li><a href="">مستلزمات كلاب</a></li>


                    <li>مقالات</li>
                    <!--second level-->
                    <ul class="sub_menu2">

                        <li>تصنيف 01</li>
                        <li>تصنيف 01</li>
                        <li>تصنيف 01</li>

                    </ul>


                    <li><a href="">فيديوهات</a></li>
                    <li><a href=""> صور </a></li>

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

                        <li>سلالات كبيرة </li>
                        <!--third level-->
                        <ul class="sub_menu3">
                            <li>نوع 01</li>
                            <li>نوع 02</li>
                            <li>نوع 03</li>
                            <li>نوع 04</li>
                            <li>نوع 05</li>
                            <li>نوع 06</li>
                            <li>نوع 07</li>
                            <li>نوع 08</li>
                            <li>نوع 09</li>
                            <li>نوع 10</li>
                        </ul>


                        <li>سلالات متوسطة</li>
                        <!--third level-->
                        <ul class="sub_menu3">
                            <li>نوع 01</li>
                            <li>نوع 02</li>
                            <li>نوع 03</li>
                            <li>نوع 04</li>
                            <li>نوع 05</li>
                            <li>نوع 06</li>
                            <li>نوع 07</li>
                            <li>نوع 08</li>
                            <li>نوع 09</li>
                            <li>نوع 10</li>
                        </ul>


                        <li>سلالات صغيرة</li>
                        <!--third level-->
                        <ul class="sub_menu3">
                            <li>نوع 01</li>
                            <li>نوع 02</li>
                            <li>نوع 03</li>
                            <li>نوع 04</li>
                            <li>نوع 05</li>
                            <li>نوع 06</li>
                            <li>نوع 07</li>
                            <li>نوع 08</li>
                            <li>نوع 09</li>
                            <li>نوع 10</li>
                        </ul>


                    </ul>



                    <li>ذكور للزواج </li>

                    <!--second level-->
                    <ul class="sub_menu2">

                        <li>سلالات كبيرة
                            <!--third level-->
                            <ul class="sub_menu3">
                                <li>نوع 01</li>
                                <li>نوع 02</li>
                                <li>نوع 03</li>
                                <li>نوع 04</li>
                                <li>نوع 05</li>
                                <li>نوع 06</li>
                                <li>نوع 07</li>
                                <li>نوع 08</li>
                                <li>نوع 09</li>
                                <li>نوع 10</li>
                            </ul>
                        </li>

                        <li>سلالات متوسطة
                            <!--third level-->
                            <ul class="sub_menu3">
                                <li>نوع 01</li>
                                <li>نوع 02</li>
                                <li>نوع 03</li>
                                <li>نوع 04</li>
                                <li>نوع 05</li>
                                <li>نوع 06</li>
                                <li>نوع 07</li>
                                <li>نوع 08</li>
                                <li>نوع 09</li>
                                <li>نوع 10</li>
                            </ul>
                        </li>

                        <li>سلالات صغيرة
                            <!--third level-->
                            <ul class="sub_menu3">
                                <li>نوع 01</li>
                                <li>نوع 02</li>
                                <li>نوع 03</li>
                                <li>نوع 04</li>
                                <li>نوع 05</li>
                                <li>نوع 06</li>
                                <li>نوع 07</li>
                                <li>نوع 08</li>
                                <li>نوع 09</li>
                                <li>نوع 10</li>
                            </ul>
                        </li>

                    </ul>




                    <li><a href="">قطط للتبنى</a></li>
                    <li><a href="">مستلزمات قطط</a></li>

                    <li>مقالات</li>

                    <!--second level-->
                    <ul class="sub_menu2">

                        <li> امراض</li>
                        <!--third level-->
                        <ul class="sub_menu3">
                            <li><a href="">نوع 01</a></li>
                            <li><a href="">نوع 01</a></li>
                            <li><a href="">نوع 01</a></li>
                        </ul>

                        <li> رعاية بيطرية</li>
                        <!--third level-->
                        <ul class="sub_menu3">
                            <li><a href="">نوع 01</a></li>
                            <li><a href="">نوع 01</a></li>
                            <li><a href="">نوع 01</a></li>
                        </ul>

                        <li>عناية بالقطط</li>
                        <!--third level-->
                        <ul class="sub_menu3">
                            <li><a href="">نوع 01</a></li>
                            <li><a href="">نوع 01</a></li>
                            <li><a href="">نوع 01</a></li>
                        </ul>

                    </ul>

                    <li><a href="">فيديوهات</a></li>
                    <li><a href=""> صور </a></li>

                </ul>


                <li>
                    <div class="icon birds"></div>
                    <div class="text">طيور</div>
                </li>

                <li>
                    <div class="icon fish"></div>
                    <div class="text">اسماك</div>
                </li>

                <li>
                    <div class="icon turtles"></div>
                    <div class="text">زواحف</div>
                </li>

                <li>
                    <div class="icon horses"></div>
                    <div class="text">خيول</div>
                </li>

                <li>
                    <div class="icon vet"></div>
                    <div class="text"> <a href="">العيادات</a></div>
                </li>

                <li>
                    <div class="icon about"></div>
                    <div class="text"> <a href="">عن الموقع</a></div>
                </li>

                <li>
                    <div class="icon contact"></div>
                    <div class="text"> <a href="">اتصل بنا</a></div>
                </li>

                <? if (Login::get_instance()->check_login() != 'valid') { ?>
                    <li>
                        <div class="icon account"></div>
                        <div class="text"> تسجيل</div>
                    </li>
                <? } ?>

                <li>
                    <div class="icon search"></div>
                    <div class="text">البحث</div>
                </li>



            </ul>
            <!--menu end-->



            <!--social media start-->
            <div style="margin-bottom:16px !important; float:right;">

                <div  class="social_home" style="background: #446BC1">
                    <div class="social_media_icon_container" ><a target="_blank" id="facebook"  href="http://www.goo.gl/3dm8Vm"  ></a></div>
                    <span>1234</span>
                    <span  class="mobile_hide">معجب</span>
                </div>

                <div  class="social_home"  style="background: #EE3532">
                    <div class="social_media_icon_container" ><a target="_blank" id="google"    href="http://www.goo.gl/vE77YD"  ></a></div>
                    <span>12110</span>
                    <span  class="mobile_hide">مشترك</span>
                </div>

                <div  class="social_home"  style="background:#0FB0DB">
                    <div class="social_media_icon_container" ><a target="_blank" id="twitter"   href="http://www.goo.gl/balJMf"  ></a></div>
                    <span>12110</span>
                    <span  class="mobile_hide">متابع</span>
                </div>


                <div  class="social_home"  style="background:#DB2426">
                    <div class="social_media_icon_container" ><a target="_blank" id="youtube"   href="http://www.goo.gl/nbJpzI"  ></a></div>
                    <span>12110</span>
                    <span  class="mobile_hide">مشترك</span>
                </div>

                <div class="social_home" style="background:#6D574C;">
                    <div class="social_media_icon_container"><a target="_blank" id="instagram" href="http://www.goo.gl/SIiwfF" ></a></div>
                    <span>12110</span>
                    <span class="mobile_hide">متابع</span>
                </div>


            </div>
            <!--social media end-->

        </div>
        <!--menu section end--> 

        <!--main content start-->
        <div class="content">

            <!--Breadcrumbs start-->
            <div class="row" style="margin:0 0 16px 0;">
                <ul class="breadcrumbs">
                    <li><a href="#">كلاب للبيع</a></li>
                    <li><a href="#">سلالات كبيرة</a></li>
                    <li class="current"><a href="#">جيرمن شيبرد</a></li>
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

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                    <li><a href="">
                            <div class="ad_title_view">
                                عنوان الاعلان بيتكتب هنا
                            </div>
                            <img src="<?= TEMPLATE_URL; ?>/img/1.jpg">
                        </a></li>

                </ul>
            </div>
            <!--ads grid view start-->

            <!--paginatios start-->
            <div class="row" style="margin:0 0 16px 0; padding:0;">
                <ul class="pagination">
                    <li class="arrow unavailable"><a href="">&rsaquo;</a></li>
                    <li class="current"><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href="">5</a></li>
                    <li><a href="">6</a></li>
                    <li><a href="">7</a></li>
                    <li><a href="">8</a></li>

                    <li class="arrow"><a href="">&lsaquo;</a></li>
                </ul>
            </div>
            <!--paginatios start-->

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

