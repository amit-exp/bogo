<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RuleService;

class BogoController extends Controller
{
    public function calculateDiscounts(Request $request){
        $prices=$request->input('prices');
        $prices=explode(',',$prices);

        $collectData=[];

        $offer1=RuleService::offerRule1($prices);
        $offer2=RuleService::offerRule2($prices);
        $offer3=RuleService::offerRule3($prices);

        $collectData['Offer 1']=$offer1;
        $collectData['Offer 2']=$offer2;
        $collectData['Offer 3']=$offer3;

        $collectData['Maximum Discount']=RuleService::getMaximumDiscount($offer1,$offer2,$offer3);

        return response()->json(['Discounts'=>$collectData]);
    }
}
