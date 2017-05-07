<?php

for($i=27;$i>=0;$i--){
	if($i%2==0){
		echo $i." is even. ";
		if($i%12==0)
			echo $i." is ".($i/12)." dozen";
		echo "<br>";
	}
	else 
		echo $i." is odd. <br>";


}














?>