<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    
    public function pay(){
        return view('pay');
    }


    public function make_payment(){
        $formData = [
            'user_id' => request('user_id'),
            'aff_id' => request('aff_id'),
            'product_id' => request('product_id'),
            'amount' => request('amount') * 100,
            'email' => request('email'),
            'currency' => request('currency'),
            'callback_url' => route('callback') 
        ];

        $pay = json_decode($this->initialize_payment($formData));
        if($pay){
            if($pay->status){
                return redirect($pay->data->authorization_url);
            }else{
                return back()->withErrors($pay->message);
            }
        }else{
            return back()->withErrors('Something is wrong');
        }

    }


    public function initialize_payment($formData){
        $url ="https://api.paystack.co/transaction/initialize";
        $fields_string = http_build_query($formData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
            "Cache-Control: no-cache"
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function payment_callback(){
        $response = json_decode($this->verify_payment(request('reference')));  
        if($response){
            if($response->status){
                return view('callback-page');
            }elseif ($response->status == "pending") {
                return back()->withErrors($response->message);    
            }elseif ($response->status == "failed") {
                return back()->withErrors($response->message);
            }
            else{
                return back()->withErrors($response->message);
            }
        }else{
            return back()->withErrors('Something is wrong');
        }


    }

    public function verify_payment($reference){
        $curl = curl_init();
        curl_setopt_array($curl,array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
                "Cache-Control: no-cache"
            )
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
