<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-100">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Pesanan Saya</h2>

        <!-- Contoh kondisi jika tidak ada pesanan -->
        <!-- <p class="text-gray-600">Belum ada pesanan.</p> -->

        <!-- Contoh kondisi jika ada pesanan -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-green-200 text-left text-sm font-semibold text-gray-700">
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Menu</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b text-sm">
                            {{-- Tanggal --}}
                            <td class="p-3">
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>

                            {{-- Menu --}}
                            <td class="p-3">
                                @foreach($order->orderItems as $item)
                                    {{ $item->menu->name }}<br>
                                @endforeach
                            </td>

                            {{-- Jumlah --}}
                            <td class="p-3">
                                @foreach($order->orderItems as $item)
                                    {{ $item->quantity }}<br>
                                @endforeach
                            </td>

                            {{-- Total --}}
                            <td class="p-3">
                                @php
                                    $total = $order->orderItems->sum(function($item) {
                                        return $item->price * $item->quantity;
                                    });
                                @endphp
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </td>

                            {{-- Status --}}
                            <td class="p-3">
                                @if (!$order->is_confirmed)
                                    <span class="text-yellow-600 font-semibold">Menunggu Konfirmasi</span>
                                @elseif (!$order->is_ready)
                                    <span class="text-blue-600 font-semibold">Diproses</span>
                                @else
                                    <span class="text-green-600 font-semibold">Siap Diambil</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
