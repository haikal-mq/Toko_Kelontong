<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .modal-bg{
            background:rgba(0,0,0,.45);
            backdrop-filter:blur(3px);
        }

        table tbody tr:hover{
            background:#f9fafb;
        }
    </style>

</head>

<!-- Modal Export PDF -->
<div id="pdfModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden justify-center items-center z-50">

    <div class="bg-white rounded-2xl shadow-2xl w-[420px] p-6">

        <!-- Icon -->
        <div class="flex justify-center mb-5">

            <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center">

                <span class="material-icons text-red-600 text-5xl">
                    picture_as_pdf
                </span>

            </div>

        </div>

        <h2 class="text-2xl font-bold text-center text-gray-800">

            Export PDF

        </h2>

        <p class="text-gray-500 text-center mt-2">

            Apakah Anda ingin mengekspor data produk ke dalam file PDF?

        </p>

        <div class="flex justify-center gap-4 mt-8">

            <button
                onclick="closePdfModal()"
                class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">

                Batal

            </button>

            <a href="{{ route('products.pdf') }}"
                class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center gap-2">

                <span class="material-icons text-base">
                    download
                </span>

                Export

            </a>

        </div>

    </div>

</div>
<body>

@include('navbar')

<div class="max-w-7xl mx-auto p-8">

    <!-- Header -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Data Produk
            </h1>

            <p class="text-gray-500 mt-1">
                Manajemen Produk Toko Dua Bersaudara
            </p>

        </div>

        <div class="flex gap-3">

            <button
                onclick="toggle_modal()"
                class="bg-blue-600 hover:bg-blue-700 transition text-white px-5 py-3 rounded-xl flex items-center gap-2 shadow">

                <span class="material-icons">add</span>

                Tambah Produk

            </button>
            <button type="button" onclick="openPdfModal()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl shadow flex items-center gap-2 transition">
                <span class="material-icons"> picture_as_pdf </span>
                Simpan Sebagai PDF
            </button>
        </div>
    </div>


    <!-- Card -->

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-800 text-white">

            <tr>

                <th class="p-4 text-left">Nama Produk</th>

                <th class="p-4 text-center">Harga</th>

                <th class="p-4 text-center">Stok</th>

                <th class="p-4">Deskripsi</th>

                <th class="p-4 text-center">Aksi</th>

            </tr>

            </thead>

            <tbody>

            @foreach($products as $p)

                <tr class="border-b">

                    <td class="p-4 font-semibold text-gray-700">

                        {{ $p->nama_barang }}

                    </td>

                    <td class="text-center">

                        <span class="font-semibold text-green-600">

                            Rp {{ number_format($p->harga,0,',','.') }}

                        </span>

                    </td>

                    <td class="text-center">

                        @if($p->stok > 10)

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                {{ $p->stok }}
                            </span>

                        @elseif($p->stok > 5)

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                {{ $p->stok }}
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                {{ $p->stok }}
                            </span>

                        @endif

                    </td>

                    <td class="text-gray-600">

                        {{ $p->deskripsi }}

                    </td>

                    <td>

                        <div class="flex justify-center gap-3">

                            <button
                                onclick='toggle_edit(@json($p))'
                                class="bg-green-100 hover:bg-green-200 p-2 rounded-lg">

                                <span class="material-icons text-green-700">
                                    edit
                                </span>

                            </button>

                            <button

                                onclick="if(confirm('Yakin menghapus produk ini?')) document.getElementById('form-delete{{ $p->id }}').submit();"

                                class="bg-red-100 hover:bg-red-200 p-2 rounded-lg">

                                <span class="material-icons text-red-700">
                                    delete
                                </span>

                            </button>

                            <form
                                id="form-delete{{ $p->id }}"
                                action="{{ route('products.destroy',$p->id) }}"
                                method="POST"
                                class="hidden">

                                @csrf
                                @method('DELETE')

                            </form>

                        </div>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>


<!-- MODAL TAMBAH -->

<div id="modal-tambah-item"
class="fixed inset-0 modal-bg hidden justify-center items-center">

<div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">

<h2 class="text-2xl font-bold mb-6">

Tambah Produk

</h2>

<form action="{{ route('products.store') }}" method="POST">

@csrf

<div class="space-y-4">

<input
type="text"
name="nama_barang"
placeholder="Nama Produk"
class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
required>

<input
type="number"
name="harga"
placeholder="Harga"
class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
required>

<input
type="number"
name="stok"
placeholder="Stok"
class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
required>

<textarea
name="deskripsi"
placeholder="Deskripsi Produk"
rows="4"
class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"></textarea>

</div>

<div class="flex justify-end mt-6 gap-3">

<button
type="button"
onclick="toggle_modal()"
class="px-5 py-2 rounded-lg bg-gray-200">

Batal

</button>

<button
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

Simpan

</button>

</div>

</form>

</div>

</div>


<!-- MODAL EDIT -->

<div id="modal-edit-item"
class="fixed inset-0 modal-bg hidden justify-center items-center">

<div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">

<h2 class="text-2xl font-bold mb-6">

Edit Produk

</h2>

<form id="form-edit" method="POST">

@csrf
@method('PUT')

<div class="space-y-4">

<input id="edit_nama_barang"
name="nama_barang"
class="w-full border rounded-lg p-3">

<input id="edit_harga"
type="number"
name="harga"
class="w-full border rounded-lg p-3">

<input id="edit_stok"
type="number"
name="stok"
class="w-full border rounded-lg p-3">

<textarea
id="edit_deskripsi"
name="deskripsi"
rows="4"
class="w-full border rounded-lg p-3"></textarea>

</div>

<div class="flex justify-end gap-3 mt-6">

<button
type="button"
onclick="closeEdit()"
class="bg-gray-200 px-5 py-2 rounded-lg">

Batal

</button>

<button
class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">

Update

</button>

</div>

</form>

</div>

</div>

<script>

function toggle_modal(){

const modal=document.getElementById('modal-tambah-item');

modal.classList.toggle('hidden');

modal.classList.toggle('flex');

}

function toggle_edit(item){

document.getElementById('form-edit').action='/products/'+item.id;

document.getElementById('edit_nama_barang').value=item.nama_barang;

document.getElementById('edit_harga').value=item.harga;

document.getElementById('edit_stok').value=item.stok;

document.getElementById('edit_deskripsi').value=item.deskripsi;

document.getElementById('modal-edit-item').classList.remove('hidden');

document.getElementById('modal-edit-item').classList.add('flex');

}

function closeEdit(){

document.getElementById('modal-edit-item').classList.remove('flex');

document.getElementById('modal-edit-item').classList.add('hidden');

}

function openPdfModal(){

    const modal = document.getElementById('pdfModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

}

function closePdfModal(){

    const modal = document.getElementById('pdfModal');

    modal.classList.remove('flex');
    modal.classList.add('hidden');

}

// Tutup modal ketika klik area luar
window.addEventListener('click', function(e){

    const modal = document.getElementById('pdfModal');

    if(e.target === modal){

        closePdfModal();

    }

});

</script>

</body>
</html>