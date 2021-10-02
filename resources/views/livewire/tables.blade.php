<div>
    <h1 class="text-2xl font-semibold text-gray-900 mb-8">Tables</h1>
    
    <div class="py-4 space-y-4">
        <div class="flex w-full">
            <div class="w-1/4">
                <input type="text" wire:model="search" class="border border-gray-300 p-2 rounded w-full" placeholder="Search Transactions...">
            </div>
        </div>
    <table class="text-center w-full rounded">
        <thead>
            <tr class="bg-gray-400">
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Title</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Amount</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
            </tr>
        </thead>
        <tbody class="bg-gray-50">
            @forelse($transactions as $transaction)
                <tr wire:loading.class.delay="opacity-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $transaction->title }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-gray-900 font-medium">${{ $transaction->amount }} </span> USD
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $transaction->status_color }}-100 text-{{ $transaction->status_color }}-800">
                            {{ $transaction->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $transaction->date_for_humans }}
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="4">
                    <div class="flex justify-center items-center">
                        <span class="py-4 text-gray-400 text-lg">No transactions found...</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $transactions->links() }}
    </div>
</div>
