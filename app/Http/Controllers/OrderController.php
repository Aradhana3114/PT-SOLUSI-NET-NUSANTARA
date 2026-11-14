<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function create(Request $request, Service $service): View
    {
        abort_unless($service->is_active, 404);

        return view('orders.create', compact('service'));
    }

    public function store(Request $request, Service $service): RedirectResponse
    {
        abort_unless($service->is_active, 404);

        $data = $request->validate([
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:1000'],
            'customer_notes' => ['nullable', 'string', 'max:1000'],
            'payment_proof' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $data['payment_proof'] = $request->file('payment_proof')->store('payment-proofs', 'public');

        $price = $service->monthly_fee ?: $service->price;
        abort_if(blank($price), 422, 'Layanan belum memiliki harga.');

        $order = Order::create([
            ...$data,
            'user_id' => $request->user()->id,
            'order_number' => 'ORD-'.now()->format('YmdHis').'-'.Str::upper(Str::random(4)),
            'total_amount' => $price,
        ]);

        $order->items()->create([
            'service_id' => $service->id,
            'service_name' => $service->name,
            'price' => $price,
            'subtotal' => $price,
        ]);

        return redirect()->route('services')->with('success', 'Pesanan berhasil dibuat. Admin akan menghubungi Anda.');
    }
}
