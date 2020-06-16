<?php
	echo "<style>
	
		body {
			background: #7f7fd5;
			// background: -webkit-linear-gradient(to right, #7f7fd5, #86a8e7, #91eae4);
			// background: linear-gradient(to right, #7f7fd5, #86a8e7, #91eae4);
			color: #fff;
			font-size: 16px;
		}
		b {
			display: inline-block;
			font-size : 20px;
			margin: 8px 0;
			border-bottom: 1px dotted #fff;
		}
		b.main-head {
			color: #38ef7d;
		}
		.flex-container {
			display: flex;
			
		}
		.flex-childs {
			border-right: 1px solid white;
			width: 800px;
    		align-items: center;
    		justify-content: center;
		}
		td {
			vertical-align: top;
			border-right: 1px solid #fff;
		}

	</style>";
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
		echo "<b class='main-head'> Crawling for: ".$linkname."</b>";
		echo '<br>';
		echo "<table class=''>";
		@$dom->loadHTMLFile($linkname); 
		foreach($arrr as $tagname ){
			echo "<td class=''>";
			$node = $dom -> getElementsByTagName($tagname); 
			
			echo '<b>'.$tagname.'</b>';
			echo '<br>';
			
			// Extracting attribute from each object 
			if ($tagname == 'meta') {
	
				foreach ($node as $element) { 
					if ($element -> getAttribute('name')){
						echo "<strong>".$element -> getAttribute('name')."</strong>".":".$element -> getAttribute('content'); 
						echo "<br>";
					}else {

						echo "<strong>".$element -> getAttribute('property')."</strong>".":".$element -> getAttribute('content'); 
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
						echo '<strong>Canonical:</strong> '.$element -> getAttribute('href').'<br>'; 
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
			 
			echo "</td>";
		}
		echo "</table>";

		echo '<br>';
		echo '>>>>>>>>>>>>>>>>>>>>END>>>>>>>>>>>>>>>>>>>>>>>>>>><br>';
	}
	
	
}
crawlPage($link_arr,$tags_arr); 


?> 
