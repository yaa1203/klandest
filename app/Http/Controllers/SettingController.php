<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'contact' => Setting::getGroup('contact'),
            'address' => Setting::getGroup('address'),
            'social' => Setting::getGroup('social'),
            'hours' => Setting::getGroup('hours'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required|string',
            'whatsapp_text' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address_line1' => 'required|string',
            'address_line2' => 'required|string',
            'address_country' => 'required|string',
            'maps_embed_url' => 'required|url',
            'instagram_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'operating_days' => 'required|string',
            'operating_hours' => 'required|string',
        ]);

        foreach ($request->except('_token', '_method') as $key => $value) {
            $group = $this->determineGroup($key);
            Setting::set($key, $value, $group);
        }

        Setting::clearCache();

        return redirect()->route('settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui!');
    }

    private function determineGroup($key)
    {
        if (in_array($key, ['whatsapp_number', 'whatsapp_text', 'email', 'phone'])) {
            return 'contact';
        } elseif (in_array($key, ['address_line1', 'address_line2', 'address_country', 'maps_embed_url'])) {
            return 'address';
        } elseif (in_array($key, ['instagram_url', 'tiktok_url', 'facebook_url'])) {
            return 'social';
        } elseif (in_array($key, ['operating_days', 'operating_hours'])) {
            return 'hours';
        }
        return 'general';
    }
}