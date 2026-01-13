<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\SalesReportExport;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * ================================
     * LAPORAN PENJUALAN
     * ================================
     * Fitur:
     * 1. Filter Rentang Tanggal
     * 2. Summary Statistik
     * 3. Grafik Penjualan Harian
     * 4. Analitik Penjualan per Kategori
     * 5. Tabel Transaksi (Pagination)
     */
    public function sales(Request $request)
    {
        /**
         * 1️⃣ DEFAULT DATE RANGE
         * Jika user tidak memilih tanggal,
         * otomatis gunakan BULAN BERJALAN
         */
        $dateFrom = $request->date_from ?? now()->startOfMonth()->toDateString();
        $dateTo   = $request->date_to ?? now()->toDateString();

        /**
         * 2️⃣ TRANSAKSI DETAIL (TABLE)
         * Menggunakan paginate agar aman
         */
        $orders = Order::with(['items', 'user'])
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->where('payment_status', 'paid')
            ->latest()
            ->paginate(20);

        /**
         * 3️⃣ SUMMARY STATISTIK
         * Total order & total pendapatan
         */
        $summary = Order::whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->where('payment_status', 'paid')
            ->selectRaw('
                COUNT(*) as total_orders,
                SUM(total_amount) as total_revenue
            ')
            ->first();

        /**
         * 4️⃣ ANALITIK PER KATEGORI
         * Join: order_items → orders → products → categories
         */
        $byCategory = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->whereDate('orders.created_at', '>=', $dateFrom)
            ->whereDate('orders.created_at', '<=', $dateTo)
            ->where('orders.payment_status', 'paid')
            ->groupBy('categories.id', 'categories.name')
            ->select(
                'categories.name',
                DB::raw('SUM(order_items.subtotal) as total')
            )
            ->orderByDesc('total')
            ->get();

        /**
         * 5️⃣ GRAFIK PENJUALAN HARIAN
         * Digunakan oleh Chart.js
         */
        $chartData = Order::whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->where('payment_status', 'paid')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        /**
         * Siapkan data untuk Chart.js
         */
        $chartLabels = $chartData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        });

        $chartValues = $chartData->pluck('total');

        /**
         * 6️⃣ RETURN VIEW
         */
        return view('admin.reports.sales', compact(
            'orders',
            'summary',
            'byCategory',
            'dateFrom',
            'dateTo',
            'chartLabels',
            'chartValues'
        ));
    }

    /**
     * ================================
     * EXPORT EXCEL
     * ================================
     */
    public function exportSales(Request $request)
    {
        $dateFrom = $request->date_from ?? now()->startOfMonth()->toDateString();
        $dateTo   = $request->date_to ?? now()->toDateString();

        return Excel::download(
            new SalesReportExport($dateFrom, $dateTo),
            "laporan-penjualan-{$dateFrom}-sd-{$dateTo}.xlsx"
        );
    }
}
