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


            <!--ad info code start-->
            <div class=" small-12  large-5 columns" style="padding-right:0 !important;">


                <div class=" small-6 small-centered columns" style="padding-right:0 !important; ">
                    <img src="img/c6228b6d7ad8104f.png" style="width:100%; border:1px solid #09c;">
                </div>

                <div class="ad_info_element" style="border-top:1px solid #ccc; margin-top:16px;">
                    <h5>اسم العيادة</h5>

                    <p>
                        لوريم إيبسوم هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف
                    </p>
                </div>


                <div class="ad_info_element" >
                    <span>01003612060</span>
                    <span>/</span>
                    <span>01003612060</span>
                    <span>/</span>
                    <span>01003612060</span>
                </div>


                <div class="ad_info_element" >
                    <span>دكتور</span>
                    <span>/</span>
                    <span>بيتر سامى</span>
                </div>



                <div class="ad_info_element">
                    <span>المكان : </span>
                    <span>مصر </span>
                    <span>,</span>
                    <span>بنى سويف </span>
                    <span>,</span>
                    <span>الحميات </span>
                </div>


            </div>
            <!--ad info code end-->


            <script type="text/javascript">
                $(document).ready(function () {
                    initialize();
                });
                var geocoder;
                var map;
                var address = "عبدالسلام عارف , بنى سويف<?= $clinic['address']; ?>, <?= $clinic['city']; ?>, <?= $clinic['country']; ?>";
                    function initialize() {
                        geocoder = new google.maps.Geocoder();
                        var latlng = new google.maps.LatLng(30.04446, 31.235676);
                        var myOptions = {
                            zoom: 14,
                            center: latlng,
                            mapTypeControl: true,
                            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                            navigationControl: true,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                        if (geocoder) {
                            geocoder.geocode({'address': address}, function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                                        map.setCenter(results[0].geometry.location);

                                        var infowindow = new google.maps.InfoWindow(
                                                {content: '<b>' + address + '</b>', size: new google.maps.Size(150, 50)
                                                });

                                        var marker = new google.maps.Marker({
                                            position: results[0].geometry.location,
                                            map: map,
                                            title: address
                                        });
                                        google.maps.event.addListener(marker, 'click', function () {
                                            infowindow.open(map, marker);
                                        });

                                    } else {
                                        alert("No results found");
                                    }
                                } else {
                                    alert("Geocode was not successful for the following reason: " + status);
                                }
                            });
                        }
                    }
            </script>
            <!--ad image code start-->
            <div class=" small-12 medium-12  large-7  columns" style="padding:0 !important;">
                <div id="map_canvas" style="width:100%; height:420px"></div>
            </div>
            <!--ad image code end-->


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