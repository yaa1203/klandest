@extends('admin.layouts.app')
@section('title', 'Balas Pesan')

@section('content')
<div class="p-6 max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">Balas Pesan dari {{ $message->nama }}</h1>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><strong>Nama:</strong> {{ $message->nama }}</div>
            <div><strong>Email:</strong> {{ $message->email }}</div>
            <div><strong>WhatsApp:</strong> {{ $message->whatsapp }}</div>
            <div><strong>Waktu:</strong> {{ $message->created_at->format('d M Y H:i') }}</div>
        </div>
        <hr class="my-4">
        <p class="text-lg"><strong>Subjek:</strong> {{ $message->subjek }}</p>
        <p class="mt-4 whitespace-pre-wrap">{{ $message->pesan }}</p>
    </div>

    @if($message->reply)
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
            <p class="font-bold text-green-800 mb-2">Balasan Anda:</p>
            <p class="whitespace-pre-wrap">{{ $message->reply }}</p>
            <small class="text-green-600">Dibalas pada {{ $message->replied_at->format('d M Y H:i') }}</small>
        </div>
    @else
        <form action="{{ route('contact.reply', $message) }}" method="POST">
            @csrf
            <textarea name="reply" rows="8" required placeholder="Tulis balasan di sini... (akan kami kirim via WhatsApp)"
                      class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-black"></textarea>
            <button type="submit" class="mt-4 bg-black text-white px-8 py-3 rounded-lg font-bold hover:bg-gray-800">
                Kirim Balasan
            </button>
        </form>
    @endif
</div>
@endsection