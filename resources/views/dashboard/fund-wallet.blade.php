@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('dashboard.wallet') }}" class="text-indigo-600 hover:underline mb-4 inline-block">
            ← Back to wallet
        </a>
    <div class="max-w-md mx-auto mt-10 bg-white shadow p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Fund Your Wallet</h2>

        <form action="{{ route('wallet.fund.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount (₦)</label>
                <input type="number" name="amount" id="amount" required min="100"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 transition">Fund
                Wallet</button>
        </form>
    </div>
@endsection
