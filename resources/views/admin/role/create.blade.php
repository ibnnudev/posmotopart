<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Manajemen Hak Akses', 'url' => route('admin.role.index')],
        ['name' => 'Tambah', 'url' => ''],
    ]" title="Tambah Hak Akses" />

    <x-card-container>
        <form action="{{ route('admin.role.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <h3 class=" font-medium text-base">Informasi Hak Akses</h3>
                <div class="space-y-6">
                    <div class="lg:w-1/3 xl:w-1/3">
                        <x-input id="name" label="Nama" name="name" required />
                    </div>
                    <div>
                        <p>Permission</p>
                        <div class="grid max-md:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6 xl:grid-cols-4">
                            @foreach ($permissions as $permission)
                                {{-- checkbox --}}
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" name="permissions[]" id="{{ $permission->name }}"
                                        value="{{ $permission->name }}" class="checkbox checkbox-primary">
                                    <label
                                        for="{{ $permission->name }}">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="max-md:w-1/2 md:w-1/2 lg:w-1/6 xl:w-1/6 pt-5 ml-auto">
                        <x-button type="submit" class="mt-6">Tambah Hak Akses</x-button>
                    </div>
                </div>
            </div>
        </form>
    </x-card-container>
</x-app-layout>
