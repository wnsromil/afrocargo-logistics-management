<?php

// app/Http/Controllers/StripeWebhookController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\StripeTransaction;

class StripeWebhookController extends Controller
{
   public function handleWebhook(Request $request)
{
    $payload = $request->all();

    if (isset($payload['type'])) {
        $data = $payload['data']['object'];

        // Detect payment method name
        $paymentMethod = null;
        $methodOptions = $data['payment_method_options'] ?? [];
        foreach ($methodOptions as $method => $value) {
            if (!empty($value)) {
                $paymentMethod = $method;
                break;
            }
        }

        StripeTransaction::create([
            'transaction_id' => $data['id'],
            'amount'         => $data['amount'] / 100,
            'currency'       => $data['currency'],
            'status'         => $data['status'],
            'email'          => $data['receipt_email'] ?? null,
            'payment_method' => $paymentMethod, // 👈 yahi value store hogi like "card"
            'user_id'        => $data['metadata']['user_id'] ?? null,
            'raw_data'       => json_encode($data),
        ]);
    }

    return response()->json(['status' => 'success']);
}

}
