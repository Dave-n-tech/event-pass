@extends('layouts.dashboard')

@section('content')
    <a href="{{ route('dashboard.event-details', $event) }}" class="my-4 text-indigo-600 hover:text-indigo-800 font-medium">
        < back</a>
            <div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
                <h1 class="mx-auto font-bold text-2xl mb-4">Checkout</h1>
                <h2 class="text-xl font-semibold mb-4">Register for {{ $event->title }}</h2>
                <img src="{{ $event->display_image ?? 'https://via.placeholder.com/1200x400' }}" alt="{{ $event->title }}"
                    class="w-full h-72 object-cover rounded-t-lg mb-4">

                <div class="mb-4 p-4 bg-gray-100 rounded shadow">
                    <p class="text-lg font-semibold text-gray-700">
                        Wallet Balance: ₦<span id="wallet-balance">{{ number_format($walletBalance, 2) }}</span>
                    </p>
                </div>


                <form method="POST" action="{{ route('tickets.store', $event) }}">
                    @csrf

                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Number of Tickets</label>
                        <input type="number" name="quantity" id="ticket_quantity" min="1" value="1"
                            class="mt-1 block w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Price per ticket: ₦<span
                                id="ticket-price">{{ number_format($ticketPrice, 2) }}</span></p>
                    </div>

                    <div class="mb-4">
                        <p class="font-semibold">Total Amount: ₦<span
                                id="total-amount">{{ number_format($ticketPrice, 2) }}</span></p>
                        <p id="error-message" class="text-red-600 font-medium hidden">Insufficient wallet balance.</p>
                    </div>

                    <button type="submit" id="checkout-button" class="bg-blue-600 text-white px-4 py-2 rounded">Complete
                        Registration</button>
                </form>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ticketInput = document.getElementById('ticket_quantity');
                    const ticketPrice = {{ $ticketPrice }};
                    const walletBalance = {{ $walletBalance }};
                    const totalAmountEl = document.getElementById('total-amount');
                    const checkoutButton = document.getElementById('checkout-button');
                    const errorMessage = document.getElementById('error-message');

                    function updateTotal() {
                        let quantity = parseInt(ticketInput.value) || 0;
                        let total = quantity * ticketPrice;

                        totalAmountEl.textContent = total.toLocaleString();

                        if (total > walletBalance) {
                            checkoutButton.disabled = true;
                            errorMessage.classList.remove('hidden');
                        } else {
                            checkoutButton.disabled = false;
                            errorMessage.classList.add('hidden');
                        }
                    }

                    ticketInput.addEventListener('input', updateTotal);
                    updateTotal();
                });
            </script>
        @endsection
