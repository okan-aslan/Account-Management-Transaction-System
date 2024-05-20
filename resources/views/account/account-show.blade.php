<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <x-alert-message />

                <div class="p-6 text-gray-900">

                    <div class="max-w-lg mx-auto border- shadow-lg rounded-lg overflow-hidden">
                        <div class="px-6 py-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Account Number:</label>
                                <p class="text-gray-900">{{ $account->account_no }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                <p class="text-gray-900">{{ $account->title }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Balance:</label>
                                <p class="text-gray-900">${{ $account->balance }}</p>
                            </div>
                            <form action="{{ route('accounts.destroy', $account->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>
                                    Delete Account
                                </x-danger-button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            @include('transaction.transactions-show')

            
        </div>
    </div>
</x-app-layout>
