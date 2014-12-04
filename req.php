<?php
	function loadKargah($id)
	{
		$k = new kargah_class($id);
		return(isset($k->name)?$k->name:'----');
	}
        function loadStat($inp)
        {
            $out=$inp;
            if((int)$inp==-1)
                $out = 'پیش ثبت نام';
            return($out);
        }
        $gname = "gname_reserve";
	$input =array($gname=>array('table'=>'#__kargah_reserve','div'=>'main_div_khadamat'));
        $xgrid = new xgrid($input,"index.php?option=com_kargah&comman=req&");
	$xgrid->column[$gname][1]['access'] = 'a';
	$xgrid->column[$gname][7]['name'] = 'وضعیت';
        $xgrid->column[$gname][7]['cfunction'] = array('loadStat');
	$xgrid->column[$gname][1]['cfunction'] = array('loadDate');
	$xgrid->column[$gname][8]['name'] = 'کارگاه';
	$xgrid->column[$gname][8]['cfunction'] = array('loadKargah');
	$xgrid->column[$gname][8]['access'] = 'a';
        $xgrid->column[$gname][9] = $xgrid->column[$gname][0];
        $xgrid->column[$gname][9]['name'] = 'ره‌گیری';
        
        $xgrid->canEdit[$gname]=TRUE;
        $xgrid->canDelete[$gname]=TRUE;
	//$xgrid->echoQuery = TRUE;
        $out =$xgrid->getOut($_REQUEST);
        if($xgrid->done)
                die($out);

?>
<script>
    var ggname_project ="<?php echo $gname; ?>";
    jQuery(document).ready(function(){
        var args=<?php echo $xgrid->arg; ?>;
        //args[ggname_project]['afterLoad']=after_grid;
	jQuery("#toolbar-box").hide();
        intialGrid(args);
    });
    function twoDig(inp)
    {
	inp = parseInt(inp,10);
	return(inp<10?"0"+String(inp):inp);
    }
    function searchGrid()
    {
	var aztarikh = '';
	var tatarikh = '';
        var werc= "";
	var azt = jQuery("#aztarikh").val();
	if(jQuery.trim(azt))
	{
		var aztt = JalaliDate.jalaliToGregorian(azt.split('/')[0],azt.split('/')[1],azt.split('/')[2]);
		aztarikh = aztt[0]+'-'+twoDig(aztt[1])+'-'+twoDig(aztt[2])+' 00:00:00';
		werc = " where `tarikh` >= '"+aztarikh+"' ";
	}
	var tat = jQuery("#tatarikh").val();
	if(jQuery.trim(tat))
	{
		var tatt = JalaliDate.jalaliToGregorian(tat.split('/')[0],tat.split('/')[1],tat.split('/')[2]);
		tatarikh = tatt[0]+'-'+twoDig(tatt[1])+'-'+twoDig(tatt[2])+' 23:59:59';
		werc += ((werc == '')?" where ":" and ")+" `tarikh` <= '"+tatarikh+"' ";
	}
	if(jQuery.trim(jQuery("#sfname").val())!='')
		werc += ((werc == '')?" where ":" and ")+" `fname` like '%"+jQuery.trim(jQuery("#sfname").val())+"%' ";
	if(jQuery.trim(jQuery("#slname").val())!='')
		werc += ((werc == '')?" where ":" and ")+" `lname` like '%"+jQuery.trim(jQuery("#slname").val())+"%' ";
	if(jQuery.trim(jQuery("#smob").val())!='')
		werc += ((werc == '')?" where ":" and ")+" `mob` like '%"+jQuery.trim(jQuery("#mob").val())+"%' ";
	if(jQuery.trim(jQuery("#stell").val())!='')
		werc += ((werc == '')?" where ":" and ")+" `tell` like '%"+jQuery.trim(jQuery("#stell").val())+"%' ";
	if(jQuery.trim(jQuery("#saddress").val())!='')
		werc += ((werc == '')?" where ":" and ")+" `address` like '%"+jQuery.trim(jQuery("#saddress").val())+"%' ";
	console.log(werc);
        whereClause[ggname_project] = encodeURIComponent(werc);
        grid[ggname_project].init(gArgs[ggname_project]);
    }
</script>
<div id="menu_div" dir="ltr">
	<button class="btn btn-inverse" onclick="window.location='index.php?option=com_kargah&comman=req&';">درخواست ها</button>
	<button class="btn btn-inverse" onclick="window.location='index.php?option=com_kargah&';">صفحه اصلی</button>
</div>
<br/>
<div id="sdiv" style="margin-bottom: 10px;" >
    <div>
        از تاریخ : <input class="dateValue" id="aztarikh" />
        تا تاریخ: <input class="dateValue" id="tatarikh" />
	نام : <input id="sfname" />
	نام خانوادگی: <input id="slname" />
    </div>  
    <div>
	موبایل : <input id="smob" />
	تلفن ثابت : <input id="stell" />
	پست الکترونیک : <input id="saddress" />
	<button class="btn btn-info" onclick="searchGrid();">جستجو</button>
    </div>
</div>
<div id="main_div_khadamat" ></div>
