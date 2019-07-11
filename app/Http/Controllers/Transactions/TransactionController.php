<?php

namespace App\Http\Controllers\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\TransactionStoreRequest;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['jwt.verify']);
    }

    public function store(TransactionStoreRequest $request)
    {
        $amount = $request->amount;
        $phone = $request->user()->phone;
        $response = $this->getToken($amount, $phone);
        if(isset($response->status) && $response->status == '1') {
            $transaction = new Transaction();
            $transaction->amount = $request->amount;
            $transaction->token = $response->token;
            $transaction->save();
            return response()->json(['status' => 'success', 'message' => 'https://pay.ir/pg/'. $response->token], 201);
        }
        return response()->json('something went wrong', 400);
    }

    public function callback(Request $request)
    {
        if($request->status && $request->status == '1' && $request->token) {
            $transaction = Transaction::where('token', '=', $request->token)
            ->where('status', '!=', 1)
            ->where('verify_status', '!=', 1)
            ->first();

            if($transaction) {
                $response = $this->verify($transaction->token);
                if(isset($response->status) && $response->status == '1') {
                    $transaction->update([
                        'transaction_id' => $response->transId,
                        'card_number'    => $response->cardNumber,
                        'status'         => 1,
                        'verify_status'  => 1
                    ]);

                    //i can attach the order_id to transaction from here or something like that and update the pending to processing
                    return response()->json(['status' => 'success', 'message' => 'payment done'], 200);
                }
            }
            return response()->json(['status' => 'success', 'message' => 'transaction failed'], 400);
        }
    }

    private function getToken($amount, $phone) {
        $response = $this->curlPost('https://pay.ir/pg/send', [
            // 'api'          => env('PAYIR_API_KEY', 'YOUR-API-KEY'),
            'api'          => 'test',
            'amount'       => $amount,
            // 'redirect'     => url('/payir/callback'),
            'redirect'     => url('api/transactions/callback'),
            // 'resellerId'   => '1000000012',
            'mobile'       => $phone,
            // 'factorNumber' => $factorNumber,
            // 'description'  => $description,
        ]);
        return json_decode($response);
    }

    private function verify($token) {
        $response = $this->curlPost('https://pay.ir/pg/verify', [
            // 'api' 	=> env('PAYIR_API_KEY', 'YOUR-API-KEY'),
            'api' 	=> env('PAYIR_API_KEY', 'test'),
            'token' => $token,
        ]);

        return json_decode($response);
    }

    private function curlPost($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }
}
