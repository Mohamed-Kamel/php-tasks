<?php

$arr1 = [3,5,10,1, 4];

$arr2 = [2, 8, -2, 0];

$result = [5, 13, 8, 1, 4];

echo "<pre>";


test_addition($arr1, $arr2, $result, "add_arrays");

 // add_arrays($arr1, $arr2);

function add_arrays($arr1, $arr2){
	$result = [];
	if(count($arr1) > count($arr2)){

		for( $i = 0; $i<count($arr1); $i++) {

			if(count($arr2) > $i){
				$result[$i] = $arr1[$i] + $arr2[$i];
			}else{
				$result[$i] = $arr1[$i] + 0;	
			}
		}

	}elseif(count($arr1) < count($arr2)){

		for( $i = 0; $i<count($arr2); $i++) {
			if(count($arr1) > $i){
			$result[$i] = $arr1[$i] + $arr2[$i];
			}else{
			$result[$i] = 0 + $arr2[$i];	
			}	
		}		

	}else{

		for( $i = 0; $i<count($arr1); $i++) {
			$result[$i] = $arr1[$i] + $arr2[$i];
		}	
	}

	// print_r($result);
	return $result;
}




function test_addition($arr1, $arr2, $result, $fn_name){
	
	$res = $fn_name($arr1, $arr2);

	for( $i = 0; $i<count($result); $i++) {
		if($res[$i] != $result[$i]){
			echo "Error: There are error in the function!";
			return;
		}
	}
	echo "Excellent: The function works good";
}





echo "<hr/> client IP : ".$_SERVER['REMOTE_ADDR'];

echo "<hr/> User browser : ".$_SERVER['HTTP_USER_AGENT'];

// // $browser = get_browser();
// print_r($browser);

echo "<hr/> PHP version :".phpversion();


$filename = 'assign2.php';
if (file_exists($filename)) {
    echo "<hr/><b>$filename </b>was last modified: " . date ("d/m/Y h:i:s a.", filemtime($filename)) ."<hr/>";
}

$dir = "../";
$files1 = scandir($dir);
echo "<b>htdocs</b> directory contents : <br/>";
print_r($files1);


