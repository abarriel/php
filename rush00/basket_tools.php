<?php
function get_items($item)
{
	$articles_pattern = "data/articles";
	$articles = unserialize(file_get_contents($articles_pattern));
	foreach ($articles as $key => $value) {
			if($value['name'] == $item)
			{
				$basket = $value;
				$_SESSION['basket'][] = $basket;
				break;
			}
		}
}

function count_items_price($items)
{
	$price = 0;
	foreach ($items as $key => $value) {
		$price += $value['price'];
	}
	return($price);
}
?>