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
        <div class="content">

            <div class="small-12  medium-6  large-6 columns">
                <img src="<?= TEMPLATE_URL; ?>/img/dog.jpg" style="width:100%;">
            </div>

            <div class="small-12  medium-6  large-6 columns" style="padding-top:66px;">
                <h4 style="color:#09c;">يسعدنا التواصل معكم</h4>

                <p>
                    نحن نؤمن بأهمية التواصل ونحرص على وجود قنوات مفتوحة للتواصل معنا طوال الوقت , اذا كان لديك اى اقتراحات او شكوى او تطويرات للموقع من فضلك لا تتردد فى الاتصال بنا 
                    <br>
                    <br>
                    <a href="mailto:info@pets-services.com">info@pets-services.com </a>
                </p>





                <h5 style="color:#09c; float:left">Pets services فريق عمل </h5>

            </div>





        </div>
        <!--main content end-->

        <!--ads section start-->
        <div class="ads">
            <? require_once 'social.php'; ?>
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right; margin-top:0px;"></div>
            <div style="width:300px; height:600px; background:#ccc; margin:12px 0; float:right;"></div>
            <div style="width:300px; height:250px; background:#ccc; margin:12px 0; float:right;"></div>
        </div>
        <!--ads section end-->

    </div>


    <? require_once 'foot.php'; ?>


</body>
</html>
