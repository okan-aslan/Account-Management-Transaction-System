<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Accounts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <x-alert-message />

                <div class="p-6 text-gray-900">

                    <div class="container mx-auto">

                        <div class="flex flex-row justify-between items-center mb-4">
                            <a href="{{ route('accounts.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-opacity-70">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v10a6 6 0 0 1-6 6H4a2 2 0 0 0-2-2V4a2 2 0 0 0 2-2h8a2 2 0 0 0 2 2v4a6 6 0 0 1-6-6z">
                                    </path>
                                </svg>
                                Create New Account
                            </a>
                        </div>
                        @if (auth()->user()->accounts->isNotEmpty())

                            <div class="overflow-x-auto sm:overflow-auto">
                                <table class="table-auto w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2">Account No</th>
                                            <th class="px-4 py-2">Account Name</th>
                                            <th class="px-4 py-2">Balance</th>
                                            <th class="px-4 py-2">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($accounts as $account)
                                            <tr>
                                                <td class="px-4 py-2 text-center">
                                                    <div> {{ $account->account_no }} </div>
                                                </td>
                                                <td class="px-4 py-2 text-center">
                                                    <div> {{ $account->title }} </div>
                                                </td>
                                                <td class="px-4 py-2 text-center">
                                                    <div> ${{ $account->balance }} </div>
                                                </td>
                                                <td class="px-4 py-2 text-center">
                                                    <a href="{{ route('accounts.show', $account->id) }}">Go Details</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div>
                                <p class="text-red-600 italic text-medium underline">You do not have any accounts yet !
                                </p>
                            </div>
                        @endif

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
