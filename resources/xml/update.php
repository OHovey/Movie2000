<?php

// function update() {

//     $service_url = 'https://hydramovies.com/api-v2/?source=http://hydramovies.com/api-v2/current-Movie-Data.csv';
//     $curl = curl_init($service_url);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//     $curl_response = curl_exec($curl);

//     if ($curl_response === false) {
//         $info = curl_getinfo($curl);
//         curl_close($curl);
//         die('error occured during curl exec. Additional info: ' . var_export($info));
//     }
//     curl_close($curl);
//     $decoded = json_decode($curl_response);
//     if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
//         die('error occured: ' . $decoded->response->errormessage);
//     }
//     echo 'response ok!';
//     // var_export($decoded->response);
    

//     $xml = new DOMDocument();
//     $xml->load('resources/xml/movie_details.xml');
//     $nodes = $xml->getElementsByTagName('Table');

//     $titles = array();

//     foreach($nodes as $node) {
//         $columns = $node->getElementsByTagName('column');
//         foreach($columns as $column) {

//             if ($columns->getAttribute('name') == 'COL 1') {
//                 array_push($titles, $column->nodeValue);
//             }
//         }
//     } 
    
//     foreach ($decoded as $movie) {
//         if (in_array($movie->Title, $titles)) {
//             continue;
//         } else {
//             $title = $movie->Title;
//             $fulltitle = $movie->fulltitle;
//             $year = $movie->movie_year;
//             $catagory = $movie->Catagories;
//             $summary = $movie->summary;
//             $image = $movie->Image_URL;
//             $id = $movie->imbd_id;
//             $rating = $movie->imbd_rating;
//             $runtime = $movie->Runtime;
//             $language = $movie->language;
//             $ytid = $movie->ytid;

//             $xml->createElement('table');

//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 1') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 2') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 3') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 4') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 5') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 6') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 7') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 8') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 9') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 10') );
//             $xml->append_child ( $xml->createElement('column', $title)->create_attribute('name')->value('COL 11') );

//             $Movie->update($title, $fulltitle, $year, $catagory, $summary, $image, $id, $rating, $runtime, $language, $ytid);
//         }
//     }
    

// }

// function main() {
//     $timestamp = time();

//     if (date('D', $timestamp) === 'Fri') {
//         update();
//     }
// }

// main();

?>