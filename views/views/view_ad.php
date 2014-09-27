<? require_once 'head.php'; ?>
<body>
    <? require_once 'header.php'; ?>
    <div class="row" style="margin-top:36px;">
        <?
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


            <!--ad image code start-->
            <div class=" small-12 medium-12  large-8 columns  left" style="padding:0 !important;">
                <div class="slider">

                    <div class="price">
                        <span class="price_number">7000</span>
                        <span class="price_currency">جنيه مصرى</span>
                    </div>

                    <input type="radio" name="slide_switch" id="id1" checked="checked"/>

                    <label for="id1">
                        <img src="<?= TEMPLATE_URL; ?>/img/2.jpg"/>
                    </label>

                    <img src="<?= TEMPLATE_URL; ?>/img/2.jpg"/>

                    <input type="radio" name="slide_switch" id="id2"/>

                    <label for="id2">
                        <img src="<?= TEMPLATE_URL; ?>/img/2.jpg"/>
                    </label>

                    <img src="<?= TEMPLATE_URL; ?>/img/2.jpg"/>

                </div>
            </div>
            <!--ad image code end-->


            <!--ad info code start-->
            <div class=" small-12  large-4 columns  right" style="padding-right:0 !important;">

                <div class="ad_info_element">
                    <p>
                        <?= $ad[0]['desc']; ?>
                    </p>
                </div>

                <div class="ad_info_element">
                    <span>للإتصال : </span>
                    <span>01003612060</span>
                </div>

                <div class="ad_info_element">
                    <span>المكان : </span>
                    <span>مصر </span>
                    <span>,</span>
                    <span>بنى سويف </span>
                    <span>,</span>
                    <span>الحميات </span>
                </div>

                <div class="ad_info_element">
                    <span>تاريخ الاضافة : </span>
                    <span>20 يناير 2013 </span>
                </div>

            </div>
            <!--ad info code end-->


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
