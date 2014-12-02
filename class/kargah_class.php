<?php
        class kargah_class
        {
		function __construct($id=-1)
		{
			$id = (int)$id;
			if($id > 0)
			{
				$my = new mysql_class;
				$my->ex_sql("select * from #__kargah_data where `id` = $id",$q);
				if(isset($q[0]))
				{
					$r = $q[0];
					$this->id = $id;
					$this->name = $r['name'];
					$this->toz = $r['toz'];
					$this->pic = $r['pic'];
					$this->tarikh = $r['tarikh'];
					$this->en = $r['en'];
                                        $this->ghimat =(int) $r['ghimat'];
				}
			}
		}
	}
?>
