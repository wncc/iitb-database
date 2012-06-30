<?php

function displayImageDimensions($url){
	$imageArray = getimagesize($url);
	if($imageArray[0] > $imageArray[1])
		$imageArray[0] = $imageArray[1];
	return $imageArray;
}

?>