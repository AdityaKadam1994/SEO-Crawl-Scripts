<?php 
    
function crawlPage($url) { 
  
    $dom = new DOMDocument('1.0'); 
      
    // Loading HTML content in $dom 
    @$dom->loadHTMLFile($url); 
      
    // Selecting all image i.e. img tag object 
    $node = $dom -> getElementsByTagName('img'); 
     
    foreach ($node as $element) { 
          
      
        $src = $element -> getAttribute('src'); 
          
        $alt = $element -> getAttribute('alt'); 
          
        $height = $element -> getAttribute('height'); 
          
        $width = $element -> getAttribute('width'); 

        echo '<img src="'.$src.'" alt="'.$alt.'" height="'
                . $height.'" width="'.$width.'"/>'; 
    } 
}  
   
crawlPage("https://whototradewith.com/"); 
   
?>