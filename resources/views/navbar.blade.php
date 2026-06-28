<nav class="bg-white shadow-sm mb-6">
    <div class="w-full px-6 py-3 flex justify-between items-center">

        <!-- Logo & Menu -->
        <div class="flex items-center gap-8">

            <span class="font-bold text-lg text-blue-600 tracking-wide">
                MyStore
            </span>

            <div class="flex gap-5 text-sm font-medium">

                <!-- Menu Item -->
                <a href="{{ route('products.index') }}"
                    class="{{ request()->routeIs('products.index')
                    ? 'text-blue-500 border-b-2 border-blue-500 pb-1'
                    : 'text-gray-500 hover:text-blue-500' }}
                    flex items-center gap-1">

                    <span class="material-icons text-base">
                        inventory_2
                    </span>

                    Item

                </a>

                <!-- Menu Transaksi -->
                <a href="#"
                    class="text-gray-500 hover:text-blue-500 flex items-center gap-1 transition">

                    <span class="material-icons text-base">
                        receipt_long
                    </span>

                    Transaksi

                </a>

            </div>

        </div>

        <!-- Logout -->
        <form id="logoutForm"
            action="{{ route('logout') }}"
            method="POST">

            @csrf

            <button
                type="button"
                onclick="openLogoutModal()"
                class="text-gray-500 hover:text-red-500 font-medium flex items-center gap-1 transition">

                <span class="material-icons">
                    logout
                </span>

                Keluar

            </button>

        </form>

    </div>
</nav>

<!-- Modal Logout -->
<div id="logoutModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden justify-center items-center z-50">

    <div class="bg-white rounded-2xl shadow-xl w-[400px] p-6">

        <!-- Icon -->
        <div class="flex justify-center mb-4">

            <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center">

                <span class="material-icons text-red-600 text-5xl">

                    logout

                </span>

            </div>

        </div>

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center text-gray-800">

            Logout

        </h2>

        <p class="text-center text-gray-500 mt-2">

            Apakah Anda yakin ingin keluar dari aplikasi?

        </p>

        <!-- Button -->
        <div class="flex justify-center gap-4 mt-8">

            <button
                onclick="closeLogoutModal()"
                class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">

                Batal

            </button>

            <button
                onclick="confirmLogout()"
                class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">

                Ya, Logout

            </button>

        </div>

    </div>

</div>

<script>

function openLogoutModal() {

    document.getElementById('logoutModal')
        .classList.remove('hidden');

    document.getElementById('logoutModal')
        .classList.add('flex');

}

function closeLogoutModal() {

    document.getElementById('logoutModal')
        .classList.remove('flex');

    document.getElementById('logoutModal')
        .classList.add('hidden');

}

function confirmLogout() {

    document.getElementById('logoutForm').submit();

}

// Tutup modal jika klik area luar
window.onclick = function(event){

    let modal = document.getElementById('logoutModal');

    if(event.target === modal){

        closeLogoutModal();

    }

}

</script>