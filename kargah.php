<?php
/**
 * @version 1
 * @package    joomla
 * @subpackage Project
 * @author	   	
 *  @copyright  	Copyright (C) 2014, . All rights reserved.
 *  @license 
 */

//--No direct access
defined('_JEXEC') or die('Resrtricted Access');
define('COM_PATH','components/com_kargah/');
define('SITE_PATH',JURI::base().'components/com_kargah/');
include COM_PATH.'class/conf.php';
include COM_PATH.'class/mysql_class.php';
include COM_PATH.'class/htmlGenerator.php';
include COM_PATH.'class/xgrid.php';
include COM_PATH.'class/inc.php';
include COM_PATH.'class/jdf.php';
include COM_PATH.'class/audit_class.php';
include COM_PATH.'class/kargah_class.php';
$document = JFactory::getDocument();
$document->addScript(COM_PATH.'js/jquery.min.js');
$document->addScript(COM_PATH.'js/grid.js');
$document->addScript(COM_PATH.'js/jquery.ui.widget.js');
$document->addScript(COM_PATH.'js/jquery.fileupload.js');
$document->addScript(COM_PATH.'js/jquery.iframe-transport.js');
$document->addScript(COM_PATH.'js/cal/jalali.js');
$document->addScript(COM_PATH.'js/cal/calendar.js');
$document->addScript(COM_PATH.'js/cal/calendar-setup.js');
$document->addScript(COM_PATH.'js/cal/lang/calendar-fa.js');

$document->addStyleSheet(COM_PATH.'css/bootstrap.min.css');
$document->addStyleSheet(COM_PATH.'css/xgrid.css');
$document->addStyleSheet(COM_PATH.'css/com_kargah.css');
$document->addStyleSheet(COM_PATH.'css/jquery.fileupload.css');
$document->addStyleSheet(COM_PATH.'js/cal/skins/aqua/theme.css');
//JToolBarHelper::custom();
//JToolBarHelper::custom('addtrack', 'addtrack.png', 'addtrack_f2.png','Add Track', false);
function loadDate($inp)
{
	return(($inp == '' || $inp == '0000-00-00 00:00:00')?'----':jdate("Y/m/d",strtotime($inp)));
}
function loadDateBack($inp)
{
/*
	$d = explode('/',$inp);
	var_dump($d);
	$t = jalali_to_jgregorian($inp[0],$inp[1],$inp[2]);
	var_dump($t);
	return($t[0].'-'.$t[1].'-'.$t[2].' 00:00:00');
*/
	return(hamed_pdateBack($inp));
}
$command = (isset($_REQUEST['comman']) && trim($_REQUEST['comman'])!='')?$_REQUEST['comman']:'list';
if($command == 'list')
{
	function loadPic($inp)
        {
	    $k = new kargah_class($inp);
	    $tmp = explode('/',$k->pic);
	    $tt = str_replace($tmp[count($tmp)-1], 'thumbnail/'.$tmp[count($tmp)-1], $k->pic);
	    $p = (isset($k->pic) && trim($k->pic)!='')?'<img width="30px" src="'.$tt.'" />':'اصلاح';
            $out = '<a class="btn btn-info" href="index.php?option=com_kargah&comman=pic&id='.$inp.'" >'.$p.'</a>';
            return $out;
        }
	function loadToz($inp)
	{
		$k = new kargah_class($inp);
                if(trim($k->toz)==='')
                    $k->toz='جهت ویراش کلیک کنید';
		$out = '<a href="index.php?option=com_kargah&comman=edi&id='.$inp.'&" >'.substrH(strip_tags($k->toz),50).'</a>';
		return($out);
	}
        $gname = "gname_khadamat";
	$input =array($gname=>array('table'=>'#__kargah_data','div'=>'main_div_khadamat'));
        $xgrid = new xgrid($input,"index.php?option=com_kargah&");
        $xgrid->column[$gname][3]['name'] = '';
	$xgrid->column[$gname][2] = $xgrid->column[$gname][0];
	$xgrid->column[$gname][2]['cfunction'] = array('loadToz');
	$xgrid->column[$gname][2]['access'] = 'a';
	$xgrid->column[$gname][2]['name'] = 'توضیحات';
	$xgrid->column[$gname][4]['cfunction'] = array('loadDate','loadDateBack');
        $xgrid->column[$gname][5]['name'] = 'نوع کارگاه';
	$xgrid->column[$gname][5]['clist'] = array(-2=>'پیشنهادی',0=>'غیر فعال',1=>'فعال');
        $xgrid->column[$gname][5]['search']='list';
        $xgrid->column[$gname][5]['searchDetails'] = array(-2=>'پیشنهادی',0=>'غیر فعال',1=>'فعال');
        $xgrid->column[$gname][6]['name'] = 'قیمت';
	$xgrid->column[$gname][7] = $xgrid->column[$gname][0];
	$xgrid->column[$gname][7]['name'] = 'تصویر';
	$xgrid->column[$gname][7]['cfunction'] = array('loadPic');
	$xgrid->column[$gname][7]['access'] = 'a';
        $xgrid->canEdit[$gname]=TRUE;
        $xgrid->canAdd[$gname]=TRUE;
        $xgrid->canDelete[$gname]=TRUE;
        $out =$xgrid->getOut($_REQUEST);
        if($xgrid->done)
                die($out);
	
}
else
{
	require($command.'.php');
}
if($command == 'list')
{?>
<script>
    var ggname_project ="<?php echo $gname; ?>";
    jQuery(document).ready(function(){
        var args=<?php echo $xgrid->arg; ?>;
        //args[ggname_project]['afterLoad']=after_grid;
	//jQuery("#toolbar-box").hide();
        intialGrid(args);
    });
</script>
<div id="menu_div" dir="ltr">
	<button class="btn btn-inverse" onclick="window.location='index.php?option=com_kargah&comman=req&';">درخواست ها</button>
	<button class="btn btn-inverse" onclick="window.location='index.php?option=com_kargah&';">صفحه اصلی</button>
</div>
<div id="main_div_khadamat" ></div>
<?php } else{ ?>
    <a href="index.php?option=com_kargah&"  class="btn btn-warning" ><i class="icon-white icon-arrow-left"></i>
        بازگشت به صفحه اصلی
    </a>
<?php }
