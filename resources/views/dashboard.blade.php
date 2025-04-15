<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Statistik</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                        <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold">Total Menu</h4>
                            <p class="text-2xl">{{ $totalMenu }}</p>
                        </div>
                        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold">Total Pesanan</h4>
                            <p class="text-2xl">{{ $totalOrders }}</p>
                        </div>
                        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold">Pesanan Diproses</h4>
                            <p class="text-2xl">{{ $ordersProcessed }}</p>
                        </div>
                        <div class="bg-purple-500 text-white p-4 rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold">Pesanan Selesai</h4>
                            <p class="text-2xl">{{ $ordersCompleted }}</p>
                        </div>
                    </div>

                    <!-- Tabel Pesanan -->
                    <div class="mt-10">
                        <h3 class="text-lg font-bold mb-4">Daftar Pesanan</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 text-sm">
                                        <th class="border p-2">Nama User</th>
                                        <th class="border p-2">Menu</th>
                                        <th class="border p-2">Jumlah</th>
                                        <th class="border p-2">Total Harga</th>
                                        <th class="border p-2">Status</th>
                                        <th class="border p-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="text-center text-sm border-b">
                                            <td class="border p-2">{{ $order->user->name }}</td>
                                            <td class="border p-2">
                                                @foreach ($order->orderItems as $item)
                                                    {{ $item->menu->name }}<br>
                                                @endforeach
                                            </td>
                                            <td class="border p-2">
                                                @foreach ($order->orderItems as $item)
                                                    {{ $item->quantity }}<br>
                                                @endforeach
                                            </td>
                                            <td class="border p-2">
                                                @php
                                                    $total = 0;
                                                    foreach ($order->orderItems as $item) {
                                                        $total += $item->menu->price * $item->quantity;
                                                    }
                                                @endphp
                                                Rp {{ number_format($total, 0, ',', '.') }}
                                            </td>
                                            <td class="border p-2">
                                                @if ($order->is_confirmed)
                                                    <span class="text-green-600 font-semibold">Terkonfirmasi</span>
                                                @else
                                                    <span class="text-red-600 font-semibold">Belum Dikonfirmasi</span>
                                                @endif
                                            </td>
                                            <td class="border p-2">
                                                @if (!$order->is_confirmed)
                                                    <form method="POST" action="{{ route('admin.order.confirm', $order->id) }}">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                                            Konfirmasi
                                                        </button>
                                                    </form>
                                                @else
                                                    @if (!$order->is_ready)
                                                        <form method="POST" action="{{ route('admin.order.ready', $order->id) }}">
                                                            @csrf
                                                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">
                                                                Tandai Selesai
                                                            </button>
                                                        </form>
                                                    @else
                                                        <div class="flex justify-center items-center space-x-2">
                                                            <span class="text-blue-600 font-semibold text-sm">Sudah Siap Diambil</span>
                                                            <form method="POST" action="{{ route('admin.order.delete', $order->id) }}" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
