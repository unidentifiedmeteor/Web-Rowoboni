<!DOCTYPE html>
<html>
<head>
    <title>Kelola Galeri</title>
    <link rel="stylesheet" href="{{ asset('css/galeri.css') }}">
</head>
<body>

<header>
    <div class="logo">
        Desa Wisata Rowoboni
    </div>

    <nav>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/wisata">Kelola Wisata</a>
        <a href="/admin/galeri">Kelola Galeri</a>
        <a href="/admin/logout">Keluar</a>
    </nav>
</header>

<div class="container">

    <div class="upload-card">

        <h2>Upload Foto Galeri</h2>

       <form
action="/admin/galeri/store"
method="POST"
enctype="multipart/form-data">

    @csrf

    <div class="drop-area" id="dropArea">

    <img
        id="previewImage"
        style="display:none;"
        alt="Preview">

    <div id="dropText">

        <h3>Drag & Drop Foto</h3>

        <p>atau klik area ini</p>

    </div>

</div>

 <input
    type="file"
    name="media"
    id="media"
    accept="image/*"
    hidden
    required>

<label for="media" class="upload-btn">
     Pilih Foto
</label>

<p id="fileName">
    Belum ada file dipilih
</p>

    <button type="submit">
        Upload Foto
    </button>

</form>
    </div>

    <h2 class="title">
        Galeri Desa Wisata
    </h2>

    <div class="gallery-grid">

        @foreach($galeri as $item)

        <div class="gallery-card">

            <img
                src="{{ asset($item->file_media) }}"
                alt="Galeri">

            <div class="gallery-action">

                <a
                    href="/admin/galeri/delete/{{ $item->id_galeri }}"
                    class="hapus">
                    Hapus
                </a>

            </div>

        </div>

        @endforeach

    </div>

</div>

<script>

const dropArea =
document.getElementById('dropArea');

const input =
document.getElementById('media');

const preview =
document.getElementById('previewImage');

const dropText =
document.getElementById('dropText');

dropArea.addEventListener('click', () => {

    input.click();

});

input.addEventListener('change', () => {

    showPreview(input.files[0]);

});

dropArea.addEventListener('dragover', (e) => {

    e.preventDefault();

    dropArea.classList.add('dragover');

});

dropArea.addEventListener('dragleave', () => {

    dropArea.classList.remove('dragover');

});

dropArea.addEventListener('drop', (e) => {

    e.preventDefault();

    dropArea.classList.remove('dragover');

    input.files = e.dataTransfer.files;

    showPreview(
        e.dataTransfer.files[0]
    );

});

function showPreview(file){

    if(!file) return;

    preview.src =
        URL.createObjectURL(file);

    preview.style.display =
        'block';

    dropText.style.display =
        'none';

    document
    .getElementById('fileName')
    .innerText =
    file.name;

}

</script>
</body>
</html>