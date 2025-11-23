<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactReplyMail;

class ContactController extends Controller
{
    // USER: Halaman Kontak
    public function index()
    {
        return view('user.kontak');
    }

    // USER: Kirim Pesan
    public function store(Request $request)
    {
        Log::info('Contact form submitted', $request->all());

        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'email'     => 'required|email',
            'whatsapp'  => 'required|string|min:10',
            'subjek'    => 'required|string|max:255',
            'pesan'     => 'required|string|min:10',
        ]);

        try {
            $contact = ContactMessage::create([
                'user_id'   => Auth::check() ? Auth::id() : null,
                'nama'      => $validated['nama'],
                'email'     => $validated['email'],
                'whatsapp'  => $validated['whatsapp'],
                'subjek'    => $validated['subjek'],
                'pesan'     => $validated['pesan'],
                'is_read'   => false,
            ]);

            Log::info('Contact message created', ['id' => $contact->id]);

            return redirect()->back()
                ->with('success', 'Pesan terkirim! Kami akan balas via Email dalam 1x24 jam');
        } catch (\Exception $e) {
            Log::error('Contact message error', ['error' => $e->getMessage()]);
            
            return redirect()->back()
                ->with('error', 'Gagal mengirim pesan: ' . $e->getMessage())
                ->withInput();
        }
    }

    // ADMIN: Daftar Pesan Masuk
    public function adminIndex()
    {
        $messages = ContactMessage::with('user')
            ->latest()
            ->paginate(15);
        
        $unreadCount = ContactMessage::where('is_read', false)->count();

        return view('admin.contact.index', compact('messages', 'unreadCount'));
    }

    // ADMIN: Detail Pesan
    public function adminShow(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        
        return view('admin.contact.show', compact('message'));
    }

    // ADMIN: Kirim Balasan via Email
    public function adminReply(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'reply' => 'required|string|min:5|max:5000'
        ]);

        try {
            // Kirim email ke customer menggunakan Mailable
            Mail::to($message->email)->send(
                new ContactReplyMail($message->nama, $validated['reply'], $message->subjek)
            );

            // Simpan balasan ke database
            $message->update([
                'reply'      => $validated['reply'],
                'replied_at' => now(),
                'is_read'    => true,
            ]);

            Log::info('Reply sent via email', ['message_id' => $message->id]);

            return redirect()->route('contact.index')
                ->with('success', 'Balasan berhasil dikirim via Email!');
                
        } catch (\Exception $e) {
            Log::error('Contact reply error', ['error' => $e->getMessage()]);
            
            return redirect()->back()
                ->with('error', 'Gagal mengirim balasan: ' . $e->getMessage())
                ->withInput();
        }
    }
}