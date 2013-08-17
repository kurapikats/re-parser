<?php
require_once 'bootstrap.php';

if (isset($_GET['page']) && (!empty($_GET['page']))) {
    $page = $_GET['page'];
} else {
    $page = '/for_sale/Ajo,AZ/';
}

//echo "City,State: " .  rtrim(str_replace('/for_sale/', '', $page), '/') . "<br>";

$html = file_get_html('http://www.trulia.com' . $page);
$listing = $html->find('.propertyList');

/* begin pagination */
$page_list = $html->find('.srpPagination_list', 0);
$raw_page_list = trim($page_list->innertext);

//$page_list->find('a', 0)->href = $_SERVER['PHP_SELF'] . '?page=' . $page_list->find('a', 0)->href;
echo $page_list . "<br>";

$page_link = $html->find('.srpPagination_list a');
echo "Page: ";
foreach ($page_link as $link) {
    //$raw_page_link = trim($page_link->href);
    $link->href = $_SERVER['PHP_SELF'] . '?page=' . $link->href;
    echo $link . " ";
}
echo "<br/>";

$page_range = $html->find('.srpPaginationRange', 0);
echo "Total: " . $raw_page_range = trim($page_range->innertext) . "<br>";
/* end pagination */

echo "<pre>";
foreach ($listing[0]->children() as $row) {
    //$row->find('.mediaBody')[0]->innertext;
    foreach ($row->find('.cardBody')[0]->children() as $data) {

        $thumbnail = $data->find('.overlayContainer img', 0);
        if (!empty($thumbnail->attr['data-lazy-src'])) {
            $raw_thumbnail = trim($thumbnail->attr['data-lazy-src']);
            //echo "Thumbnail: " . $raw_thumbnail . "<br>";
            echo "<img src='". $raw_thumbnail . "' width='150' />" . "<br>";
        }

        //address property
        $address = $data->find('.primaryLink strong', 0);
        if (!empty($address->innertext)) {
            $raw_address = trim($address->innertext);
            echo "Address: " . $raw_address . "<br>";
        }

        $price = $data->find('.txtR strong', 0);
        if (!empty($price->innertext)) {
            $raw_price = trim(str_replace('<i class="iconDown"></i>', '', $price->innertext));
            echo "Price: " . $raw_price . "<br>";
        }

        $mortgage_estimate = $data->find('.mortgageEstimate', 0);
        //var_dump($mortgage_estimate->innertext);
        if (!empty($mortgage_estimate->innertext)) {
            $raw_mortgage_estimate = trim($mortgage_estimate->innertext);
            echo "Mortgate Est: " . $raw_mortgage_estimate . "<br>";
        }

        $type = $data->find('.cols9 strong', 0);
        if (!empty($type->innertext)) {
            $raw_type = trim($type->innertext);
            echo "Type: " . $raw_type . "<br>";
        }

        $sqft = $data->find('.cols9 .mvn', 0);
        if (!empty($sqft->innertext)) {
            $raw_sqft = trim($sqft->innertext);
            echo "Sqft: " . $raw_sqft . "<br>";
        }

        $beds = $data->find('.cols4 strong', 0);
        if (!empty($beds->innertext)) {
            $raw_beds = trim($beds->innertext);
            echo "Beds: " . $raw_beds . "<br>";
        }

        $baths = $data->find('.cols4 .mvn', 0);
        if (!empty($baths->innertext)) {
            $raw_baths = trim($baths->innertext);
            echo "Baths: " . $raw_baths . "<br>";
        }

        $city_state_zip = $data->find('.cols6 .h7', 0);
        if (!empty($city_state_zip->innertext)) {
            $raw_city_state_zip = trim($city_state_zip->innertext);
            echo "City State Zip: " . $raw_city_state_zip . "<br>";
        }

        echo "<br>";


    }

}


