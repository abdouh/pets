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

            <div class="small-12  medium-8 medium-offset-2  large-8 large-offset-2 columns">
                <img src="<?= TEMPLATE_URL; ?>/img/00.png" style="width:100%;">
            </div>


            <div class="small-12 columns">


                <h5 style="color:#09c;">اهلا بيكم فى بيتس سيرفيسس</h5>
                <p>
                    بيتس سيرفيس هو موقع خدمى لمحبى ومربى الحيوانات الاليفة يقدم خدمات مثل الاعلان المجانى عن الحيوانات الاليفة 
                    ( بيع - شراء - تبنى - ذكور للزواج - حيوانات مفقودة ) 
                    كما يقدم مواد تعليمية عن طريق مقالات وصور وفيديوهات حتى نستمتع بتربية حيواتنا الاليفة بطريقة صحيحة بالإضافة الى دليل شامل للعيادات والمستشفيات البيطرية واماكن بيع مستلزمات الحيوانات الاليفة </p>


                <p>هدفنا هو مساعدة وتثقيف مربى ومحبى الحيوانات الاليفة بمختلف انواعها وإثراء ثقافة اقتناء الحيوانات الاليفة فى الوطن العربى ونتمنى ان نقوم برسالتنا على اكمل وجه بمساعدتكم ودعمكم</p>


                <h5 style="color:#09c;  float:left">Pets services فريق عمل </h5>

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
