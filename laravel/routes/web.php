<?php

use App\Mail\TicketMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Galeri;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;

Route::get('/tes', function () {
    return 'LARAVEL JALAN';
});

// Home — kirim semua destinasi ke view
Route::get('/', function () {

    $destinations = Destination::all();

    $galeri = Galeri::latest('id_galeri')->get();

    $setting = Setting::first();

    return view('home', compact(
        'destinations',
        'galeri',
        'setting'
    ));
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

Route::post('/booking/store', function (Request $request) {

    $request->validate([
        'destination_id' => 'required',
        'nama' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required',
        'jumlah_tiket' => 'required|integer|min:1',
        'tanggal_kunjungan' => 'required|date|after_or_equal:today'
    ],
    [
        'tanggal_kunjungan.after_or_equal' => 'Tanggal kunjungan tidak boleh sebelum hari ini.'
    ]
    );

    $wisata = Destination::findOrFail(
        $request->destination_id
    );
    
    $existingBooking = Booking::where('email', $request->email)
    ->where('destination_id', $wisata->id)
    ->where('tanggal_kunjungan', $request->tanggal_kunjungan)
    ->where('created_at', '>', now()->subSeconds(15))
    ->first();

    if ($existingBooking) {
        return redirect('/booking/payment/' . $existingBooking->id_booking);
    }

    $booking = Booking::create([

        'destination_id' => $wisata->id,

        'nama' => $request->nama,

        'email' => $request->email,

        'no_hp' => $request->no_hp,

        'jumlah_tiket' => $request->jumlah_tiket,

        'tanggal_kunjungan' => $request->tanggal_kunjungan,

        'total_harga' => $wisata->price * $request->jumlah_tiket,

        'status' => 'Pending'

    ]);

    return redirect('/booking/payment/' . $booking->id_booking);

});

Route::get('/booking/payment/{id}', function ($id) {

    $booking = Booking::findOrFail($id);

    $setting = Setting::first();

    return view('payment', compact(
        'booking',
        'setting'
    ));

});



Route::post('/booking/payment/{id}', function (Request $request, $id) {

    $request->validate([
        'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $booking = Booking::findOrFail($id);

    if ($request->hasFile('bukti_transfer')) {

        $file = $request->file('bukti_transfer');

        $namaFile = 'bukti-' . $booking->id_booking . '-' . time() . '.' . $file->getClientOriginalExtension();

        $file->move(
            public_path('images/bukti-transfer'),
            $namaFile
        );

        $booking->bukti_transfer = 'images/bukti-transfer/' . $namaFile;

        $booking->save();
    }

    return redirect('/')
        ->with(
            'success',
            'Bukti pembayaran berhasil dikirim. Silakan tunggu proses verifikasi, tiket akan dikirim melalui email yang tertera.'
        );

});

Route::post('/booking/payment/{id}/upload', function (
    Request $request,
    $id
) {

    $request->validate([
        'bukti_transfer' =>
            'required|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    $booking = Booking::findOrFail($id);


    if ($booking->bukti_transfer) {

        $fileLama = public_path($booking->bukti_transfer);

        if (file_exists($fileLama)) {
            unlink($fileLama);
        }

    }


    $fileName =
        'bukti-' .
        $booking->id_booking .
        '-' .
        time() .
        '.' .
        $request->bukti_transfer->extension();


    $request->bukti_transfer->move(
        public_path('images/bukti-transfer'),
        $fileName
    );


    $booking->bukti_transfer =
        'images/bukti-transfer/' . $fileName;

    $booking->save();


    return redirect('/')
    ->with(
        'success',
        'Bukti pembayaran berhasil dikirim. Silakan tunggu proses verifikasi, tiket akan dikirim melalui email yang tertera.'
    );

});

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

    $booking = Booking::with('destination')->latest()->get();

    $belumDicek = Booking::where('status', 'Pending')->count();

    $terverifikasi = Booking::where('status', 'Paid')->count();

    $totalPesanan = Booking::count();

    $pendapatan = Booking::where('status', 'Paid')

        ->sum('total_harga');

    return view('admin.dashboard', compact(
        'booking',
        'belumDicek',
        'terverifikasi',
        'totalPesanan',
        'pendapatan'
    ));

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

Route::get('/admin/booking/approve/{id}', function ($id) {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    $booking = Booking::findOrFail($id);

    $booking->status = 'Paid';

    $booking->verified_at = now();

    $booking->ticket_code =
        'RWB-' .
        now()->format('Ymd') .
        '-' .
        str_pad($booking->id_booking, 4, '0', STR_PAD_LEFT);

    $booking->save();
    Mail::to($booking->email)
    ->send(new TicketMail($booking));

    return redirect('/admin/dashboard')
        ->with('success', 'Booking berhasil diverifikasi.');

});

Route::get('/ticket/{id}', function ($id) {

    $booking = Booking::with('destination')
        ->findOrFail($id);

    $pdf = Pdf::loadView(
        'ticket',
        compact('booking')
    );

    return $pdf->download(
        'Ticket-'.$booking->ticket_code.'.pdf'
    );

});


Route::get('/test-email', function () {

    Mail::raw('Halo, email berhasil dikirim!', function ($message) {

        $message->to('puyuhb223@gmail.com');

        $message->subject('Tes Email Rowoboni');

    });

    return 'Email berhasil dikirim';

});

Route::get('/admin/dashboard', function () {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    $booking = Booking::with('destination')
        ->latest()
        ->get();

    $belumDicek = Booking::where('status', 'Pending')->count();

    $terverifikasi = Booking::where('status', 'Paid')->count();

    $totalPesanan = Booking::count();

    $pendapatan = Booking::where('status', 'Paid')
        ->sum('total_harga');
    $bookingPerBulan = [];

    for ($i = 1; $i <= 12; $i++) {

        $bookingPerBulan[] = Booking::whereMonth('created_at', $i)
            ->count();

    }

    return view('admin.dashboard', compact(
        'booking',
        'belumDicek',
        'terverifikasi',
        'totalPesanan',
        'pendapatan',
        'bookingPerBulan'
    ));

});

Route::get('/admin/booking', function () {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    $booking = Booking::with('destination')
        ->latest()
        ->get();

    $pending = Booking::where('status', 'Pending')->count();

    $paid = Booking::where('status', 'Paid')->count();

    $totalBooking = Booking::count();

    $totalPendapatan = Booking::where('status', 'Paid')
        ->sum('total_harga');

    return view('admin.booking', compact(
        'booking',
        'pending',
        'paid',
        'totalBooking',
        'totalPendapatan'
    ));

});

Route::get('/admin/settings', function () {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    $setting = Setting::first();

    return view('admin.settings', compact('setting'));

});

Route::post('/admin/settings/update', function (\Illuminate\Http\Request $request) {

    if (!session()->has('admin_id')) {
        return redirect('/admin/login');
    }

    $request->validate([
        'site_name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'whatsapp' => 'nullable|string|max:30',
        'address' => 'nullable|string',
        'description' => 'nullable|string',
        'bank_name' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:100',
        'account_name' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
    ]);

    Setting::updateOrCreate(
        ['id' => 1],
        [
            'site_name' => $request->site_name,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'address' => $request->address,
            'description' => $request->description,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'instagram' => $request->instagram,
        ]
    );

    return redirect('/admin/settings')
        ->with('success', 'Pengaturan berhasil disimpan.');

});