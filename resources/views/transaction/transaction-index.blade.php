<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <x-alert-message />

                <div class="p-6 text-gray-900">
                    <form action="{{ route('transactions.store') }}" method="POST"
                        class="p-6 bg-white shadow-md rounded-lg">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="account_no" class="block text-gray-700">Select an
                                account</x-input-label>
                            <select name="account_no" id="account_no"
                                class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->account_no }}">{{ $account->title }} - ${{$account->balance}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="transaction_type" class="block text-gray-700 mt-4">Transaction
                                type</x-input-label>
                            <select name="transaction_type" id="transaction_type"
                                class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                                <option value="income">Income</option>
                                <option value="expense">Expense</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="amount" class="block text-gray-700">Amount</x-input-label>
                            <input type="number" name="amount" id="amount"
                                class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                                required>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" class="block text-gray-700">Description</x-input-label>
                            <textarea name="description" id="description" rows="3"
                                class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>
                                Submit
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
