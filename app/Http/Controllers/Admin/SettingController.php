<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'app_name' => Setting::get('app_name', 'SMART BM3'),
            'school_name' => Setting::get('school_name', 'SMK 3 TAHUN PALAJARAN'),
            'system_email' => Setting::get('system_email', 'admin@smartbm3.com'),
            'academic_year' => Setting::get('academic_year', '2025/2026'),
            'timezone' => Setting::get('timezone', 'Asia/Jakarta'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'school_name' => 'required|string|max:255',
            'system_email' => 'required|email|max:255',
            'academic_year' => 'required|string|max:20',
            'timezone' => 'required|string|max:50',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return redirect()->back()->with('success', 'Cache berhasil dibersihkan!');
    }

    public function backup()
    {
        // Implementasi backup database
        // Anda bisa menggunakan package seperti spatie/laravel-backup

        return redirect()->back()->with('success', 'Backup database berhasil!');
    }
}
