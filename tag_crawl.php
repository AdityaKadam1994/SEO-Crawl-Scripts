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
		td {
			vertical-align: top;
			border-right: 1px solid #fff;
			min-width: 100px;
			padding: 0 5px;
		}
		td br {
			margin: 8px 0;
			display: inline-block;
		}
		table {
			border: 3px solid #fff;
		}

	</style>";
	$link_arr = array();
	$tags_arr = array();
	$link = $_REQUEST['links'];
	$str_arr = explode(",", $link);
	// print_r($str_arr);
	foreach($str_arr as $ele) {
		$trimmed = trim($ele);
		// echo $trimmed;
		array_push($link_arr,$trimmed);
		
		
	}
	
	$tags = $_REQUEST['checked_tag'];
	foreach ($tags as $checked_tag){ 
		$tags = trim($checked_tag);
		array_push($tags_arr,$tags);
		// echo $tags;
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
				$count = 0;
				foreach ($node as $element) { 
					$count = count($node);
					if ($element -> getAttribute('name')){
						echo "<strong>".$element -> getAttribute('name')."</strong>".":".$element -> getAttribute('content'); 
						echo "<br>";
					}else {

						echo "<strong>".$element -> getAttribute('property')."</strong>".":".$element -> getAttribute('content'); 
						echo '<br>';
					}
					
				}
				echo "<b> Total Count: ".$count."</b>";

			}
			elseif($tagname == 'a') {
				$count = 0;
				foreach ($node as $element) { 
					$count = count($node);
					$href= $element -> getAttribute('href'); 

					$content = $element -> nodeValue;
					$final = htmlspecialchars("<a href=".'"'.$href.'"'.">".$content."</a>",ENT_QUOTES);
					echo $final;
					
					echo '<br>';
					
				}
				echo "<b> Total Count: ".$count."</b>";
			}
			elseif($tagname == 'img') {
				echo '<br>';
				$count = 0;
				foreach ($node as $key => $element) {
					$count = count($node);
					$src = $element -> getAttribute('src'); 
					$alt = $element -> getAttribute('alt');
					$data_src = $element -> getAttribute('data-src');
					$final = htmlspecialchars("<img src=".'"'.$src.'"'." "."data-src=".'"'.$data_src.'"'." "."alt=".'"'.$alt.'"'.">",ENT_QUOTES);
					// echo 'src='.$src.' alt='.$alt.'<br>';
					echo $final;
					echo '<br>';
				}
				echo "<b> Total Count: ".$count."</b>";
			}
			elseif($tagname == 'link') {
				$count = 0;
				foreach ($node as $element) { 
					$atr = $element -> getAttribute('rel'); 
					if ($atr == 'canonical') {
						$count++;
						echo '<strong>Canonical:</strong> '.$element -> getAttribute('href').'<br>'; 
						}
				}
				echo "<b> Total Count: ".$count."</b>";
			}
			else {
				$count = 0;
				foreach ($node as $element) { 
					
						// echo $element -> nodeValue;
						$count = count($node);
						echo htmlspecialchars('<'.$tagname.'>'.$element -> nodeValue.'</'.$tagname.'>');
						// echo $element -> tagName;
						echo '<br>';
					
				}
				echo "<b> Total Count: ".$count."</b>";
				echo '<br>';
			}
			 
			echo "</td>";
		}
		echo "</table>";
		

		echo '<br>';
	}
	
	
}
crawlPage($link_arr,$tags_arr);


?> 
