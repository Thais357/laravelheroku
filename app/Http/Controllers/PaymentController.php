<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use SevenGps\PayUnit;

class PaymentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function payment (Request $request) {

        $amount = $request->get('amount');

        //Generate shuffle alphanumeric id
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $id = substr(str_shuffle($permitted_chars), 0, 10);;

        $myPayment = new PayUnit(
            "sand_gdQ7gzdHU8fP1WXYno3rAml4TAixeW",
            "8bee6bd0-49ac-4656-978a-3b6bc2e4c76a",
            "1d157092-2c8f-410a-8d9d-cede0ae915ca",
            "http://127.0.0.1:8000/status",
            "http://192.168.100.10/seven-payunit-sandbox/sandbox/notify",
            "test",
            "description",
            "purchaseRef",
            "USD",
            "name",
            $id
        );

        $myPayment->makePayment($amount);
    }
}
