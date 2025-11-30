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
            'maps_share_link' => 'nullable|url', // Share link (mudah)
            'maps_embed_url' => 'nullable', // Embed URL/code (advanced)
            'instagram_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'operating_days' => 'required|string',
            'operating_hours' => 'required|string',
        ]);

        // Custom validation: harus ada salah satu (share link ATAU embed url)
        if (empty($request->maps_share_link) && empty($request->maps_embed_url)) {
            return back()->withErrors([
                'maps' => 'Harap isi Google Maps Share Link atau Embed URL'
            ])->withInput();
        }

        // Proses maps_embed_url
        $mapsEmbedUrl = $this->processGoogleMapsUrl($request);

        foreach ($request->except('_token', '_method', 'maps_share_link', 'maps_embed_url') as $key => $value) {
            $group = $this->determineGroup($key);
            Setting::set($key, $value, $group);
        }

        // Simpan maps data
        if ($request->maps_share_link) {
            Setting::set('maps_share_link', $request->maps_share_link, 'address');
        }
        
        if ($mapsEmbedUrl) {
            Setting::set('maps_embed_url', $mapsEmbedUrl, 'address');
        }

        Setting::clearCache();

        return redirect()->route('settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui!');
    }

    /**
     * Process Google Maps URL - convert share link to embed or extract from iframe
     */
    private function processGoogleMapsUrl(Request $request)
    {
        // Prioritas 1: Kalau ada share link, convert ke embed
        if ($request->maps_share_link) {
            return $this->convertShareLinkToEmbed($request->maps_share_link);
        }

        // Prioritas 2: Kalau pakai embed url/code
        if ($request->maps_embed_url) {
            $embedInput = $request->maps_embed_url;

            // Jika input adalah iframe HTML, extract URL-nya
            if (strpos($embedInput, '<iframe') !== false) {
                preg_match('/src="([^"]+)"/', $embedInput, $matches);
                return $matches[1] ?? $embedInput;
            }

            // Jika sudah URL embed langsung
            return $embedInput;
        }

        return null;
    }

    /**
     * Convert Google Maps share link to embed URL
     */
    private function convertShareLinkToEmbed($shareLink)
    {
        // Extract place ID or coordinates dari share link
        // Contoh format share link:
        // https://maps.app.goo.gl/xxxxx
        // https://goo.gl/maps/xxxxx
        // https://www.google.com/maps/place/xxxxx
        
        // Untuk short link (goo.gl), kita buat embed URL generic
        if (strpos($shareLink, 'goo.gl') !== false || strpos($shareLink, 'maps.app.goo.gl') !== false) {
            // Ambil last part sebagai ID
            $parts = explode('/', rtrim($shareLink, '/'));
            $placeId = end($parts);
            
            // Return embed URL format
            return "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093696!2d144.95373631531677!3d-37.81720997975195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x" . $placeId . "!2zM!5e0!3m2!1sen!2sau!4v1234567890123!5m2!1sen!2sau";
        }

        // Untuk full URL, extract place_id atau coordinates
        if (strpos($shareLink, 'place/') !== false) {
            // Extract dari URL place
            preg_match('/place\/([^\/]+)/', $shareLink, $matches);
            if (isset($matches[1])) {
                $placeQuery = $matches[1];
                return "https://www.google.com/maps/embed/v1/place?key=&q=" . urlencode($placeQuery);
            }
        }

        // Jika ga bisa convert, return as is (akan jadi error di iframe tapi better than nothing)
        return $shareLink;
    }

    private function determineGroup($key)
    {
        if (in_array($key, ['whatsapp_number', 'whatsapp_text', 'email', 'phone'])) {
            return 'contact';
        } elseif (in_array($key, ['address_line1', 'address_line2', 'address_country', 'maps_embed_url', 'maps_share_link'])) {
            return 'address';
        } elseif (in_array($key, ['instagram_url', 'tiktok_url', 'facebook_url'])) {
            return 'social';
        } elseif (in_array($key, ['operating_days', 'operating_hours'])) {
            return 'hours';
        }
        return 'general';
    }
}