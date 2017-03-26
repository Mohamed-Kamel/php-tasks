<?php

$first = ["Ahmed", "Awad", "Muhamed", "Hossam", "Menna", "Doaa", "Asmaa"];

$last = ["Kamel", "Shafik", "Ahmed", "Banna", "Rabee", "Magdi", "Latif"];


for ($i=0; $i < count($last); $i++) { 
		
  	echo $first[generate_random(count($first)-1)]." "
  	. $last[generate_random(count($last) - 1)]."<br>";

}



function generate_random($size){
	return rand(0, $size);
}