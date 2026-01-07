<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Notification;

class PaymentCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $notif = new Notification();

        \Log::info('MIDTRANS WEBHOOK MASUK', (array) $notif);

        // ⚠️ HARUS SAMA DENGAN YANG DIKIRIM KE SNAP
        $order = Order::where('order_number', $notif->order_id)->first();

        if (!$order) {
            \Log::error('ORDER TIDAK DITEMUKAN', [
                'order_id' => $notif->order_id
            ]);
            return response()->json(['error' => 'Order not found'], 404);
        }

        if (in_array($notif->transaction_status, ['capture', 'settlement'])) {
            $order->update([
                'payment_status' => 'paid',
                'status'         => 'processing',
            ]);
        } elseif ($notif->transaction_status === 'pending') {
            $order->update([
                'payment_status' => 'pending',
            ]);
        } else {
            $order->update([
                'payment_status' => 'failed',
                'status'         => 'cancelled',
            ]);
        }

        return response()->json(['message' => 'OK']);
    }
}
