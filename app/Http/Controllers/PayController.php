<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function index()
    {
        return view('event');
    }
    public function pay(Request $request)
    {

        $apiKey = config('services.instamojo.api_key');
        $authToken = config('services.instamojo.auth_token');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key: $apiKey",
                "X-Auth-Token: $authToken"
            )
        );
        $payload = array(
            'purpose' => $request->purpose,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'buyer_name' => $request->username,
            'redirect_url' => 'http://instamojo.dev/redirect/',
            'send_email' => true,
            'webhook' => 'http://instamojo.dev/webhook/',
            'send_sms' => true,
            'email' => $request->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);

        $requestCreated = json_decode($response, true);
        // dd($requestCreated['payment_request']['longurl']);
        $redirectURL = $requestCreated['payment_request']['longurl'];
        return redirect($redirectURL);
    }

    public function success(Request $request)
    {
    }
}
