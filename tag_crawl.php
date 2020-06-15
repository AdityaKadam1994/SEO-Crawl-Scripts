<?php 
	$link_arr = array();
	$tags_arr = array();
	$link = $_REQUEST['links'];
	$str_arr = preg_split ("/\,/", $link);
	foreach($str_arr as $ele) {
		array_push($link_arr,$ele);
	}
	
	$tags = $_REQUEST['checked_tag'];
	foreach ($tags as $checked_tag){ 
		array_push($tags_arr,$checked_tag);
	}	
	function crawlPage($url,$arrr) { 
		

	$dom = new DOMDocument; 
	
	// Loading HTML content in $dom 
	foreach ($url as $linkname) {
		echo $linkname;
		echo '<br>';

		@$dom->loadHTMLFile($linkname); 
		foreach($arrr as $tagname ){
			$node = $dom -> getElementsByTagName($tagname); 
			echo '<th><b>'.$tagname.'</b></th>';
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
					$href= $element -> getAttribute('href'); 

					$content = $element -> nodeValue;
					$final = htmlspecialchars("<a href=".'"'.$href.'"'.">".$content."</a>",ENT_QUOTES);
					echo $final;
					
					echo '<br>';
					
				}
			}
			elseif($tagname == 'img') {
				echo '<br>';
				foreach ($node as $element) { 
					$src = $element -> getAttribute('src'); 
					$alt = $element -> getAttribute('alt'); 
					$final = htmlspecialchars("<img src=".'"'.$src.'"'." "."alt=".'"'.$alt.'"'.">",ENT_QUOTES);
					// echo 'src='.$src.' alt='.$alt.'<br>';
					echo $final;
					echo '<br>';
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
crawlPage($link_arr,$tags_arr); 


?> 
