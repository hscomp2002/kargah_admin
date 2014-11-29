<?php
        $kargah_id = isset($_REQUEST['id'])?(int)$_REQUEST['id']:-1;
	$kargah =  new kargah_class($kargah_id);
        $my = new mysql_class;
        if(isset($_REQUEST['uploaded']))
        {
            $file_name =SITE_PATH.'images/files/'.$_REQUEST['uploaded'];
            $toz = strip_tags(trim($_REQUEST['toz']));
            
            $my->ex_sqlx("update #__kargah_data set `pic` = '$file_name' where `id` = $kargah_id");
            die("ok");
        }
	$ou = '<ul class="gallery" >';
	$ou.= $ou.='<li class="thumb" >';
	$tmp = explode('/',$kargah->pic);
	$tt = str_replace($tmp[count($tmp)-1], 'thumbnail/'.$tmp[count($tmp)-1], $kargah->pic);
	$ou.='<div class="thumb_img"> <a target="_blank" href="'.$kargah->pic.'" ><img src="'.$tt.'" ></a></div>';
	$ou.='</li>';
	$ou.='</ul>';
 ?>
<script>
        var dataAll=[];
        var project_id = <?php echo $kargah_id; ?>;
        function newFileAdded(data)
        {
            $("#save_btn").prop('disabled',false);
        }
        function sendIndex(index)
        {
            var i = (typeof index != 'undefined')?parseInt(index,10):-1;
            if(i>=0)
                    dataAll[i].submit();
            else
                    for(i = 0; i < dataAll.length;i++)
                            dataAll[i].submit();
        }
        $(document).ready(function(){
           'use strict';
            // Change this to the location of your server-side upload handler:
            var url = '<?php echo SITE_PATH ?>'+'images/';
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                autoUpload: false,
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        var obj={'uploaded':file.name,'id':project_id};
                        $.get('index.php?option=com_kargah&comman=pic',obj,function(result){
                            window.location=window.location;
                        });
                    });
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                    );
                }
            }).on("fileuploadadd",function(e, data){
                    dataAll.push(data);
                    newFileAdded(data);
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled'); 
        }); 
</script>
<div >
    <div class="label label-important" >
        <h3>
         کارگاه:
        <?php
            echo $kargah->name;
        ?>
        </h3>
    </div>
    <div>
        <?php echo $ou; ?>
    </div>
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="icon-white icon-picture"></i>
        <span> افزودن تصویر ...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <button class="btn btn-warning" id="save_btn" disabled="disabled" onclick="sendIndex(0);" ><i class="icon-white icon-upload"></i>
 ذخیره
    </button>
    <br>
    <br>
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <div id="files" class="files"></div>
    <div id="edit_khoon" style="padding-bottom:10px;" ></div>
    
</div>
