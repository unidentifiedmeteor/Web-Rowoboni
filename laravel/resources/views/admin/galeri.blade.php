@extends('admin.layouts.app')

@section('title', 'Kelola Galeri')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Kelola Galeri
            </h1>

            <p class="mt-2 text-slate-500">
                Upload dan kelola foto Galeri Desa Wisata Rowoboni.
            </p>
        </div>

        <div class="flex items-center gap-3 rounded-xl bg-purple-50 px-4 py-3 text-purple-700">

            <i class="fa-solid fa-images text-xl"></i>

            <div>
                <p class="text-xs text-purple-500">
                    Total Foto
                </p>

                <p class="font-bold">
                    {{ $galeri->count() }} Foto
                </p>
            </div>

        </div>

    </div>


    {{-- NOTIFIKASI --}}
    @if(session('success'))

        <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">

            <div class="flex items-center gap-3">

                <i class="fa-solid fa-circle-exclamation"></i>

                <span class="font-semibold">
                    Gagal mengupload foto.
                </span>

            </div>

            <ul class="mt-2 list-inside list-disc text-sm">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- UPLOAD FOTO --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm">

        <div class="border-b border-slate-100 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-600">

                    <i class="fa-solid fa-cloud-arrow-up"></i>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-800">
                        Upload Foto Galeri
                    </h2>

                    <p class="text-sm text-slate-500">
                        Tambahkan foto baru ke galeri wisata.
                    </p>

                </div>

            </div>

        </div>


        <div class="p-6">

            <form
                action="/admin/galeri/store"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                {{-- DROP AREA --}}
                <div
                    id="dropArea"
                    class="group relative flex min-h-72 cursor-pointer items-center justify-center overflow-hidden rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 transition duration-300 hover:border-purple-500 hover:bg-purple-50">


                    {{-- PREVIEW --}}
                    <img
                        id="previewImage"
                        src=""
                        alt="Preview Foto"
                        class="absolute inset-0 hidden h-full w-full object-contain p-4">


                    {{-- DROP TEXT --}}
                    <div
                        id="dropText"
                        class="pointer-events-none p-8 text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-purple-100 text-purple-600 transition duration-300 group-hover:scale-110">

                            <i class="fa-solid fa-cloud-arrow-up text-3xl"></i>

                        </div>


                        <h3 class="mt-5 text-lg font-bold text-slate-700">
                            Drag & Drop Foto
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Tarik foto ke area ini atau klik untuk memilih file.
                        </p>

                        <p class="mt-3 text-xs text-slate-400">
                            Format yang didukung: JPG, JPEG, PNG, WEBP
                        </p>

                    </div>

                </div>


                <input
                    type="file"
                    name="media"
                    id="media"
                    accept="image/*"
                    class="hidden"
                    required>


                {{-- INFORMASI FILE --}}
                <div
                    id="fileInformation"
                    class="mt-4 hidden items-center justify-between rounded-xl border border-purple-100 bg-purple-50 px-5 py-4">

                    <div class="flex min-w-0 items-center gap-3">

                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-purple-100 text-purple-600">

                            <i class="fa-solid fa-image"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs text-slate-500">
                                File dipilih
                            </p>

                            <p
                                id="fileName"
                                class="truncate font-semibold text-slate-700">
                            </p>

                        </div>

                    </div>


                    <button
                        type="button"
                        id="removeImage"
                        class="ml-4 flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg text-red-500 transition hover:bg-red-100">

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                </div>


                {{-- BUTTON --}}
                <div class="mt-6 flex justify-end">

                    <button
                        type="submit"
                        class="flex items-center gap-2 rounded-xl bg-purple-600 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-purple-700">

                        <i class="fa-solid fa-cloud-arrow-up"></i>

                        Upload Foto

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- DAFTAR GALERI --}}
    <div>

        <div class="mb-5">

            <h2 class="text-xl font-bold text-slate-800">
                Galeri Desa Wisata
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Semua foto yang ditampilkan pada halaman wisatawan.
            </p>

        </div>


        @if($galeri->count() > 0)

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                @foreach($galeri as $item)

                    <div class="group relative aspect-square overflow-hidden rounded-2xl bg-slate-200 shadow-sm">

                        {{-- FOTO --}}
                        <img
                            src="{{ asset($item->file_media) }}"
                            alt="Galeri Rowoboni"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-110">


                        {{-- OVERLAY --}}
                        <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/70 via-black/10 to-transparent opacity-0 transition duration-300 group-hover:opacity-100">

                            <div class="flex w-full items-center justify-between p-4">

                                <div class="text-white">

                                    <p class="text-xs text-white/70">
                                        Foto Galeri
                                    </p>

                                    <p class="font-semibold">
                                        #{{ $item->id_galeri }}
                                    </p>

                                </div>


                                <a
                                    href="/admin/galeri/delete/{{ $item->id_galeri }}"
                                    onclick="return confirm('Yakin ingin menghapus foto ini dari galeri?')"
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-500 text-white shadow-lg transition hover:bg-red-600"
                                    title="Hapus Foto">

                                    <i class="fa-solid fa-trash"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- EMPTY STATE --}}
            <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-purple-50">

                    <i class="fa-solid fa-images text-3xl text-purple-500"></i>

                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-800">
                    Galeri Masih Kosong
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                    Upload foto pertama untuk mulai menampilkan galeri Desa Wisata Rowoboni.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection


@push('scripts')

<script>

const dropArea = document.getElementById('dropArea');

const input = document.getElementById('media');

const preview = document.getElementById('previewImage');

const dropText = document.getElementById('dropText');

const fileName = document.getElementById('fileName');

const fileInformation = document.getElementById('fileInformation');

const removeImage = document.getElementById('removeImage');


dropArea.addEventListener('click', function () {

    input.click();

});


input.addEventListener('change', function () {

    if (input.files.length > 0) {

        showPreview(input.files[0]);

    }

});


dropArea.addEventListener('dragover', function (event) {

    event.preventDefault();

    dropArea.classList.remove(
        'border-slate-300',
        'bg-slate-50'
    );

    dropArea.classList.add(
        'border-purple-500',
        'bg-purple-50'
    );

});


dropArea.addEventListener('dragleave', function () {

    resetDropAreaColor();

});


dropArea.addEventListener('drop', function (event) {

    event.preventDefault();

    resetDropAreaColor();

    const files = event.dataTransfer.files;

    if (files.length > 0) {

        input.files = files;

        showPreview(files[0]);

    }

});


removeImage.addEventListener('click', function (event) {

    event.stopPropagation();

    input.value = '';

    preview.src = '';

    preview.classList.add('hidden');

    dropText.classList.remove('hidden');

    fileInformation.classList.remove('flex');

    fileInformation.classList.add('hidden');

});


function showPreview(file) {

    if (!file) {
        return;
    }


    if (!file.type.startsWith('image/')) {

        alert('File yang dipilih harus berupa gambar.');

        input.value = '';

        return;

    }


    preview.src = URL.createObjectURL(file);

    preview.classList.remove('hidden');

    dropText.classList.add('hidden');

    fileName.textContent = file.name;

    fileInformation.classList.remove('hidden');

    fileInformation.classList.add('flex');

}


function resetDropAreaColor() {

    dropArea.classList.remove(
        'border-purple-500',
        'bg-purple-50'
    );

    dropArea.classList.add(
        'border-slate-300',
        'bg-slate-50'
    );

}

</script>

@endpush