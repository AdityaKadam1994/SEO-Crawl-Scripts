<?php 
function crawlPage($url) { 
  
    $dom = new DOMDocument('1.0'); 
      
    // Loading HTML content in $dom 
    @$dom->loadHTMLFile($url); 
      
    $node = $dom -> getElementsByTagName('img'); 
      
    // Extracting attribute from each object 
    foreach ($node as $element) { 
          
        
        $src = $element -> getAttribute('src'); 
          
        $alt = $element -> getAttribute('alt'); 
        
        $height = $element -> getAttribute('height'); 
        
        $width = $element -> getAttribute('width'); 
          
        echo 'src='.$src.'<br> alt='.$alt.'<br> height='
                . $height.'<br> width='.$width.'<hr>'; 
    } 
}  
   
crawlPage("https://whototradewith.com/"); 
   
?> 