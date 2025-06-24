@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    <!-- Heading -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">User List</h2>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="mb-6 grid grid-cols-1 sm:grid-cols-4 gap-4 bg-white p-4 rounded-xl shadow">
        <div class="sm:col-span-2">
            <input type="text" name="search" placeholder="Search name/email" value="{{ request('search') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
        </div>
        <div>
            <select name="verified"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                <option value="">All</option>
                <option value="yes" {{ request('verified') == 'yes' ? 'selected' : '' }}>Verified</option>
                <option value="no" {{ request('verified') == 'no' ? 'selected' : '' }}>Unverified</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit"
                class="w-full bg-purple-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                Filter
            </button>
            <a href="{{ route('users.index') }}"
                class="w-full text-center bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                Reset
            </a>
        </div>
    </form>

    <!-- Hasil Info -->
    <div class="mb-4 text-sm text-gray-600">
        Hasil: <strong>{{ $users->total() }}</strong> user ditemukan
    </div>

    <!-- User Table -->
    <div class="overflow-x-auto bg-white shadow rounded-xl">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-300 text-gray-700 text-xs font-semibold uppercase">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Verified</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @if ($user->email_verified_at)
                            <span class="text-green-600 font-bold">✔ Verified</span>
                        @else
                            <span class="text-red-500 font-bold">❌ Unverified</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-gray-500 text-center">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->withQueryString()->links() }}
    </div>

</div>
@endsection
