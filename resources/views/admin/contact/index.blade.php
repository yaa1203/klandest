@extends('admin.layouts.app')
@section('title', 'Pesan Masuk - Admin')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Pesan Masuk dari Pelanggan</h1>
    @if($unreadCount > 0)
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6">
            Ada {{ $unreadCount }} pesan belum dibaca!
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dari</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subjek</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($messages as $msg)
                <tr class="{{ !$msg->is_read ? 'bg-yellow-50' : '' }}">
                    <td class="px-6 py-4 text-sm">
                        <div class="font-medium">{{ $msg->nama }}</div>
                        <div class="text-gray-500">{{ $msg->whatsapp }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $msg->subjek }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $msg->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        @if(!$msg->is_read)
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Belum Dibaca</span>
                        @elseif($msg->reply)
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">Sudah Dibalas</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">Dibaca</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('contact.show', $msg) }}" class="text-blue-600 hover:underline">Lihat & Balas</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>
@endsection