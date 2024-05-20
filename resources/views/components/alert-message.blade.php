@if (session('success'))
    <div class="text-medium text-green-600 space-y-1 text-center mt-4">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if (session('errors'))
    <div class="text-medium text-red-600 space-y-1 text-center mt-4">
        <strong class="font-bold">Error!</strong>
        <ul>
            @foreach (session('errors')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
