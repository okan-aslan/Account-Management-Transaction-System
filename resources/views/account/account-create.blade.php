<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <x-alert-message />

                <div class="p-6 text-gray-900">

                    <form action="{{ route('accounts.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="title" class="mb-4">Hesap Başlığı</x-input-label>
                            <x-text-input type="text" id="title" name="title" />
                        </div>
                        <x-primary-button>Hesap Oluştur</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
