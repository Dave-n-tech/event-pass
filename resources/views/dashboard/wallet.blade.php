@extends('layouts.dashboard')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">My Wallet</h1>

            @if (session('success'))
                <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Wallet Balance Card --}}
            <div x-data="{ showBalance: true }" class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Wallet Balance</h2>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Your current available balance</p>
                    </div>
                    <button @click="showBalance = !showBalance"
                        class="inline-flex items-center p-1 border border-transparent rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg x-show="showBalance" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-1.216.216-2.383.612-3.469M4.318 4.318L19.682 19.682M9.879 9.879A3 3 0 0112 9c1.657 0 3 1.343 3 3 0 .414-.084.808-.236 1.168" />
                        </svg>
                        <svg x-show="!showBalance" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-3xl font-bold text-gray-900">
                                <span x-text="showBalance ? '{{ number_format($wallet->balance, 2) }}' : '••••••'"></span>
                            </p>
                            <p class="mt-1 text-sm text-gray-500">Available Balance</p>
                        </div>

                        <a href="{{ route('wallet.fund') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Funds
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Wallet Transactions</h2>

                @if ($transactions->count())
                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-gray-200 text-gray-700">
                                <tr>
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2">Type</th>
                                    <th class="px-4 py-2">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800">
                                @foreach ($transactions as $txn)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $txn->created_at->format('d M Y, h:i A') }}</td>
                                        <td class="px-4 py-2 capitalize">{{ $txn->type }}</td>
                                        <td class="px-4 py-2">&#8358;{{ number_format($txn->amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600">No transactions found yet.</p>
                @endif
            </div>



        </div>
    </div>
@endsection
