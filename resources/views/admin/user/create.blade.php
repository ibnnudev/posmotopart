<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Manajemen Pengguna', 'url' => route('admin.user.index')],
        ['name' => 'Tambah', 'url' => '#'],
    ]" title="Tambah Pengguna" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.user.store') }}" method="post">
                @csrf
                <div class="space-y-6 mb-6">
                    <x-input id="name" label="Nama" name="name" required />
                    <div class="grid grid-cols-2 gap-6">
                        <x-input id="email" label="Email" name="email" required />
                        <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number" required />
                    </div>
                    <div>
                        <p>Hak Akses</p>
                        <div class="flex flex-wrap gap-6 mt-2">
                            <select id="roles"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-300 block w-full p-2.5"
                                name="role">
                                @foreach ($roles as $role)
                                    @if ($role->name == 'admin')
                                        @continue
                                    @endif
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <x-footer-form isLeft="true" backLink="{{ route('admin.user.index') }}" />
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script></script>
    @endpush
</x-app-layout>
