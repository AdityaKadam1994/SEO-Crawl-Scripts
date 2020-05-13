<?php 
	
function crawlPage($url) { 

	$dom = new DOMDocument; 
	
	// Loading HTML content in $dom 
	@$dom->loadHTMLFile($url); 
	
	
	$node = $dom -> getElementsByTagName('a'); 
	
	
	// Extracting attribute from each object 
	foreach ($node as $element) { 
	
		echo $element -> nodeValue;
		echo '<br>';

	} 

} 

crawlPage("htdocs/web.html"); 

?> 
