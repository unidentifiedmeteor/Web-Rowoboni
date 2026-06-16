<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Galeri;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Models\Destination;
use Illuminate\Http\Request;


// Home — kirim semua destinasi ke view
Route::get('/', function () {
    $destinations = Destination::all();
    return view('home', compact('destinations'));
});
 
// Detail destinasi
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])
    ->name('destinations.show');

// Rute front-end sementara untuk menampilkan form booking baru
Route::get('/booking/create', function (\Illuminate\Http\Request $request) { // ✨ Ditambahkan \Illuminate\Http\ di depan Request
    
    // Mengambil data destinasi berdasarkan parameter ?destination=id di URL
    $destination = \App\Models\Destination::find($request->query('destination')) ?? \App\Models\Destination::first();
    
    // Membuka form booking sambil mengirimkan data destinasinya
    return view('booking', compact('destination'));
})->name('booking.create');

Route::get('/admin/login', function () {
    return view('login');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::post('/admin/login', function (Request $request) {

    $admin = DB::table('admin')
        ->where('username', $request->username)
        ->where('password', $request->password)
        ->first();

    if ($admin) {
        session([
            'admin_id' => $admin->id_admin,
            'admin_name' => $admin->username
        ]);

        return redirect('/admin/dashboard');
    }

    return back()->with('error', 'Username atau Password salah');
});

Route::get('/admin/dashboard', function () {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    return view('admin.dashboard');
});

Route::get('/admin/logout', function () {

    session()->forget('admin_id');
    session()->forget('admin_name');

    return redirect('/admin/login');

});

Route::get('/admin/wisata', function () {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    $destinations = Destination::all();

    return view('admin.wisata', compact('destinations'));
});

Route::post('/admin/wisata/store', function (Illuminate\Http\Request $request) {

    $imageName = null;

    if ($request->hasFile('image')) {

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(
            public_path('images/wisata'),
            $imageName
        );
    }

    App\Models\Destination::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'category' => $request->category,
        'description' => $request->description,
        'price' => $request->price,
        'location' => $request->location,
        'image' => 'images/wisata/' . $imageName
    ]);

    return redirect('/admin/wisata');
});

Route::get('/admin/wisata/delete/{id}', function ($id) {

    App\Models\Destination::destroy($id);

    return redirect('/admin/wisata');
});

Route::get('/admin/wisata/edit/{id}', function ($id) {

    $editData = App\Models\Destination::findOrFail($id);

    $destinations = App\Models\Destination::all();

    return view(
        'admin.wisata',
        compact('destinations', 'editData')
    );
});

Route::post('/admin/wisata/update/{id}', function (
    Illuminate\Http\Request $request,
    $id
) {
$wisata = App\Models\Destination::findOrFail($id);

$data = [
    'name' => $request->name,
    'category' => $request->category,
    'description' => $request->description,
    'price' => $request->price,
    'location' => $request->location
];

if ($request->hasFile('image')) {

    $imageName = time().'.'.$request->image->extension();

    $request->image->move(
        public_path('images/wisata'),
        $imageName
    );

    $data['image'] = 'images/wisata/'.$imageName;
}

$wisata->update($data);

return redirect('/admin/wisata');
});

Route::get('/admin/wisata/edit/{id}', function ($id) {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    $editData = App\Models\Destination::findOrFail($id);

    $destinations = App\Models\Destination::all();

    return view(
        'admin.wisata',
        compact('destinations','editData')
    );
});

Route::get('/admin/wisata/delete/{id}', function ($id) {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    App\Models\Destination::destroy($id);

    return redirect('/admin/wisata');
});

Route::get('/admin/galeri', function () {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    $galeri = Galeri::all();

    return view(
        'admin.galeri',
        compact('galeri')
    );
});

Route::post('/admin/galeri/store', function (
    Illuminate\Http\Request $request
) {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    if ($request->hasFile('media')) {

        $fileName =
            time().'.'.$request->media->extension();

        $request->media->move(
            public_path('images/galeri'),
            $fileName
        );

        Galeri::create([
            'file_media' =>
            'images/galeri/'.$fileName
        ]);
    }

    return redirect('/admin/galeri');
});

Route::get('/admin/galeri/delete/{id}', function ($id) {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    Galeri::destroy($id);

    return redirect('/admin/galeri');
});




