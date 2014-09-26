<? require_once 'head.php'; ?>
<body>
    <? require_once 'header.php'; ?>

    <div class="row" style="margin-top:36px;">
        <?
        $no_add_ad = true;
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



            <!--ad info code start-->
            <form>

                <!--نوع الاعلان-->
                <div class=" small-12  meduim-12  large-4 columns" style="border-left:1px solid #ccc;">

                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">نوع الاعلان</h5>
                    </div>

                    <div class="small-12 columns right">


                        <label>نوع الحيوان الاليف
                            <select>
                                <option value="">اختار النوع</option>
                                <option value="كلاب">كلاب</option>
                                <option value="قطط">قطط</option>
                                <option value="اسماك">اسماك</option>
                                <option value="خيول">خيول</option>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>نوع الاعلان
                            <select>
                                <option value="">اختار النوع</option>
                                <?
                                $types = Lists::ads_types();
                                foreach ($types as $type) {
                                    ?> 
                                    <option value="<?= $type['value']; ?>"><?= $type['text']; ?></option>
                                <? } ?>
                            </select>
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>تفاصيل
                            <select>
                                <option value="">اختار النوع</option>
                                <option value="بنى سويف">بنى سويف</option>
                                <option value="المنيا">المنيا</option>
                                <option value="اسيوط">اسيوط</option>
                                <option value="سوهاج">سوهاج</option>
                            </select>
                        </label>

                    </div>

                </div>


                <!--معلومات الاعلان-->
                <div class=" small-12 meduim-2  large-4 columns" style="border-left:1px solid #ccc;">

                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">معلومات الاعلان</h5>
                    </div>

                    <div class="small-12 columns right">

                        <label>اسم الاعلان هنا
                            <input type="text" name="title" placeholder="" />
                        </label>

                    </div>

                    <div class="small-12 columns right">

                        <label>معلومات الاعلان هنا
                            <textarea style="height:120px;">
                            </textarea>
                        </label>

                    </div>

                </div>


                <!--موقع الاعلان-->
                <div class=" small-12  meduim-12 large-4 columns">

                    <div class="small-12 columns right">
                        <h5 style="color:#09c; border-bottom:1px solid #60e0f5; padding-bottom:6px; margin-bottom:6px;">موقع الاعلان</h5>
                    </div>

                    <div class="small-12 columns right">


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

                    <div class="small-12 columns right">

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

                    <div class="small-12 columns right">

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


                <!--ad info code end-->



            </form>
            <!--ad image code start-->
            <div class=" small-12 medium-12  large-12 columns" style=" margin-top:26px;">

                <div id="dropbox">
                    <form action="/pets/ads/file_upload"  class="dropzone"></form>
                </div>

            </div>
            <!--ad image code end-->
            <script>
                dropZone.on("success", function(file, serverFileName) {
                    fileList[serverFileName] = {"serverFileName" : serverFileName, "fileName" : file.name };
                });
                dropzone.on("removedfile", function(file) {
                    alert('here');
                    var server_file = $(file.previewTemplate).children('.server_file').text();
                    alert(server_file);
                    // Do a post request and pass this path and use server-side language to delete the file
                    $.post("/pets/ads/del", { file_to_be_deleted: server_file } );
                });
                
                
                function delete_file(){
                    $.ajax({
                        url: "/pets/ads/del",
                        type: "POST",
                        data: { "fileList" : JSON.stringify(fileList) }
                    });
                }
                
            </script>

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

