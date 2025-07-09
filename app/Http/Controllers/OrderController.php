<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Order;
use App\Models\OrderItem;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    // Backend Order Management Functions
    public function index()
    {
        // Hanya tampilkan order yang sudah dibayar atau status di atasnya
        $statuses = ['Paid', 'processing', 'shipped', 'delivered', 'cancelled'];
        $orders = Order::with(['customer.user'])
            ->whereIn('status', $statuses)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('backend.v_order.index', [
            'judul' => 'Data Order',
            'orders' => $orders
        ]);
    }

    public function edit($id)
    {
        $order = Order::with(['customer.user', 'orderItems.produk'])->findOrFail($id);
        return view('backend.v_order.edit', [
            'judul' => 'Edit Order',
            'order' => $order
        ]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $validatedData = $request->validate([
            'status' => 'required|in:pending,Paid,processing,shipped,delivered,cancelled',
            'noresi' => 'nullable|string|max:255',
        ]);

        $order->update($validatedData);
        
        return redirect()->route('backend.order.index')->with('success', 'Status order berhasil diperbarui');
    }

    public function show($id)
    {
        $order = Order::with(['customer.user', 'orderItems.produk'])->findOrFail($id);
        return view('backend.v_order.show', [
            'judul' => 'Detail Order',
            'order' => $order
        ]);
    }

    // Method untuk Form Laporan Order
    public function formOrder()
    {
        return view('backend.v_order.form', [
            'judul' => 'Form Laporan Order'
        ]);
    }

    // Method untuk Cetak Laporan Produk
    public function cetakOrder(Request $request)
    {
        // Menambahkan aturan validasi
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ], [
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
        ]);
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $query = Order::with(['customer.user'])
            ->whereBetween('updated_at', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('id', 'desc');
        $order = $query->get();
        return view('backend.v_order.cetak', [
            'judul' => 'Laporan Order',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $order
        ]);
    }

    // Method untuk Form Laporan Order berdasarkan Status
    public function formOrderByStatus()
    {
        return view('backend.v_order.form_status', [
            'judul' => 'Form Laporan Order Berdasarkan Status'
        ]);
    }

    // Method untuk Cetak Laporan Order berdasarkan Status
    public function cetakOrderByStatus(Request $request)
    {
        // Menambahkan aturan validasi
        $request->validate([
            'status' => 'required|in:pending,Paid,processing,shipped,delivered,cancelled',
            'tanggal_awal' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
        ], [
            'status.required' => 'Status order harus dipilih.',
            'status.in' => 'Status order tidak valid.',
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
        ]);

        $status = $request->input('status');
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = Order::with(['customer.user', 'orderItems.produk'])
            ->where('status', $status);

        // Jika tanggal diisi, tambahkan filter tanggal
        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        // Hitung total
        $totalOrder = $orders->count();
        $totalHarga = $orders->sum('total_harga');

        return view('backend.v_order.cetak_status', [
            'judul' => 'Laporan Order Berdasarkan Status',
            'status' => $status,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'orders' => $orders,
            'totalOrder' => $totalOrder,
            'totalHarga' => $totalHarga
        ]);
    }

    public function addToCart($id)
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        $produk = Produk::findOrFail($id);
        $order = Order::firstOrCreate(
            ['customer_id' => $customer->id, 'status' => 'pending'],
            ['total_harga' => 0]
        );
        $orderItem = OrderItem::firstOrCreate(
            ['order_id' => $order->id, 'produk_id' => $produk->id],
            ['quantity' => 1, 'harga' => $produk->harga]
        );
        if (!$orderItem->wasRecentlyCreated) {
            $orderItem->quantity++;
            $orderItem->save();
        }
        $order->total_harga += $produk->harga;
        $order->save();
        return redirect()->route('order.cart')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function viewCart()
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        $order = Order::where('customer_id', $customer->id)->where('status', 'pending', 'paid')->first();
        if ($order) {
            $order->load('orderItems.produk');
        }
        return view('v_order.cart', compact('order'));
    }

    public function updateCart(Request $request, $id)
    {
        $customer = Customer::where('user_id', Auth::id())->first();;;
        $order = Order::where('customer_id', $customer->id)->where('status', 'pending')->first();
        if ($order) {
            $orderItem = $order->orderItems()->where('id', $id)->first();
            if ($orderItem) {
                $quantity = $request->input('quantity');
                if ($quantity > $orderItem->produk->stok) {
                    return redirect()->route('order.cart')->with('error', 'Jumlah produk melebihi stok yang tersedia');
                }
                $order->total_harga -= $orderItem->harga * $orderItem->quantity;
                $orderItem->quantity = $quantity;
                $orderItem->save();
                $order->total_harga += $orderItem->harga * $orderItem->quantity;
                $order->save();
            }
        }
        return redirect()->route('order.cart')->with('success', 'Jumlah produk berhasil diperbarui');
    }
    public function removeFromCart(Request $request, $id)
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        $order = Order::where('customer_id', $customer->id)->where('status', 'pending')->first();
        if ($order) {
            $orderItem = OrderItem::where('order_id', $order->id)->where('produk_id', $id)->first();
            if ($orderItem) {
                $order->total_harga -= $orderItem->harga * $orderItem->quantity;
                $orderItem->delete();
                if ($order->total_harga <= 0) {
                    $order->delete();
                } else {
                    $order->save();
                }
            }
        }
        return redirect()->route('order.cart')->with('success', 'Produk berhasil dihapus dari keranjang');
    }
    public function selectShipping(Request $request)
    {
        // Mendapatkan customer berdasarkan user yang login
        $customer = Customer::where('user_id', Auth::id())->first();
        // Pastikan order dengan status 'pending' ada untuk customer ini
        $order = Order::where('customer_id', $customer->id)->where('status', 'pending')->first();
        // Cek apakah order ada
        if (!$order) {
            return redirect()->route('order.cart')->with('error', 'Keranjang belanja kosong.');
        }
        // Pastikan orderItems sudah dimuat menggunakan eager loading
        $order->load('orderItems.produk');
        // Lanjutkan ke view jika order ada
        return view('v_order.select_shipping', compact('order'));
    }
    public function updateOngkir(Request $request)
    {
        $customer = Customer::where('user_id', Auth::id())->first();
        $order = Order::where('customer_id', $customer->id)->where('status', 'pending')->first();
        $origin = $request->input('city_origin'); // kode kota asal
        $originName = $request->input('city_origin_name'); // nama kota asal
        if ($order) {
            // Simpan data ongkir ke dalam order
            $order->kurir = $request->input('kurir');
            $order->layanan_ongkir = $request->input('layanan_ongkir');
            $order->biaya_ongkir = $request->input('biaya_ongkir');
            $order->estimasi_ongkir = $request->input('estimasi_ongkir');
            $order->total_berat = $request->input('total_berat');
            $order->alamat = $request->input('alamat') . ', <br>' . $request->input('city_name') . ', <br>' . $request->input('province_name');
            $order->pos = $request->input('pos');
            $order->save();
            // Simpan ke session flash agar bisa diakses di halaman tujuan
            return redirect()->route('order.selectpayment')
                ->with('origin', $origin)
                ->with('originName', $originName);
        }
        return back()->with('error', 'Gagal menyimpan data ongkir');
    }
    public function selectPayment()
    {
        // Mendapatkan customer yang login
        $customer = Auth::user();
        // Cari order dengan status 'pending'
        $order = Order::where('customer_id', $customer->customer->id)->where(
            'status',
            'pending'
        )->first();
        $origin = session('origin'); // Kode kota asal
        $originName = session('originName'); // Nama kota asal
        // Jika order tidak ditemukan, tampilkan error
        if (!$order) {
            return redirect()->route('order.cart')->with('error', 'Keranjang belanja kosong.');
        }
        // Muat relasi orderItems dan produk terkait
        $order->load('orderItems.produk');
        // Hitung total harga produk
        $totalHarga = 0;
        foreach ($order->orderItems as $item) {
            $totalHarga += $item->harga * $item->quantity;
        }

        // Prepare Midtrans transaction details
        $transaction_details = [
            'order_id' => 'ORDER-' . $order->id . '-' . time(),
            'gross_amount' => $totalHarga + $order->biaya_ongkir
        ];

        $customer_details = [
            'first_name' => $customer->nama,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'billing_address' => [
                'address' => $order->alamat,
                'city' => $order->city_name,
                'postal_code' => $order->pos
            ]
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details
        ];

        try {
            // Get Snap Payment Page URL
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat token pembayaran: ' . $e->getMessage());
        }

        // Kirim data order dan snapToken ke view
        return view('v_order.select_payment', [
            'order' => $order,
            'origin' => $origin,
            'originName' => $originName,
            'snapToken' => $snapToken
        ]);
    }
    public function complete() // Untuk kondisi local
    {
        // Dapatkan customer yang login
        $customer = Auth::user();
        // Cari order dengan status 'pending' milik customer tersebut
        $order = Order::where('customer_id', $customer->customer->id)
            ->where('status', 'pending')
            ->first();
        if ($order) {
            // Update status order menjadi 'Paid'
            $order->status = 'Paid';
            $order->save();
        }
        // Redirect ke halaman riwayat dengan pesan sukses
        return redirect()->route('order.history')->with('success', 'Checkout berhasil');
    }
    public function orderHistory()
    {
        $statuses = ['Paid', 'processing', 'shipped', 'delivered', 'cancelled'];
        $orders = Order::with(['customer.user'])
            ->whereIn('status', $statuses)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('v_order.history', compact('orders'));
    }

    public function invoiceFrontend($id)
    {
        $order = Order::findOrFail($id);
        return view('v_order.invoice', [
            'judul' => 'Pesanan',
            'subJudul' => 'Pesanan Proses',
            'judul' => 'Data Transaksi',
            'order' => $order,
        ]);
    }
}
