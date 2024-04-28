        <div class="absolute top-0 right-0 bottom-0 left-0 bg-slate-700 z-50 bg-opacity-40">
            <div id="buySellModal"
                class="fixed inset-x-0 inset-y-10 flex flex-col items-center justify-between max-md:px-5">
                <div class="bg-white py-4 px-8 rounded-lg shadow-lg shadow-slate-500 md:w-96 w-full">
                    <div class="flex items-start">
                        <h2 class="text-lg font-semibold text-gray-700">Detail</h2>
                        <button onclick="closeModal()"
                            class="ml-auto text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div class="mt-8">
                        <div class="flex w-3/4 justify-center mx-auto p-2 bg-gray-200 rounded-lg">
                            <button id="buyBtn"
                                class="w-full p2  rounded-md transition-colors duration-200 ease-in-out focus:outline-none focus:ring-1 focus:ring-red-600 active:bg-primary"
                                onclick="openContent('buy')">Detail 1</button>
                            <button id="sellBtn"
                                class="w-full p-2 rounded-md transition-colors duration-200 ease-in-out focus:outline-none focus:ring-1 focus:ring-red-600 active:bg-primary"
                                onclick="openContent('sell')">Detail 2</button>
                        </div>

                        <div id="buyContent" class="mb-4">
                            <div class="flex justify-between">
                                <h2 class="text-base font-semibold my-5">Detail Data 1</h2>
                                <p class="text-base font-semibold my-5 bg-primary text-white rounded px-1">Test</p>
                            </div>
                            {{-- <h4 class="text-md font-medium m-5 text-center">Lorem ipsum dolor sit amet
                                consectetur. <span class="text-white bg-primary p-1 rounded-lg">Lorem</span></h4> --}}
                            <div class="h-[40dvh] overflow-y-auto">
                                <div class="bg-slate-50 rounded-md p-4 overflow-y-auto h-[35dvh]">
                                    <h3 class="text-md font-medium text-slate-500 mb-2 py-3 border-b border-slate-400">
                                        Peralatan Pembersihan Gigi
                                        (Scaling)</h3>
                                    {{-- <ul class="flex justify-around list-none p-3">
                                        <li class="text-md font-medium">Harga: </li>
                                        <li class="text-md font-medium"><span class="text-primary">Lorem ipsum dolor
                                                sit amet.</span>
                                        </li>
                                    </ul> --}}
                                    <table class="w-full text-center">
                                        <tr>
                                            <td class="p-2 border-b border-slate-200">Harga</td>
                                            <td class="p-2 border-b border-slate-200">100000</td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b border-slate-200">lorem</td>
                                            <td class="p-2 border-b border-slate-200">Lorem ipsum dolor sit amet.</td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b border-slate-200">Harga</td>
                                            <td class="p-2 border-b border-slate-200">Lorem ipsum dolor sit amet
                                                consectetur adipisicing elit.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b border-slate-200">lorem</td>
                                            <td class="p-2 border-b border-slate-200">Lorem ipsum dolor sit amet
                                                consectetur adipisicing.</td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b border-slate-200">lorem</td>
                                            <td class="p-2 border-b border-slate-200">Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b border-slate-200">lorem</td>
                                            <td class="p-2 border-b border-slate-200">Lorem ipsum dolor sit amet
                                                consectetur adipisicing elit.
                                                Temporibus,
                                                voluptate!</td>
                                        </tr>

                                    </table>


                                </div>

                            </div>
                        </div>

                        <div id="sellContent" class="hidden mb-4">
                            <div class="flex justify-between">
                                <h2 class="text-base font-semibold my-5">Detail Data 2</h2>
                                <p class="text-base font-semibold my-5">Test</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-orange-100 rounded-md p-4">
                                    <h3 class="text-lg font-medium mb-2">Kursi Periksa Gigi Elektrik</h3>
                                    <ul class="list-disc space-y-2">
                                        <li>Merek: Adec</li>
                                        <li>Kondisi: Bekas (masih berfungsi dengan baik)</li>
                                        <li>Harga: Rp. 5.000.000</li>
                                    </ul>
                                </div>
                                <div class="bg-gray-100 rounded-md p-4">
                                    <img src="{{ asset('assets/images/wp23.jpg') }}" alt="Kursi Periksa Gigi Elektrik"
                                        class="w-full rounded-md">
                                </div>
                            </div>
                        </div>
                        <button class="bg-primary text-white w-full p-2 capitalize rounded-lg">close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openContent(type) {
                const buyBtn = document.getElementById('buyBtn');
                const sellBtn = document.getElementById('sellBtn');
                const buyContent = document.getElementById('buyContent');
                const sellContent = document.getElementById('sellContent');

                buyBtn.classList.remove('active', 'bg-primary', 'text-white');
                sellBtn.classList.remove('active', 'bg-primary', 'text-white');
                buyContent.classList.add('hidden');
                sellContent.classList.add('hidden');

                if (type === 'buy') {
                    buyBtn.classList.add('active', 'bg-primary', 'text-white');
                    buyContent.classList.remove('hidden');
                } else if (type === 'sell') {
                    sellBtn.classList.add('active', 'bg-primary', 'text-white');
                    sellContent.classList.remove('hidden');
                }
            }

            function closeModal() {
                document.getElementById('buySellModal').classList.remove('flex');
            }

            const buySellModal = document.getElementById('buySellModal');
            buySellModal.classList.add('flex');

            openContent('buy');
        </script>
