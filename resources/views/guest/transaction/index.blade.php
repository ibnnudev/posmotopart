<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Riwayat Transaksi', 'url' => route('transaction.index')],
    ]" />

    <x-card-container></x-card-container>
</x-app-layout>
