<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login MyStore</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<script>
function togglePassword() {

    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (password.type === "password") {

        password.type = "text";
        eyeIcon.textContent = "visibility_off";

    } else {

        password.type = "password";
        eyeIcon.textContent = "visibility";

    }

}

</script>

<body class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-500 to-cyan-400 flex items-center justify-center p-6"><div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2">

    <!-- Panel Kiri -->
    <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-br from-blue-700 to-blue-500 text-white p-10">

        <span class="material-icons text-8xl mb-6">
            storefront
        </span>

        <h1 class="text-4xl font-bold">
            MyStore
        </h1>

        <p class="mt-4 text-center text-blue-100 leading-relaxed">
            Sistem Informasi Penjualan
            <br>
            Toko Dua Bersaudara
        </p>

        <div class="mt-10">
            <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"
                 class="w-56">
        </div>

    </div>

    <!-- Panel Login -->
    <div class="p-10 flex items-center">

        <div class="w-full">

            <div class="text-center mb-8">

                <h2 class="text-3xl font-bold text-gray-800">
                    Selamat Datang
                </h2>

                <p class="text-gray-500 mt-2">
                    Silakan login untuk melanjutkan
                </p>

            </div>

            <form action="{{ route('login.process') }}" method="POST">

                @csrf

                <!-- Email -->

                <label class="text-gray-600 text-sm font-medium">
                    Email
                </label>

                <div class="relative mt-2 mb-5">

                    <span class="material-icons absolute left-3 top-3 text-gray-400">
                        email
                    </span>

                    <input
                        type="email"
                        name="email"
                        required
                        placeholder="Masukkan email"

                        class="w-full border rounded-xl py-3 pl-12 pr-4
                        focus:ring-2 focus:ring-blue-500
                        focus:border-blue-500 outline-none transition">

                </div>
<!-- Password -->

<label class="text-gray-600 text-sm font-medium">
    Password
</label>

<div class="relative mt-2">

    <!-- Icon Lock -->
    <span class="material-icons absolute left-3 top-3 text-gray-400">
        lock
    </span>

    <!-- Input Password -->
    <input
        id="password"
        type="password"
        name="password"
        required
        placeholder="Masukkan password"
        class="w-full border rounded-xl py-3 pl-12 pr-12
        focus:ring-2 focus:ring-blue-500
        focus:border-blue-500 outline-none transition">

    <!-- Icon Mata -->
    <button
        type="button"
        onclick="togglePassword()"
        class="absolute right-3 top-3 text-gray-400 hover:text-blue-600">

        <span id="eyeIcon" class="material-icons">
            visibility
        </span>

    </button>

</div>

                @error('login_error')

                <div class="mt-4 bg-red-100 border border-red-300 text-red-600 rounded-lg p-3 text-sm">

                    {{ $message }}

                </div>

                @enderror

                <button
                    type="submit"

                    class="mt-8 w-full bg-blue-600 hover:bg-blue-700
                    text-white py-3 rounded-xl
                    font-semibold shadow-lg
                    transition duration-300">

                    Login

                </button>

            </form>

            <div class="mt-8 text-center text-gray-400 text-sm">

                © {{ date('Y') }} MyStore • Toko Dua Bersaudara

            </div>

        </div>

    </div>

</div>

</body>
</html>