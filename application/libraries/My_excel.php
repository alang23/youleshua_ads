<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 


class My_excel {
	/**
	 * 导出excel 2007
	 * @param $array 二维数组
	 */
    function export($array, $title){
    	
    	require_once 'phpexcel/PHPExcel.php';
    	$objPHPExcel = new PHPExcel();

    	$objPHPExcel
	      ->getProperties()  //获得文件属性对象，给下文提供设置资源
	      ->setCreator( "Maarten Balliauw")                 //设置文件的创建者
	      ->setLastModifiedBy( "Maarten Balliauw")          //设置最后修改者
	      ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
	      ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
	      ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
	      ->setKeywords( "office 2007 openxml php")        //设置标记
	      ->setCategory( "Test result file");                //设置类别
		// 位置aaa  *为下文代码位置提供锚
		// 给表格添加数据
		
		$c = array('A','B','C','D','E','F','G','H','I','J','K','L');
		$list_count = count($array[0]);
		
		$total = count($array);
		for($i=0; $i<$total; $i++){
			for($j=0; $j<$list_count; $j++){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($c[$j].($i+1), $array[$i][$j], PHPExcel_Cell_DataType::TYPE_STRING);
			}
		}
		
		//得到当前活动的表,注意下文教程中会经常用到$objActSheet
		$objActSheet = $objPHPExcel->getActiveSheet();
		// 位置bbb  *为下文代码位置提供锚
		// 给当前活动的表设置名称
		$objActSheet->setTitle($title);


		  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment; filename=\"$title\"");
          header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save( 'php://output');
		//$objWriter->save('php://output'); //文件通过浏览器下载
    }

    	/**
	 * 导出excel 2007
	 * @param $array 二维数组
	 */
    function export_business($array, $title){
    	
    	require_once 'phpexcel/PHPExcel.php';
    	$objPHPExcel = new PHPExcel();

    	$objPHPExcel
	      ->getProperties()  //获得文件属性对象，给下文提供设置资源
	      ->setCreator( "Maarten Balliauw")                 //设置文件的创建者
	      ->setLastModifiedBy( "Maarten Balliauw")          //设置最后修改者
	      ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
	      ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
	      ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
	      ->setKeywords( "office 2007 openxml php")        //设置标记
	      ->setCategory( "Test result file");                //设置类别
		// 位置aaa  *为下文代码位置提供锚
		// 给表格添加数据
	
		  //设置excel列名
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','注册姓名');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','真实姓名');		  
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','电话');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','身份证');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','银行卡号');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','地区');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','详细地址');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1','来源');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1','日期');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1','四要素');


		  //把数据循环写入excel中
		   //$rm = iconv("GB2312","UTF-8",$array); 
		  foreach($array as $key => $value){
		     $key+=2;
		      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$key, $value['id']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$key, $value['ad_name']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$key, $value['realname']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$key, (string)$value['phone'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$key, (string)$value['card_no'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$key, (string)$value['access'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$key, $value['address']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$key, $value['street']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$key, $value['frm']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$key, date('Y-m-d H:i:s',$value['addtime']));
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$key, siyaosu($value['factor'],1));

		  }

		//得到当前活动的表,注意下文教程中会经常用到$objActSheet
		$objActSheet = $objPHPExcel->getActiveSheet();
		// 位置bbb  *为下文代码位置提供锚
		// 给当前活动的表设置名称
		$objActSheet->setTitle($title);

		ob_get_contents();
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$title\"");
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save( 'php://output');
		//$objWriter->save('php://output'); //文件通过浏览器下载
    }


    	/**
	 * 导出excel 2007-客服
	 * @param $array 二维数组
	 */
    function export_customer($array, $title){
    	
    	require_once 'phpexcel/PHPExcel.php';
    	$objPHPExcel = new PHPExcel();

    	$objPHPExcel
	      ->getProperties()  //获得文件属性对象，给下文提供设置资源
	      ->setCreator( "Maarten Balliauw")                 //设置文件的创建者
	      ->setLastModifiedBy( "Maarten Balliauw")          //设置最后修改者
	      ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
	      ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
	      ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
	      ->setKeywords( "office 2007 openxml php")        //设置标记
	      ->setCategory( "Test result file");                //设置类别
		// 位置aaa  *为下文代码位置提供锚
		// 给表格添加数据
	
		  //设置excel列名
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','注册姓名');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','真实姓名');		  
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','电话');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','地区');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','详细地址');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','日期');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','四要素');


		  //把数据循环写入excel中
		   //$rm = iconv("GB2312","UTF-8",$array); 
		  foreach($array as $key => $value){
		     $key+=2;
		      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$key, $value['id']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$key, $value['ad_name']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$key, $value['realname']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$key, (string)$value['phone'].' ');
			  // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$key, (string)$value['card_no'].' ');
			  // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$key, (string)$value['access'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$key, $value['address']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$key, $value['street']);
			  // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$key, $value['frm']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$key, date('Y-m-d H:i:s',$value['addtime']));
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$key, siyaosu($value['factor'],1));

		  }

		//得到当前活动的表,注意下文教程中会经常用到$objActSheet
		$objActSheet = $objPHPExcel->getActiveSheet();
		// 位置bbb  *为下文代码位置提供锚
		// 给当前活动的表设置名称
		$objActSheet->setTitle($title);

		ob_get_contents();
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$title\"");
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save( 'php://output');
		//$objWriter->save('php://output'); //文件通过浏览器下载
    }

    //导入
    public function imports($dir)
    {

    	require_once 'phpexcel/PHPExcel.php';

		if (!file_exists($dir)) {
		    die('no file!');
		}
		$extension = strtolower( pathinfo($dir, PATHINFO_EXTENSION) );

		if ($extension =='xlsx') {
		    $objReader = new PHPExcel_Reader_Excel2007();
		    $objExcel = $objReader ->load($dir);
		} else if ($extension =='xls') {
		    $objReader = new PHPExcel_Reader_Excel5();
		    $objExcel = $objReader ->load($dir);
		} else if ($extension=='csv') {
		    $PHPReader = new PHPExcel_Reader_CSV();

		    //默认输入字符集
		    $PHPReader->setInputEncoding('GBK');

		    //默认的分隔符
		    $PHPReader->setDelimiter(',');

		    //载入文件
		    $objExcel = $PHPReader->load($dir);
		}
		


		//$reader = PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
		//$PHPExcel = $reader->load($dir); // 载入excel文件
		$sheet = $objExcel->getSheet(0); // 读取第一個工作表
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		$colsNum = $sheet->getHighestColumn(); // 取得总列数
		$highestColumm= PHPExcel_Cell::columnIndexFromString($colsNum); //字母列转换为数字列 如:AA变为27
		
		/** 循环读取每个单元格的数据 */
		// $arr = array(
		// 	0=>'ids',
		// 	1=>'realname',
		// 	2=>'phone',
		// 	3=>'no',
		// 	4=>'style',
		// 	5=>'zhongliang',
		// 	6=>'status',
		// 	7=>'createtime',
		// 	8=>'director'

		// 	);
		$arr = array();
		$tmp = array();
		$result = array();
		for ($row = 1; $row <= $highestRow; $row++){//行数是以第1行开始
		    for ($column = 0; $column < $highestColumm; $column++) {//列数是以第0列开始
		        $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
		        //echo $columnName.$row.":".$sheet->getCellByColumnAndRow($column, $row)->getValue()."<br />";
		        //echo $sheet->getCellByColumnAndRow($column, $row)->getValue();
		        //echo '<br/>';
		        // if(isset($arr[$column])){
		        // 	$tmp[$arr[$column]] = $sheet->getCellByColumnAndRow($column, $row)->getValue();
		        // }

		        $arr[$column] = $sheet->getCellByColumnAndRow($column, $row)->getValue();

		    }
		   $result[] = $arr;
		}
		//print_r($result);
		return $result;
		

    }

    public function read_csv($file)
    {
    	header("Content-type:text/html;charset=utf-8");
    	$file = fopen($file,'r'); 
    	$goods_list = array();
		while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
			$_tmp['order_no'] = iconv('gb2312','utf-8',trim($data[0])); //订单号
			$_tmp['realname'] = iconv('gb2312','utf-8',trim($data[4])); //
			$_tmp['price'] = iconv('gb2312','utf-8',trim($data[11])); //
			$_tmp['phone'] = iconv('gb2312', 'utf-8', trim($data[29]));
			$_tmp['pro_name'] = iconv('gb2312', 'utf-8', trim($data[34]));

			$goods_list[] = $_tmp;
		 }

		 //var_dump($goods_list);

		 return $goods_list;
    }

        	/**
	 * 导出excel 2007-客服
	 * @param $array 二维数组
	 */
    function export_ads($array, $title){
    	
    	require_once 'phpexcel/PHPExcel.php';
    	$objPHPExcel = new PHPExcel();

    	$objPHPExcel
	      ->getProperties()  //获得文件属性对象，给下文提供设置资源
	      ->setCreator( "Maarten Balliauw")                 //设置文件的创建者
	      ->setLastModifiedBy( "Maarten Balliauw")          //设置最后修改者
	      ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
	      ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
	      ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
	      ->setKeywords( "office 2007 openxml php")        //设置标记
	      ->setCategory( "Test result file");                //设置类别
		// 位置aaa  *为下文代码位置提供锚
		// 给表格添加数据
	
		  //设置excel列名
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','关键字');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','URL');		  



		  //把数据循环写入excel中
		   //$rm = iconv("GB2312","UTF-8",$array); 
		  foreach($array as $key => $value){
		     $key+=2;
		      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$key, $value['id']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$key, $value['name']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$key, $value['url']);
	

		  }

		//得到当前活动的表,注意下文教程中会经常用到$objActSheet
		$objActSheet = $objPHPExcel->getActiveSheet();
		// 位置bbb  *为下文代码位置提供锚
		// 给当前活动的表设置名称
		$objActSheet->setTitle($title);

		ob_get_contents();
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$title\"");
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save( 'php://output');
		//$objWriter->save('php://output'); //文件通过浏览器下载
    }

     	/**
	 * 导出excel 2007
	 * @param $array 二维数组
	 */
    function export_deal($array, $title){
    	
    	require_once 'phpexcel/PHPExcel.php';
    	$objPHPExcel = new PHPExcel();

    	$objPHPExcel
	      ->getProperties()  //获得文件属性对象，给下文提供设置资源
	      ->setCreator( "Maarten Balliauw")                 //设置文件的创建者
	      ->setLastModifiedBy( "Maarten Balliauw")          //设置最后修改者
	      ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
	      ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
	      ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
	      ->setKeywords( "office 2007 openxml php")        //设置标记
	      ->setCategory( "Test result file");                //设置类别
		// 位置aaa  *为下文代码位置提供锚
		// 给表格添加数据
	
		  //设置excel列名
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','姓名');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','电话');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','CBC');		  
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','退款时间');



		  //把数据循环写入excel中
		   //$rm = iconv("GB2312","UTF-8",$array); 
		  foreach($array as $key => $value){
		     $key+=2;
		      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$key, $value['name']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$key, (string)$value['phone'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$key, $value['cbc']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$key, $value['update_time']);


		  }

		//得到当前活动的表,注意下文教程中会经常用到$objActSheet
		$objActSheet = $objPHPExcel->getActiveSheet();
		// 位置bbb  *为下文代码位置提供锚
		// 给当前活动的表设置名称
		$objActSheet->setTitle($title);

		ob_get_contents();
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$title\"");
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save( 'php://output');
		//$objWriter->save('php://output'); //文件通过浏览器下载
    }

        	/**
	 * 导出excel 2007
	 * @param $array 二维数组
	 */
    function export_trade($array, $title){
    	
    	require_once 'phpexcel/PHPExcel.php';
    	$objPHPExcel = new PHPExcel();

    	$objPHPExcel
	      ->getProperties()  //获得文件属性对象，给下文提供设置资源
	      ->setCreator( "Maarten Balliauw")                 //设置文件的创建者
	      ->setLastModifiedBy( "Maarten Balliauw")          //设置最后修改者
	      ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
	      ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
	      ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
	      ->setKeywords( "office 2007 openxml php")        //设置标记
	      ->setCategory( "Test result file");                //设置类别
		// 位置aaa  *为下文代码位置提供锚
		// 给表格添加数据
	
		  //设置excel列名
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','流水号');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','签约机构');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','机构号');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','商户号');		  
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','注册商户名');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','终端号');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','交易时间');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','交易金额');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1','交易手续费');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1','借贷记标记');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1','卡应用类型');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1','PSAM卡号');


		  //把数据循环写入excel中
		   //$rm = iconv("GB2312","UTF-8",$array); 
		  foreach($array as $key => $value){
		     $key+=2;
		      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$key, (string)$value['order_sn'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$key, $value['jigou']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$key, (string)$value['jigou_no']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$key, (string)$value['mer_no'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$key, (string)$value['mer_name'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$key, (string)$value['dev_no'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$key, $value['trade_date']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$key, $value['amount']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$key, $value['pay_fee']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$key, $value['pay_type']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$key, $value['card_type']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$key, $value['p_sn']);

		  }

		//得到当前活动的表,注意下文教程中会经常用到$objActSheet
		$objActSheet = $objPHPExcel->getActiveSheet();
		// 位置bbb  *为下文代码位置提供锚
		// 给当前活动的表设置名称
		$objActSheet->setTitle($title);

		ob_get_contents();
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$title\"");
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save( 'php://output');
		//$objWriter->save('php://output'); //文件通过浏览器下载
    }


        	/**
	 * 导出excel 2007
	 * @param $array 二维数组
	 */
    function export_logis($array, $title){
    	
    	require_once 'phpexcel/PHPExcel.php';
    	$objPHPExcel = new PHPExcel();

    	$objPHPExcel
	      ->getProperties()  //获得文件属性对象，给下文提供设置资源
	      ->setCreator( "Maarten Balliauw")                 //设置文件的创建者
	      ->setLastModifiedBy( "Maarten Balliauw")          //设置最后修改者
	      ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
	      ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
	      ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
	      ->setKeywords( "office 2007 openxml php")        //设置标记
	      ->setCategory( "Test result file");                //设置类别
		// 位置aaa  *为下文代码位置提供锚
		// 给表格添加数据
	
		  //设置excel列名
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','ID');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','姓名');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','电话');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1','CBC');		  
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1','地址');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1','状态');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1','客服');
		  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','时间');


		  //把数据循环写入excel中
		   //$rm = iconv("GB2312","UTF-8",$array); 
		  foreach($array as $key => $value){
		     $key+=2;
		      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$key, $value['id']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$key, $value['realname']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$key, (string)$value['phone']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$key, (string)$value['dev_sn'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$key, (string)$value['address'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$key, (string)$value['status'].' ');
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$key, $value['user']);
			  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$key, $value['addtime']);

		  }

		//得到当前活动的表,注意下文教程中会经常用到$objActSheet
		$objActSheet = $objPHPExcel->getActiveSheet();
		// 位置bbb  *为下文代码位置提供锚
		// 给当前活动的表设置名称
		$objActSheet->setTitle($title);

		ob_get_contents();
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$title\"");
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save( 'php://output');
		//$objWriter->save('php://output'); //文件通过浏览器下载
    }

}
?>