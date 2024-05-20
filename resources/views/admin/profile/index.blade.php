@role('admin|seller')
    <x-app-layout>
        @role('admin|seller')
            <x-breadcrumb :links="[['name' => 'Dashboard', 'url' => route('admin.dashboard')], ['name' => 'Profil', 'url' => '#']]" />
        @endrole
        @role('buyer')
            <x-breadcrumb :links="[['name' => 'Profil', 'url' => '#']]" />
        @endrole
        <x-card-container>
            <div>
                <div class="md:flex items-center justify-between gap-2">
                    <h1 class="font-medium text-md">Informasi Pengguna</h1>
                    <div>
                        <x-link-button href="#" title="Ubah" id="updateProfileButton" />
                    </div>
                    <div class="hidden">
                        <x-link-button href="#" title="Batal" primary id="cancelUpdateProfileButton" />
                    </div>
                </div>
                <form action="{{ route('admin.profile.update-profile') }}" method="POST" id="update-profile-form">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-3 gap-6 mt-8">
                        <x-input id="name" label="Nama lengkap" name="name" type="text"
                            value="{{ auth()->user()->name }}" readonly />
                        <x-input id="phone" label="Nomor telepon" name="phone" type="text"
                            value="{{ auth()->user()->phone }}" readonly />
                        <x-input id="email" label="Email" name="email" type="email"
                            value="{{ auth()->user()->email }}" readonly />
                        <x-input id="province" label="Provinsi" name="province" type="text"
                            value="{{ auth()->user()->province }}" readonly />
                        <x-input id="regency" label="Kabupaten/Kota" name="regency" type="text"
                            value="{{ auth()->user()->regency }}" readonly />
                        <x-input id="district" label="Kecamatan" name="district" type="text"
                            value="{{ auth()->user()->district }}" readonly />
                        <x-input id="zip_code" label="Kode Pos" name="zip_code" type="text"
                            value="{{ auth()->user()->zip_code }}" readonly />
                        <x-input id="nik" label="NIK" name="nik" type="number"
                            value="{{ auth()->user()->nik }}" readonly />
                        <x-textarea id="address" label="Alamat" name="address" readonly
                            value="{{ auth()->user()->address }}" />
                    </div>
                    <div class="hidden">
                        <x-footer-form :backButton="false" />
                    </div>
                </form>
            </div>
        </x-card-container>

        @role('seller')
            <x-card-container>
                <div>
                    <div class="md:flex items-center justify-between gap-2">
                        <h1 class="font-medium text-md">Informasi Toko</h1>
                        <div>
                            <x-link-button href="#" title="Ubah" id="updateStore" />
                        </div>
                        <div class="hidden" id="cancelUpdateStore">
                            <x-link-button href="#" title="Batal" primary />
                        </div>
                    </div>
                    <form action="{{ route('admin.profile.update-store') }}" method="POST" id="update-store-form"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid md:grid-cols-2 gap-6 mt-8">
                            <x-input id="name" label="Nama Toko" name="name" type="text" value="{{ $store->name }}"
                                readonly />
                            <x-input id="phone" label="Nomor telepon" name="phone" type="text"
                                value="{{ $store->phone }}" readonly />
                            <x-textarea id="address" label="Alamat" name="address" readonly value="{{ $store->address }}" />
                            <x-input-file id="logo" label="Logo" name="logo" readonly value="{{ $store->logo }}"
                                :path="asset('storage/store/' . $store->logo)" preview />
                        </div>

                        <div class="grid md:grid-cols-3 gap-6 mt-8">
                            <x-input id="bank_name" label="Nama Bank" name="bank_name" type="text"
                                value="{{ $user->bank_name ?? '-' }}" readonly />
                            <x-input id="card_number" label="Nomor Rekening" name="card_number" type="text"
                                value="{{ $user->card_number ?? '-' }}" readonly />
                            <x-input id="owner_name" label="Nama Pemilik Rekening" name="owner_name" type="text"
                                value="{{ $user->owner_name ?? '-' }}" readonly />
                        </div>
                        <div class="hidden">
                            <x-footer-form :backButton="false" />
                        </div>
                </div>
            </x-card-container>
        @endrole

        @push('js-internal')
            <script>
                $('#updateProfileButton').click(function() {
                    $('#update-profile-form input').prop('readonly', false);
                    $('#update-profile-form textarea').prop('readonly', false);
                    $('#update-profile-form').find('.hidden').removeClass('hidden');
                    $('#update-profile-form button[type="submit"]').removeClass('hidden');

                    $(this).addClass('hidden');
                    $('#cancelUpdateProfileButton').parent().removeClass('hidden');
                });

                $('#cancelUpdateProfileButton').click(function() {
                    $('#update-profile-form input').prop('readonly', true);
                    $('#update-profile-form textarea').prop('readonly', true);
                    $('#update-profile-form').find('.hidden')
                        .addClass('hidden');
                    $('#update-profile-form button[type="submit"]').addClass('hidden');

                    $(this).parent().addClass('hidden');
                    $('#updateProfileButton').removeClass('hidden');
                });

                $('#updateStore').click(function() {
                    $('#update-store-form #name').prop('readonly', false);
                    $('#update-store-form #phone').prop('readonly', false);
                    $('#update-store-form #address').prop('readonly', false);
                    $('#update-store-form #bank_name').prop('readonly', false);
                    $('#update-store-form #card_number').prop('readonly', false);
                    $('#update-store-form #owner_name').prop('readonly', false);
                    $('#update-store-form #logo').prop('readonly', false);
                    $('#update-store-form').find('.hidden').removeClass('hidden');
                    $('#update-store-form button[type="submit"]').removeClass('hidden');

                    $(this).addClass('hidden');
                    $('#cancelUpdateStore').removeClass('hidden');
                });

                $('#cancelUpdateStore').click(function() {
                    $('#update-store-form #name').prop('readonly', true);
                    $('#update-store-form #phone').prop('readonly', true);
                    $('#update-store-form #address').prop('readonly', true);
                    $('update-store-form #bank_name').prop('readonly', true);
                    $('update-store-form #card_number').prop('readonly', true);
                    $('update-store-form #owner_name').prop('readonly', true);
                    $('#update-store-form #logo').prop('readonly', true);
                    $('#update-store-form').find('.hidden').addClass('hidden');
                    $('#update-store-form button[type="submit"]').addClass('hidden');

                    $(this).addClass('hidden');
                    $('#updateStore').removeClass('hidden');
                });
            </script>
        @endpush
    </x-app-layout>
@endrole

@role('buyer')
    <x-guest-layout>
        @role('admin|seller')
            <x-breadcrumb :links="[['name' => 'Dashboard', 'url' => route('admin.dashboard')], ['name' => 'Profil', 'url' => '#']]" />
        @endrole
        @role('buyer')
            <x-breadcrumb :links="[['name' => 'Profil', 'url' => '#']]" />
        @endrole
        <x-card-container>
            <div>
                <div class="md:flex items-center justify-between gap-2">
                    <h1 class="font-medium text-md">Informasi Pengguna</h1>
                    <div>
                        <x-link-button href="#" title="Ubah" id="updateProfileButton" />
                    </div>
                    <div class="hidden">
                        <x-link-button href="#" title="Batal" primary id="cancelUpdateProfileButton" />
                    </div>
                </div>
                <form action="{{ route('admin.profile.update-profile') }}" method="POST" id="update-profile-form">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-3 gap-6 mt-8">
                        <x-input id="name" label="Nama lengkap" name="name" type="text"
                            value="{{ auth()->user()->name }}" readonly />
                        <x-input id="phone" label="Nomor telepon" name="phone" type="text"
                            value="{{ auth()->user()->phone }}" readonly />
                        <x-input id="email" label="Email" name="email" type="email"
                            value="{{ auth()->user()->email }}" readonly />
                        <x-input id="province" label="Provinsi" name="province" type="text"
                            value="{{ auth()->user()->province }}" readonly />
                        <x-input id="regency" label="Kabupaten/Kota" name="regency" type="text"
                            value="{{ auth()->user()->regency }}" readonly />
                        <x-input id="district" label="Kecamatan" name="district" type="text"
                            value="{{ auth()->user()->district }}" readonly />
                        <x-input id="zip_code" label="Kode Pos" name="zip_code" type="text"
                            value="{{ auth()->user()->zip_code }}" readonly />
                        <x-input id="nik" label="NIK" name="nik" type="number"
                            value="{{ auth()->user()->nik }}" readonly />
                        <x-textarea id="address" label="Alamat" name="address" readonly
                            value="{{ auth()->user()->address }}" />
                    </div>
                    <div class="hidden">
                        <x-footer-form :backButton="false" />
                    </div>
                </form>
            </div>
        </x-card-container>

        @role('seller')
            <x-card-container>
                <div>
                    <div class="md:flex items-center justify-between gap-2">
                        <h1 class="font-medium text-md">Informasi Toko</h1>
                        <div>
                            <x-link-button href="#" title="Ubah" id="updateStore" />
                        </div>
                        <div class="hidden" id="cancelUpdateStore">
                            <x-link-button href="#" title="Batal" primary />
                        </div>
                    </div>
                    <form action="{{ route('admin.profile.update-store') }}" method="POST" id="update-store-form"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid md:grid-cols-2 gap-6 mt-8">
                            <x-input id="name" label="Nama Toko" name="name" type="text"
                                value="{{ $store->name }}" readonly />
                            <x-input id="phone" label="Nomor telepon" name="phone" type="text"
                                value="{{ $store->phone }}" readonly />
                            <x-textarea id="address" label="Alamat" name="address" readonly
                                value="{{ $store->address }}" />
                            <x-input-file id="logo" label="Logo" name="logo" readonly value="{{ $store->logo }}"
                                :path="asset('storage/store/' . $store->logo)" preview />
                        </div>

                        <div class="grid md:grid-cols-3 gap-6 mt-8">
                            <x-input id="bank_name" label="Nama Bank" name="bank_name" type="text"
                                value="{{ $user->bank_name ?? '-' }}" readonly />
                            <x-input id="card_number" label="Nomor Rekening" name="card_number" type="text"
                                value="{{ $user->card_number ?? '-' }}" readonly />
                            <x-input id="owner_name" label="Nama Pemilik Rekening" name="owner_name" type="text"
                                value="{{ $user->owner_name ?? '-' }}" readonly />
                        </div>
                        <div class="hidden">
                            <x-footer-form :backButton="false" />
                        </div>
                </div>
            </x-card-container>
        @endrole

        @push('js-internal')
            <script>
                $('#updateProfileButton').click(function() {
                    $('#update-profile-form input').prop('readonly', false);
                    $('#update-profile-form textarea').prop('readonly', false);
                    $('#update-profile-form').find('.hidden').removeClass('hidden');
                    $('#update-profile-form button[type="submit"]').removeClass('hidden');

                    $(this).addClass('hidden');
                    $('#cancelUpdateProfileButton').parent().removeClass('hidden');
                });

                $('#cancelUpdateProfileButton').click(function() {
                    $('#update-profile-form input').prop('readonly', true);
                    $('#update-profile-form textarea').prop('readonly', true);
                    $('#update-profile-form').find('.hidden')
                        .addClass('hidden');
                    $('#update-profile-form button[type="submit"]').addClass('hidden');

                    $(this).parent().addClass('hidden');
                    $('#updateProfileButton').removeClass('hidden');
                });

                $('#updateStore').click(function() {
                    $('#update-store-form #name').prop('readonly', false);
                    $('#update-store-form #phone').prop('readonly', false);
                    $('#update-store-form #address').prop('readonly', false);
                    $('#update-store-form #bank_name').prop('readonly', false);
                    $('#update-store-form #card_number').prop('readonly', false);
                    $('#update-store-form #owner_name').prop('readonly', false);
                    $('#update-store-form #logo').prop('readonly', false);
                    $('#update-store-form').find('.hidden').removeClass('hidden');
                    $('#update-store-form button[type="submit"]').removeClass('hidden');

                    $(this).addClass('hidden');
                    $('#cancelUpdateStore').removeClass('hidden');
                });

                $('#cancelUpdateStore').click(function() {
                    $('#update-store-form #name').prop('readonly', true);
                    $('#update-store-form #phone').prop('readonly', true);
                    $('#update-store-form #address').prop('readonly', true);
                    $('update-store-form #bank_name').prop('readonly', true);
                    $('update-store-form #card_number').prop('readonly', true);
                    $('update-store-form #owner_name').prop('readonly', true);
                    $('#update-store-form #logo').prop('readonly', true);
                    $('#update-store-form').find('.hidden').addClass('hidden');
                    $('#update-store-form button[type="submit"]').addClass('hidden');

                    $(this).addClass('hidden');
                    $('#updateStore').removeClass('hidden');
                });
            </script>
        @endpush
        </x-app-layout>
    @endrole
