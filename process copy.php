<?php
// URL to scrape data from
$url = "https://statelottery.kerala.gov.in/index.php/lottery-result-view";

// Use cURL to fetch the page content
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($ch);
curl_close($ch);

// Load HTML content into DOMDocument
$dom = new DOMDocument();
libxml_use_internal_errors(true); // Suppress HTML errors
$dom->loadHTML($html);
libxml_clear_errors();

// Parse the table and extract lottery data
$xpath = new DOMXPath($dom);
$rows = $xpath->query("//table[@id='dtList']//tbody//tr");

$lotteries = [];

foreach ($rows as $row) {
    $lottery = [];
    $columns = $row->getElementsByTagName('td');

    $lottery['name'] = trim($columns->item(0)->nodeValue); // Lottery name
    $lottery['date'] = trim($columns->item(1)->nodeValue); // Draw date
    $lottery['pdf_link'] = $columns->item(2)->getElementsByTagName('a')->item(0)->getAttribute('href'); // PDF link
    
    $lotteries[] = $lottery;
}

// Convert the data to JSON format
$jsonData = json_encode($lotteries, JSON_PRETTY_PRINT);

// Save the JSON data to a file
file_put_contents('lottery_data.json', $jsonData);

// Optional: Display success message
echo "Lottery data has been saved to lottery_data.json";
