<?php 
    
function crawlPage($url) { 
  
    $dom = new DOMDocument('1.0'); 
      
    // Loading HTML content in $dom 
    @$dom->loadHTMLFile($url); 
      
    $anchors = $dom -> getElementsByTagName('a'); 
      
    // Extracting attribute from each object 
    foreach ($anchors as $element) { 
     
        $atr = $element -> getAttribute('href'); 
   
        echo $atr.'<br>'; 
    } 
}  
   
crawlPage("web.html"); 
   
?> 