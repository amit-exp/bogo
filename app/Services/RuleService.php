<?php
namespace App\Services;

class RuleService{

    //Offer Rile 1: Customers can buy one product and get another product for free as long as 
    //the price of the product is equal to or less than the price of the first product. 
    public static function offerRule1($prices){
        // Sort the prices array in descending order
        rsort($prices);
        $discountedItems = [];
        $payableItems = [];

        while (!empty($prices)) {
            $payableItem = array_shift($prices);
            $payableItems[] = $payableItem;

            // Find the free item
            foreach ($prices as $key => $price) {
                if ($price <= $payableItem) {
                    $discountedItems[] = $price;
                    unset($prices[$key]);
                    // Re-index array
                    $prices = array_values($prices);
                    break;
                }
            }
        }

        return [
            'discountedItems' => $discountedItems,
            'payableItems' => $payableItems
        ];
    }

    //Offer Rule 2:  Customers can buy one product and get another product for free as long as the price of the product is less than the price of the corresponding product in pairs. 
    public static function offerRule2($prices){
        rsort($prices);
    
        $discountedItems = [];
        $payableItems = [];

        while (!empty($prices)) {
            $payableItem = array_shift($prices);
            $payableItems[] = $payableItem;

            // Find the free item
            foreach ($prices as $key => $price) {
                if ($price < $payableItem) {
                    $discountedItems[] = $price;
                    unset($prices[$key]);
                    // Re-index array 
                    $prices = array_values($prices);
                    break;
                }
            }
        }

        return [
            'discountedItems' => $discountedItems,
            'payableItems' => $payableItems
        ];
    }

    //Offer Rule 3:  Customers can buy two products and get two products for free as long as the price of the product is less than the price of the first product. 
    public static function offerRule3($prices){
        rsort($prices);
    
        $discountedItems = [];
        $payableItems = [];

        while (!empty($prices)) {
            $payableItem1 = array_shift($prices);
            $payableItem2 = array_shift($prices);
            $payableItems[] = $payableItem1;
            $payableItems[] = $payableItem2;

            // Find the free item
            $freeItemsCount = 0;
            foreach ($prices as $key => $price) {
                if ($freeItemsCount < 2 && $price < $payableItem1 && $price < $payableItem2) {
                    $discountedItems[] = $price;
                    unset($prices[$key]);
                    $freeItemsCount++;
                }
                if ($freeItemsCount == 2) {
                    break;
                }
            }
            // Re-index array 
            $prices = array_values($prices);
        }

        return [
            'discountedItems' => $discountedItems,
            'payableItems' => $payableItems
        ];
    }

    public static function getMaximumDiscount($offer1,$offer2,$offer3){
        //get sum of discounts of each offers.
        $discounts=[
            'Offer 1'=>array_sum($offer1['discountedItems']),
            'Offer 2'=>array_sum($offer2['discountedItems']),
            'Offer 3'=>array_sum($offer3['discountedItems'])
        ];
        $maxValue = max($discounts);
        $keysWithMaxValue = array_keys($discounts, $maxValue);
        
        return "Offer name:".implode(',',$keysWithMaxValue)." MaxDiscount:".$maxValue;
    }
}
