@if ($transactions->count() > 0)
    <table class="w-full text-medium text-left- rtl:text-right text-gray-500">
        <thead class="text-medium text-gray-700 uppercase bg-gray-50 border-b-2 border-gray-500">
            <tr class="text-nowrap">
                <th class="px-3 py-2 text-center">Date</th>
                <th class="px-3 py-2 text-center">Type</th>
                <th class="px-3 py-2 text-center">Amount</th>
                <th class="px-3 py-2 text-center">Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr class="bg-white border-b">
                    <td class="px-3 py-2 text-center text-sm">
                        {{ $transaction->created_at->format('M d, Y') }}</td>
                    <td class="px-3 py-2 text-center text-sm">{{ $transaction->transaction_type }}</td>
                    <td class="px-3 py-2 text-center text-sm">${{ $transaction->amount }}</td>
                    <td class="px-3 py-2 text-center text-sm">{{ $transaction->description ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
    
@else
    <p class="mb-4 text-center text-xl text-red-600 underline">No transactions found.</p>
@endif
