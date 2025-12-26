@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-4">
    <h1>Detail Pesanan #{{ $order->order_number }}</h1>

    <p>Status: {{ $order->status }}</p>
    <p>Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
    <a href="/" class="btn btn-primary">&laquo; Kembali ke Home</a>
</div>
@endsection
