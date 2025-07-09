<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Helpers\ImageHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class CustomerController extends Controller
{

    public function index()
    {
        $customer = Customer::with('user')->orderBy('id', 'desc')->get();
        return view('backend.v_customer.index', [
            'judul' => 'Customer',
            'sub' => 'Halaman Customer',
            'index' => $customer
        ]);
    }

    public function show($id)
    {
        $customer = Customer::with('user')->findOrFail($id);
        return view('backend.v_customer.show', [
            'judul' => 'Detail Customer',
            'sub' => 'Detail Data Customer',
            'customer' => $customer
        ]);
    }

    public function edit($id)
    {
        $customer = Customer::with('user')->findOrFail($id);
        return view('backend.v_customer.edit', [
            'judul' => 'Edit Customer',
            'sub' => 'Edit Data Customer',
            'customer' => $customer
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::with('user')->findOrFail($id);
        
        $rules = [
            'nama' => 'required|max:255',
            'hp' => 'required|min:10|max:13',
            'alamat' => 'required',
            'pos' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];

        $messages = [
            'nama.required' => 'Nama customer harus diisi.',
            'nama.max' => 'Nama customer maksimal 255 karakter.',
            'hp.required' => 'Nomor HP harus diisi.',
            'hp.min' => 'Nomor HP minimal 10 digit.',
            'hp.max' => 'Nomor HP maksimal 13 digit.',
            'alamat.required' => 'Alamat harus diisi.',
            'pos.required' => 'Kode POS harus diisi.',
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ];

        // Validasi email unik jika berubah
        if ($request->email != $customer->user->email) {
            $rules['email'] = 'required|max:255|email|unique:user,email,' . $customer->user->id;
            $messages['email.required'] = 'Email harus diisi.';
            $messages['email.email'] = 'Format email tidak valid.';
            $messages['email.unique'] = 'Email sudah terdaftar.';
        }

        $validatedData = $request->validate($rules, $messages);

        // Handle upload foto
        if ($request->file('foto')) {
            // Hapus gambar lama
            if ($customer->user->foto) {
                $oldImagePath = public_path('storage/img-customer/') . $customer->user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-customer/';
            
            // Simpan gambar dengan ukuran yang ditentukan
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        }

        // Update data user
        $customer->user->update($validatedData);
        
        // Update data customer
        $customer->update([
            'alamat' => $request->input('alamat'),
            'pos' => $request->input('pos'),
        ]);

        return redirect()->route('backend.customer.index')->with('success', 'Data customer berhasil diperbarui');
    }

    public function destroy($id)
    {
        $customer = Customer::with('user')->findOrFail($id);
        
        // Hapus foto jika ada
        if ($customer->user->foto) {
            $imagePath = public_path('storage/img-customer/') . $customer->user->foto;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus customer (user akan terhapus otomatis karena ada event deleting di model)
        $customerName = $customer->user->nama;
        $customer->delete();

        return redirect()->route('backend.customer.index')->with('success', 'Data customer ' . $customerName . ' berhasil dihapus');
    }

    public function akun($id)
    {
        $loggedInCustomerId = Auth::user()->id;
        // Cek apakah ID yang diberikan sama dengan ID customer yang sedang login
        if ($id != $loggedInCustomerId) {
            // Redirect atau tampilkan pesan error
            return redirect()->route('customer.akun', ['id' => $loggedInCustomerId])->with('msgError', 'Anda tidak berhak mengakses akun ini.');
        }
        $customer = Customer::where('user_id', $id)->firstOrFail();
        return view('v_customer.edit', [
            'judul' => 'Customer',
            'subJudul' => 'Akun Customer',
            'edit' => $customer
        ]);
    }


    public function updateAkun(Request $request, $id)
    {
        $customer = Customer::where('user_id', $id)->firstOrFail();
        $rules = [
            'nama' => 'required|max:255',
            'hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];
        $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ];
        if ($request->email != $customer->user->email) {
            $rules['email'] = 'required|max:255|email|unique:customer';
        }
        if ($request->alamat != $customer->alamat) {
            $rules['alamat'] = 'required';
        }
        if ($request->pos != $customer->pos) {
            $rules['pos'] = 'required';
        }
        $validatedData = $request->validate($rules, $messages);
        // menggunakan ImageHelper
        if ($request->file('foto')) {
            //hapus gambar lama
            if ($customer->user->foto) {
                $oldImagePath = public_path('storage/img-customer/') . $customer->user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-customer/';
            // Simpan gambar dengan ukuran yang ditentukan
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); //null (jika tinggi otomatis)
            // Simpan nama file asli di database
            $validatedData['foto'] = $originalFileName;
        }
        $customer->user->update($validatedData);
        $customer->update([
            'alamat' => $request->input('alamat'),
            'pos' => $request->input('pos'),
        ]);
        return redirect()->route('customer.akun', $id)->with('success', 'Data berhasil diperbarui');
    }

    // Redirect ke Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    // Callback dari Google
    public function callback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();

            // Cek apakah user sudah ada
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // User sudah ada, login dan update google_id jika perlu
                Auth::login($user);

                // Cek apakah customer record ada
                $customer = Customer::where('user_id', $user->id)->first();
                if ($customer && is_null($customer->google_id)) {
                    $customer->update([
                        'google_id' => $socialUser->getId(),
                        'google_token' => $socialUser->token,
                    ]);
                }

                return redirect()->intended('beranda');
            } else {
                // Buat user baru
                $newUser = User::create([
                    'nama' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'role' => '2', // Role customer
                    'status' => 1, // Status aktif
                    'hp' => '-',
                    'password' => Hash::make('password') // Ganti dengan password yang lebih aman jika perlu
                ]);

                // Buat data customer
                Customer::create([
                    'user_id' => $newUser->id,
                    'google_id' => $socialUser->getId(),
                    'google_token' => $socialUser->token,
                ]);

                // Login pengguna baru
                Auth::login($newUser);

                return redirect()->intended('beranda');
            }
        } catch (\Exception $e) {
            // Tampilkan error untuk debugging jika mode debug aktif
            if (config('app.debug')) {
                throw $e;
            }
            // Redirect ke halaman utama jika terjadi kesalahan
            return redirect('/')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerate token CSRF
        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
    // public function show(string $id)
    // {
    //     $customer = Customer::with('foto')->findOrFail($id);
    //     $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
    //     return view('backend.v_produk.show', [
    //         'judul' => 'Detail Produk',
    //         'show' => $produk,
    //         'kategori' => $kategori
    //     ]);
    // }
}
