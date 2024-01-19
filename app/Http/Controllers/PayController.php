<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PayController extends Controller
{
    private $apiKey;
    private $authToken;

    public function __construct()
    {
        $this->apiKey = config('services.instamojo.api_key');
        $this->authToken = config('services.instamojo.auth_token');
    }

    public function index()
    {
        return view('event');
    }
    public function pay(Request $request)
    {




        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://api.instamojo.com/v2/payment_requests/');
        // curl_setopt($ch, CURLOPT_HEADER, FALSE);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        // curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer CfQ2BbE0YoCGTeQc2QBmsbT3coibIMBi34D6uJ7vtus.hVomwTdCiQIk8NJ_j8ejnh0tS8SjaZR1E2NO89oJn1o'));

        // $payload = Array(
        //   'purpose' => 'FIFA 16',
        //   'amount' => '1',
        //   'buyer_name' => 'John Doe',
        //   'email' => 'foo@example.com',
        //   'phone' => '9999999999',
        //   'redirect_url' => 'http://www.example.com/redirect/',
        //   'send_email' => 'True',
        //   'webhook' => 'http://www.example.com/webhook/',
        //   'allow_repeated_payments' => 'False',
        // );

        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        // $response = curl_exec($ch);
        // if (curl_errno($ch)) {
        //     dd(curl_error($ch));
        //     // $error_msg = curl_error($ch);
        // }
        // curl_close($ch);


        // dd($response);


        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        // curl_setopt($ch, CURLOPT_HEADER, FALSE);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        // curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer CfQ2BbE0YoCGTeQc2QBmsbT3coibIMBi34D6uJ7vtus.hVomwTdCiQIk8NJ_j8ejnh0tS8SjaZR1E2NO89oJn1o'));
        // curl_setopt(
        //     $ch,
        //     CURLOPT_HTTPHEADER,
        //     array(
        //         "X-Api-Key:$this->apiKey",
        //         "X-Auth-Token:$this->authToken"
        //     )
        // );
        // $payload = array(
        //     'purpose' => $request->purpose,
        //     'amount' => $request->amount,
        //     'phone' => $request->phone,
        //     'buyer_name' => $request->username,
        //     'redirect_url' => 'http://127.0.0.1:8000/redirect/',
        //     'send_email' => true,
        //     'webhook' => 'http://127.0.0.1:8000/webhook/',
        //     'send_sms' => true,
        //     'email' => $request->email,
        //     'allow_repeated_payments' => false
        // );
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        // $response = curl_exec($ch);
        // if (curl_errno($ch)) {
        //     dd(curl_error($ch));
        //     // $error_msg = curl_error($ch);
        // }
        // curl_close($ch);

        // $requestCreated = json_decode($response, true);
        // dd($requestCreated);
        // // dd($requestCreated['payment_request']['longurl']);
        // $redirectURL = $requestCreated['payment_request']['longurl'];
        // return redirect($redirectURL);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        // curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer CfQ2BbE0YoCGTeQc2QBmsbT3coibIMBi34D6uJ7vtus.hVomwTdCiQIk8NJ_j8ejnh0tS8SjaZR1E2NO89oJn1o'));
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:$this->apiKey",
                "X-Auth-Token:$this->authToken"
            )
        );
        $payload = array(
            'purpose' => $request->purpose,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'buyer_name' => $request->username,
            'redirect_url' => route('success'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => $request->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);
        // $response = $response['payment_request']['longurl'];
        // return redirect($redirectURL);
        if ($response->success == true) {
            return redirect($response->payment_request->longurl);
        } else {
            return "Payment is Failed";
        }
    }

    public function success(Request $request)
    {
        // // dd($request->all());
        if (env('IM_ENVIRONMENT') == 'sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/payments/' . $request->payment_id;
        } else {
            $url = 'https://test.instamojo.com/api/1.1/payments/';
        }

        $url = env('IM_ENVIRONMENT') == 'sandbox' ?
            'https://test.instamojo.com/api/1.1/payments/' . $request->payment_id :
            'https://api.instamojo.com/v2/payments/' . $request->payment_id;

        if (isset($request->payment_id) && $request->payment_id != null) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://test.instamojo.com/api/1.1/payments/" . $request->payment_id);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            // curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer CfQ2BbE0YoCGTeQc2QBmsbT3coibIMBi34D6uJ7vtus.hVomwTdCiQIk8NJ_j8ejnh0tS8SjaZR1E2NO89oJn1o'));
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    "X-Api-Key:$this->apiKey",
                    "X-Auth-Token:$this->authToken"
                )
            );
            $response = curl_exec($ch);
            $err = curl_error($ch);
            if ($err) {
                // Session::put('error', 'Payment Failed, Try Again!!');
                return redirect()->route('index')->with('error', 'Payment Failed, Try Again!!');
            } else {
                $response = json_decode($response);
            }
            if ($response->success == true) {
                if ($response->payment->status == 'Credit') {

                    // Session::put('success', 'Your payment has been pay successfully, Enjoy!!');
                    return redirect()->route('index')->with('success', 'Your payment has been pay successfully, Enjoy!!');
                } else {
                    Session::put('error', 'Payment Failed, Try Again!!');
                    return redirect()->route('index')->with('error', 'Payment Failed, Try Again!!');
                }
            } else {
                // Session::put('error', 'Payment Failed, Try Again!!');
                return redirect()->route('index')->with('error', 'Payment Failed, Try Again!!');
            }
        }
    }
    public function requests()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:$this->apiKey",
                "X-Auth-Token:$this->authToken"
            )
        );
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        // dd($response);
        return view('requestsList', compact('response'));
    }

    public function rd(Request $request)
    {
        // dd($request->all());
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://test.instamojo.com/api/1.1/payment-requests/{$request->id}/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-Api-Key: $this->apiKey",
                "X-Auth-Token: $this->authToken",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response);
        // dd($response);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            dd($response);
            return view('payDetails',compact('response'));
        }
    }
}
