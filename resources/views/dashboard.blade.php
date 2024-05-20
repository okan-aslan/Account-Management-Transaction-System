<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Management & Transaction System') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <x-alert-message />

                <div class="p-6 text-gray-900">
                    <div class="container mx-auto px-4 py-8">
                        <div class="max-w-lg mx-auto bg-white rounded-lg overflow-hidden shadow-md mt-4">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-4">Overview</h2>
                                <p class="text-gray-700 leading-relaxed">
                                    Welcome to the Account Management System! This system allows users to manage their
                                    finances
                                    efficiently by providing features such as multiple account management, transaction
                                    tracking, and
                                    payment plans.
                                </p>
                            </div>
                        </div>

                        <div class="max-w-lg mx-auto bg-white rounded-lg overflow-hidden shadow-md mt-4">
                            <div class="">
                                <div class="p-4">
                                    <h2 class="text-xl font-semibold mb-4">Features</h2>
                                    <ul class="text-gray-700">
                                        <li class="mb-2">
                                            <span class="font-semibold">User Authentication:</span> Login or register to
                                            access your
                                            accounts.
                                        </li>
                                        <li class="mb-2">
                                            <span class="font-semibold">Account Management:</span> Create and manage
                                            multiple accounts
                                            with ease.
                                        </li>
                                        <li class="mb-2">
                                            <span class="font-semibold">Transaction Management:</span> Track income and
                                            expenses for
                                            each account.
                                        </li>
                                        <li class="mb-2">
                                            <span class="font-semibold">Payment Plans:</span> Set up weekly or monthly
                                            payment plans
                                            for financial goals.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
