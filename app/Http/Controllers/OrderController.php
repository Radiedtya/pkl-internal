<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->orders()
            ->with(['items.product'])
            ->latest();

        // 🔍 SEARCH NAMA PRODUK
        if ($request->filled('q')) {
            $query->whereHas('items.product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%');
            });
        }

        // 🏷️ FILTER STATUS (3 DOANG)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query
            ->paginate(10)
            ->withQueryString();

        // 🔢 HITUNG STATUS (buat badge)
        $counts = auth()->user()->orders()
            ->selectRaw('status, COUNT(*) as total')
            ->whereIn('status', ['pending','processing','completed'])
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('orders.index', compact('orders','counts'));
    }

    // ❌ show() TIDAK DIUBAH
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $snapToken = $order->snap_token;

        if ($order->status === 'pending' && !$snapToken) {

            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total_amount,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => $order->shipping_phone,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token'=>$snapToken]);
        }

        $order->load(['items.product','items.product.primaryImage']);

        return view('orders.show', compact('order','snapToken'));
    }
}
