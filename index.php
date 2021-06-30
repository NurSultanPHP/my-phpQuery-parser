<?php
require_once "phpQuery-onefile.php";
require_once "my-functions.php";
header('Content-type: text/html; charset=utf-8');
$doc = phpQuery::newDocument(file_get_contents('https://git-scm.com/downloads/guis'));
$data = [];
$entry = $doc->find('ul.gui-thumbnails li');
foreach ($entry as $row) {
    $description = pq($row)->find('p.description')->text().' end';
    $description = str_replace("\r"," ",$description);
    $description = str_replace("\n"," ",$description);

    $platforms = str_to_array($description,'Platforms:','Price',[',']); //Platforms
    $price = str_to_array($description,'Price:','License',[',','/']); //Price
    $license = str_to_array($description,'License:','end',[' ']); //License

    array_push($data,[
        'image' => 'https://git-scm.com'.pq($row)->find('a img')->attr('src'),
        'title' => pq($row)->find('h4 a')->text(),
        'platforms' => $platforms,
        'price' => $price,
        'license' => $license,
    ]);
}
echo '<pre>';
print_r($data); 
echo '</pre>';