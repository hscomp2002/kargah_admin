<?php
	$document->addScript(COM_PATH.'js/ckeditor/ckeditor.js');
	$msg="";
	$id = (int)$_REQUEST['id'];
	if(isset($_REQUEST['editor1']))
	{
		$my = new mysql_class;
		$my->ex_sqlx("update #__kargah_data set `toz` = '".$_REQUEST['editor1']."' where `id` = $id");
		$msg = "<h3>اصلاح با موفقیت انجام شد</h3>";
		//JError::raiseError(500, 'گذرواژه ها با هم تطابق ندارد');

	}
	$k = new kargah_class($id);
?>
<form method="post">
	<h3>توضیحات کارگاه <?php echo $k->name; ?></h3>
	<button>ثبت</button><?php echo $msg; ?>
	<input type="hidden" name="option" value="com_kargah"/>
	<input type="hidden" name="comman" value="edi"/>
	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
	<textarea id="editor1" name="editor1"><?php echo $k->toz; ?></textarea>
</form>
<script>
	CKEDITOR.replace( 'editor1' );
</script>
