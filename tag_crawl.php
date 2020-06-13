<?php 
	
function crawlPage($url,$arrr) { 

	$dom = new DOMDocument; 
	
	// Loading HTML content in $dom 
	foreach ($url as $linkname) {
		echo $linkname;
		echo '<br>';

		@$dom->loadHTMLFile($linkname); 
		foreach($arrr as $tagname ){
			$node = $dom -> getElementsByTagName($tagname); 
			echo '<b>'.$tagname.'</b>';
			echo '<br>';
			
			// Extracting attribute from each object 
			if ($tagname == 'meta') {
	
				foreach ($node as $element) { 
					if ($element -> getAttribute('name')){
						echo "<b>".$element -> getAttribute('name')."</b>".":".$element -> getAttribute('content'); 
						echo "<br>";
					}else {

						echo "<b>".$element -> getAttribute('property')."</b>".":".$element -> getAttribute('content'); 
						echo '<br>';
					}
					
				}

			}
			elseif($tagname == 'a') {
				foreach ($node as $element) { 
					echo $element -> getAttribute('href'); 
					echo '<br>';
				}
			}
			elseif($tagname == 'img') {
				echo '<br>';
				foreach ($node as $element) { 
					$src = $element -> getAttribute('src'); 
					$alt = $element -> getAttribute('alt'); 
					
					echo 'src='.$src.' alt='.$alt.'<br>';
				}
			}
			elseif($tagname == 'link') {
				foreach ($node as $element) { 
					$atr = $element -> getAttribute('rel'); 
					if ($atr == 'canonical') {
						echo '<b>Canonical:</b> '.$element -> getAttribute('href').'<br>'; 
						}
				}
			}
			else {
				foreach ($node as $element) { 
						// echo $element -> nodeValue;
						echo $element -> nodeValue;
						// echo $element -> tagName;
						echo '<br>';
					
				}
				echo '<br>';
			}
			 
		}

		echo '<br>';
		echo '>>>>>>>>>>>>>>>>>>>>END>>>>>>>>>>>>>>>>>>>>>>>>>>><br>';
	}
	
}

crawlPage(["https://www.itimf.com/locate_advisor/east.aspx",
"https://www.itimf.com/locate_advisor/west.aspx",
"https://www.itimf.com/for-investors/faqs/ISIP"],['h1','h2','h3','h4','h5','h6','a','img','meta','link']); 


?> 
