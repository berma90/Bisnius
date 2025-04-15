@extends('user.profile')

@section('history_content')
<div class="p-5 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Appreciate (Certificates)</h2>
    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">No</th>
                <th class="border p-2">Sertifikat</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Download</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($certificates as $index => $s)
                <tr class="border">
                    <td class="border p-2">{{ $index + 1 }}</td>
                    <td class="border p-2">Certificate for Quiz #{{ $s->path }}</td>
                    <td class="border p-2">{{ $s->created_at->format('d M Y') }}</td>
                    <td class="border p-2">
                        <a href="{{ asset('storage/' . str_replace('public/', '', $s->path)) }}"
                           class="text-blue-600 underline"
                           download>
                           Download
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

