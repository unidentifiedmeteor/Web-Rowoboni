<!DOCTYPE html>
<html>
<head>
    <title>Kelola Wisata</title>
    <link rel="stylesheet" href="{{ asset('css/wisata.css') }}">
</head>
<body>

<header>

    <div class="logo">
        Desa Wisata Rowoboni
    </div>

    <nav>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/wisata">Kelola Wisata</a>
        <a href="#">Kelola Galeri</a>
        <a href="/admin/logout">Keluar</a>
    </nav>

</header>

<div class="container">

    <div class="form-card">

        <h2>Tambah Wisata</h2>

       @if(isset($editData))

<form action="/admin/wisata/update/{{ $editData->id }}"
      method="POST"
      enctype="multipart/form-data">

@else

<form action="/admin/wisata/store"
      method="POST"
      enctype="multipart/form-data">

@endif

@csrf

        @csrf

            <input
            type="text"
            name="name"
            placeholder="Nama Wisata"
            value="{{ $editData->name ?? '' }}">

           <input
            type="text"
            name="category"
            placeholder="Kategori"
            value="{{ $editData->category ?? '' }}">

         <input
            type="number"
            name="price"
            placeholder="Harga"
            value="{{ $editData->price ?? '' }}">

         <input
            type="text"
            name="location"
            placeholder="Lokasi"
            value="{{ $editData->location ?? '' }}">

            <textarea
            name="description"
            placeholder="Deskripsi">{{ $editData->description ?? '' }}</textarea>

            <label>Foto Wisata</label>

                <input
                    type="file"
                    name="image"
                    accept="image/*">

            <button type="submit">

            @if(isset($editData))
                Update Wisata
            @else
                Tambah Wisata
            @endif

            </button>

        </form>

    </div>

    <h2 class="title">
        Daftar Wisata
    </h2>

    <div class="card-container">

        @foreach($destinations as $item)

        <div class="wisata-card">

            <img
            src="{{ asset($item->image) }}"
            alt="{{ $item->name }}">

            <div class="content">

                <h3>{{ $item->name }}</h3>

                <p>{{ $item->category }}</p>

                <strong>
                    Rp {{ number_format($item->price) }}
                </strong>

                <div class="btn-group">

                  <a
                    href="/admin/wisata/edit/{{ $item->id }}"
                    class="edit">
                    Edit
                    </a>

                <a
                    href="/admin/wisata/delete/{{ $item->id }}"
                    class="hapus">
                    Hapus
                </a>
                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

</body>
</html>