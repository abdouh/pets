<?
if (!defined('WEB'))
    exit();
?>
<? require_once 'head.php'; ?>
<body>
    <? require_once 'header.php'; ?>

    <?= $out; ?>
    <div class="row" style="margin-top:36px;">

        <? require_once 'side_bar.php'; ?>

        <!--main content start-->
        <div class="content">
            <!--Breadcrumbs start-->
            <div class="row" style="margin:0 0 16px 0;">
                <ul class="breadcrumbs">
                    <li><a href="<?= READ_ONLY; ?>">الرئيسية</a></li>
                    <li class="current">صفحة غير موجودة</li>
                </ul>
            </div>
            <!--Breadcrumbs end-->
            <img width="100px" height="100px" src="<?= TEMPLATE_URL . '/img/404.png' ?>">
            <h5>الصفحة التى تبحث عنها غير موجودة</h5>
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

