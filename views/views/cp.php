<? require_once 'head.php'; ?>
<body>
    <? require_once 'header.php'; ?>

    <?= $out; ?>
    <div class="row" style="margin-top:36px;">

        <? require_once 'side_bar.php'; ?>

        <!--main content start-->
        <div class="content" style="float:right; padding:0 16px; margin:0;">


            <div class="small-12 columns" style="padding:0 !important;">

                <dl class="tabs" data-tab style=" display:inline-block; margin:16px 0 !important; ">
                    <dd class="active"><a href="#panel1">العضويات</a></dd>
                    <dd><a href="#panel2">الاعلانات</a></dd>
                </dl>

                <div class="tabs-content" style="padding:0 !important;">
                    <div id="errors" style="color:green;"></div>
                    <div class="content active" id="panel1" style="width:100% !important;">



                        <div class="small-12 columns right" style="padding:0 !important;">
                            <input type="text" placeholder="ادخل البريد او رقم العضوية" style="width:80%; float:right;">
                            <input type="submit" class="button" value="بحث" style=" height:37px; margin-top:0; width:19%; float:right;">
                        </div>

                        <div class="small-12 columns right" style="padding:0 !important;">
                            <input id="deactivate_users" type="submit" class="button" value="تعطيل" style="background:gray; margin-top:0;">
                            <input id="activate_users" type="submit" class="button" value="تفعيل" style="margin-top:0;">
                        </div>
                        <form id="users_form">
                            <table dir="rtl">
                                <thead>
                                    <tr>
                                        <th width="40"><input type="checkbox" check="users" name="all"></th>
                                        <th width="100">رقم العضوية</th>
                                        <th width="">البريد الاليكترونى</th>
                                        <th width="">الحالة</th>
                                    </tr>
                                </thead>
                                <tbody id="users_body">
                                    <?= empty($users) ? '' : Temp::users_container_rows($users); ?>
                                </tbody>
                            </table>
                        </form>                  
                        <input type="hidden" name="users_page" value="1">
                        <input type="hidden" name="users_total" value="<?= $total_users; ?>">
                        <div id="users_more">
                            <? if ($total_users > 18) { ?>
                                <input id="users_button" type="submit" value="المزيد">
                            <? } ?>
                        </div>
                    </div>


                    <div class="content" id="panel2" style="width:100% !important;">

                        <div class="small-12 columns right" style="padding:0 !important;">
                            <input type="text" placeholder="ادخل البريد او رقم العضوية" style="width:80%; float:right;">
                            <input type="submit" class="button" value="بحث" style=" height:37px; margin-top:0; width:19%; float:right;">
                        </div>

                        <div class="small-12 columns right" style="padding:0 !important;">
                            <input id="deactivate_ads" type="submit" class="button" value="تعطيل" style="background:gray; margin-top:0;">
                            <input id="activate_ads" type="submit" class="button" value="تفعيل" style="margin-top:0;">
                        </div>
                        <form id="ads_form">
                            <table dir="rtl">
                                <thead>
                                    <tr>
                                        <th width="40"><input type="checkbox" check="ads" name="all"></th>
                                        <th width="100">رقم العضوية</th>
                                        <th width="">البريد الاليكترونى</th>
                                        <th width="">الحالة</th>
                                    </tr>
                                </thead>
                                <tbody id="ads_body">

                                    <?= empty($ads) ? '' : Temp::ad_container_rows($ads); ?>
                                </tbody>
                            </table>
                        </form>
                        <input type="hidden" name="ads_page" value="1">
                        <input type="hidden" name="ads_total" value="<?= $total_ads; ?>">
                        <div id="ads_more">
                            <? if ($total_ads > 18) { ?>
                                <input id="ads_button" type="submit" value="المزيد">
                            <? } ?>
                        </div>
                    </div>

                    <div class="content" id="panel3" style="width:100% !important;">




                        <div class="small-12 columns right" style="padding:0 !important;">
                            <input type="text" placeholder="ادخل البريد او رقم العضوية" style="width:80%; float:right;">
                            <input type="submit" class="button" value="بحث" style=" height:37px; margin-top:0; width:19%; float:right;">
                        </div>

                        <div class="small-12 columns right" style="padding:0 !important;">
                            <input type="submit" class="button" value="تعطيل" style="background:gray; margin-top:0;">
                            <input type="submit" class="button" value="تفعيل" style="margin-top:0;">
                        </div>

                        <table dir="rtl">
                            <thead>
                                <tr>
                                    <th width="40"></th>
                                    <th width="100">رقم العضوية</th>
                                    <th width="">البريد الاليكترونى</th>
                                    <th width="">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>

                    <div class="content" id="panel4" style="width:100% !important;">




                        <div class="small-12 columns right" style="padding:0 !important;">
                            <input type="text" placeholder="ادخل البريد او رقم العضوية" style="width:80%; float:right;">
                            <input type="submit" class="button" value="بحث" style=" height:37px; margin-top:0; width:19%; float:right;">
                        </div>

                        <div class="small-12 columns right" style="padding:0 !important;">
                            <input type="submit" class="button" value="تعطيل" style="background:gray; margin-top:0;">
                            <input type="submit" class="button" value="تفعيل" style="margin-top:0;">
                        </div>

                        <table dir="rtl">
                            <thead>
                                <tr>
                                    <th width="40"></th>
                                    <th width="100">رقم العضوية</th>
                                    <th width="">البريد الاليكترونى</th>
                                    <th width="">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
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
