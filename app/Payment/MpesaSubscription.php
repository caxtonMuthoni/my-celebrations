<?php

namespace App\Payment;

use App\Models\Subscriber;
use App\Models\Transaction;

class MpesaSubscription
{

    public function stkPush(string $phonenumber, int $amount)
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = $amount;
        $PartyA = $phonenumber;
        $PartyB = '174379';
        $PhoneNumber = $phonenumber;
        $CallBackURL = 'http://mycelebrationbooks.com/api/billing/callback/mpesa';
        $AccountReference = 'MyCelebrationBooks.com';
        $TransactionDesc = 'Subscription';
        $Remarks = 'Plan Subscription';
        $stkPushSimulation = $mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );
        return json_decode($stkPushSimulation);
    }


    public function callback()
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $callbackData = json_decode($mpesa->getDataFromCallback());
        $resultCode = $callbackData->Body->stkCallback->ResultCode;
        $marchantId =  $callbackData->Body->stkCallback->MerchantRequestID;
        $checkoutId =  $callbackData->Body->stkCallback->CheckoutRequestID;

        if ($resultCode == 0) {
            $items = $callbackData->Body->stkCallback->CallbackMetadata->Item;

            $transactionId = '';
            foreach ($items as $item) {
                if ($item->Name == "MpesaReceiptNumber") {
                    $transactionId = $item->Value;
                }
            }

            $transaction = Transaction::where([['MerchantRequestID', $marchantId], ['CheckoutRequestID', $checkoutId]])->first();
            $transaction->is_complete = true;
            $transaction->transaction_id = $transactionId;
            $transaction->result = $callbackData->Body->stkCallback->ResultDesc;
            $transaction->save();

            $subscriber = new Subscriber();
            $subscriber->user_id = $transaction->user_id;
            $subscriber->subscription_plan_id = $transaction->subscription_plan_id;
            $subscriber->is_active = true;
            $subscriber->save();
        } else {
            $transaction = Transaction::where([['MerchantRequestID', $marchantId], ['CheckoutRequestID', $checkoutId]])->first();
            $transaction->is_complete = false;
            $transaction->result = $callbackData->Body->stkCallback->ResultDesc;
            $transaction->save();
        }


    }
}

// Callback Datas
// {
//     "Body": {
//         "stkCallback": {
//             "MerchantRequestID": "57066-37095598-2",
//             "CheckoutRequestID": "ws_CO_10052022140550425743751575",
//             "ResultCode": 1019,
//             "ResultDesc": "Transaction has expired"
//         }
//     }
// }
