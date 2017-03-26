<?php
echo "<pre>";

libxml_use_internal_errors(true);


$doc = new DOMDocument();
$doc->loadHTMLFile("https://ta3weem.com/");
$h1 = $doc->getElementsByTagName("tr");

foreach ($h1 as $item) {
	print_r($item->textContent);
}

/*
//step1
$cSession = curl_init(); 
//step2
curl_setopt($cSession,CURLOPT_URL,"https://ta3weem.com/");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
//step3
$result=curl_exec($cSession);


//step4
curl_close($cSession);
//step5
echo $result;
*/
/*

$data = "iVBORw0KGgoAAAANSUhEUgAAACoAAAANCAIAAABQCGuCAAAABnRSTlMA/wD/AP83WBt9AAAACXBIWXMAAA7EAAAOxAGVKw4bAAACEElEQVQ4jcVUQaspYRh+j1hQFuqQhWOplAUzxU6hWJAsKDspIko2FoqFYuEPWE0WsmAlIZLQlGRBYoeFP2A2kxmSmbuY28kdzrluR91n9b7P+3zP8/bV972xLAv/D8LbJpvNRiIRlUoFANvttlKp8NQSiSSdTvPI6XTa7/dJkkQQxOfziUQinuDWlgfBZ9Vut7vdLk3Tv/cSCt//xHw+n8/nvPP1ej2ZTJ5OJ4VCgWFYOBxmGOZWwLPlg2XZXq/ndrtRFEVRdLPZsI+w2WxMJtNiseDxFoulXC5z9WKxQFF0Mplw7TO2AgBQq9V+vz8ajT5eEAAACoWC1+s1GAy35Pl8JklSqVRyrVwu50iufcYWPhc5HA5frdlqtex2O0VR96NMJuN0OofD4Ww2C4VCTqeTJ/vGlmVZ4XerAQDA5XIplUrhcFgsFt9PA4HAeDxOpVJcG4vFHsq+guCvimazyTCMx+O5H9E0nUgk9Hp9o9HAcTwej5dKJRzHXxlfq9VcLpdQ+OCecBwnCKJYLH58fEgkkmAwqNFoOp3Oy+LX6/V+v7fZbA+nx+MRAG4fOu/V/TR+NBrJZDKtVntLVqvVXC4HAEajUSAQ5PN5giAoisIwbLfbORyOl8WvVisEQXjkcrkcDAYAoFKpMpnMeDy22+1ms5n7dqxW6/Pxb+yP/3yaptfr9fV61el0Uqn0n87+Aqacgv4Y7skxAAAAAElFTkSuQmCC";


$data = base64_decode($data);

$im = imagecreatefromstring($data);

if ($im !== false) {
    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);
}
else {
    echo 'An error occurred.';
}

*/



// get_meta_tags("https://ta3weem.com/");

// $website = file_get_contents("https://ta3weem.com/");
// $doc = new DOMDocument($website);
// var_dump($doc); 

/*
$doc = (String)$website;



$dom = new DOMDocument();
// $doc->loadHTMLFile("https://ta3weem.com/");
// $xpath = new DOMXpath($doc);
// $elements = $xpath->query("*///div[@id='short-info']");

// foreach ($elements as $element) {
//     $nodes = $element->childNodes;
//     foreach ($nodes as $node) {
//         echo $node->textContent; //$node->c14n()
//     }
// }
/*
$dom->loadXML($doc);
$books = $dom->getElementsByTagName('img');

// foreach ($books as $book) {
//     echo $book->nodeValue, PHP_EOL;
// }*/


//get innerhtml

function get_inner_html( $node ) { 
    $innerHTML= ''; 
    $children = $node->childNodes; 
    foreach ($children as $child) { 
        $innerHTML .= $child->ownerDocument->saveXML( $child ); 
    } 

    return $innerHTML; 
} 

/*
$html = htmlentities(file_get_contents("https://ta3weem.com/"));



$doc = new DOMDocument();
$doc->loadHTML($html);

$xpath = new DOMXPath($doc);
$hrefs = $xpath->evaluate("/html/body//a");

for ($i = 0; $i < $hrefs->length; $i++) {
        $href = $hrefs->item($i);
        $url = $href->getAttribute('href');

        //remove and set target attribute        
        $href->removeAttribute('target');
        $href->setAttribute("target", "_blank");

        $newURL=$url.".au";

        var_dump($href);
        echo "<br>";
        var_dump($url);
        //remove and set href attribute        
        $href->removeAttribute('href');
        $href->setAttribute("href", $newURL);
}
*/

//$html = file_get_contents("http://stackoverflow.com/");

// $doc = new DOMDocument();

// $doc->loadHTML("http://stackoverflow.com/");

// print_r($doc);

// $h1 = $doc->$doc->getElementById('')->item(0)->textContent;

// print_r($h1);

// $str = file_get_contents("https://ta3weem.com/");
//   if(strlen($str)>0){
//     $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
//     preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
//     return $title[1];
//   }

/*$website = file_get_contents("https://ta3weem.com/");
// var_dump($website);

$doc = new DomDocument();
@$doc->loadHTML("https://ta3weem.com/");

$doc->loadHTML('<?xml encoding="UTF-8">' . $doc);
*/
// $nodes= $doc->getElementsByTagName('table');



// $innerHTML = ''; 
// $doc = new DOMDocument(); 
// //$doc->loadHTMLFile("https://ta3weem.com/");
// $doc->loadHTMLFile($website);
// $elem = $doc->getElementById($elem_id); 

// // loop through all childNodes, getting html        
// $children = $elem->childNodes; 
// foreach ($children as $child) { 
//     $tmp_doc = new DOMDocument(); 
//     $tmp_doc->appendChild($tmp_doc->importNode($child,true));        
//     $innerHTML .= $tmp_doc->saveHTML(); 
// } 