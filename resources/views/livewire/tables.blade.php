<div>
    <h1 class="text-2xl font-semibold text-gray-900 mb-8">Tables</h1>
    
    <div class="py-4 space-y-4">
        <div class="flex justify-between items-center w-full">
            <div class="w-1/4">
                <input type="text" wire:model="filters.search" class="border border-gray-300 p-2 rounded w-full" placeholder="Search Transactions...">
            </div>
            <div>
                <button wire:click="$toggle('showFilters')">@if ($showFilters) Hide @endif Advanced Search...</button>
            </div>
            <div>
                <button wire:click="exportSelected" class="bg-yellow-600 text-yellow-100 p-2 mr-4 rounded">Export</button>
                <button wire:click="deleteSelected" class="bg-green-600 text-green-100 p-2 ml-4 rounded">Delete</button>
            </div>
            <div>
                <button wire:click="create" class="bg-blue-600 text-blue-100 p-2 ml-4 rounded">+ New</button>
            </div>
        </div>
    </div>

    <div>
        @if ($showFilters)
            <div class="bg-gray-200 p-4 rounded shadow-inner flex relative">
                <div class="w-1/2 pr-2 space-y-4">
                    <div>
                        <label for="filter-status">Status</label>
                        <select wire:model="filters.status" id="filter-status">
                            <option value="" disabled>Select Status...</option>

                            @foreach(App\Models\Transaction::STATUSES as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="filter-amount-min">Minimum Amount</label>
                        <input type="text" wire:model.lazy="filters.amount-min" id="filter-amount-min">
                    </div>

                    <div>
                        <label for="filter-amount-max">Maximum Amount</label>
                        <input type="text" wire:model.lazy="filters.amount-max" id="filter-amount-max">
                    </div>
                </div>

                <div class="w-1/2 pl-2 space-y-4">
                    <div>
                        <label for="filter-date-min">Minimum Date</label>
                        <input type="date" wire:model="filters.date-min" id="filter-date-min" placeholder="MM/DD/YYYY">
                    </div>

                    <div>
                        <label for="filter-date-max">Maximum Date</label>
                        <input type="date" wire:model="filters.date-max" id="filter-date-max" placeholder="MM/DD/YYYY">
                    </div>

                    <button wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</button>
                </div>
            </div>
        @endif
    </div>

    <div class="flex-col space-y-4">
    <table class="text-center w-full rounded">
        <thead>
            <tr class="bg-gray-400">
                <th><input type="checkbox"></th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Title</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Amount</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="bg-gray-50">
            @forelse($transactions as $transaction)
                <tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $transaction->id }}">
                    <td>
                        <input type="checkbox" wire:model="selected" value="{{ $transaction->id }}">
                    </td>
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
                    <td>
                        <button wire:click="edit({{ $transaction->id }})">Edit</button>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="5">
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

    <form wire:submit.prevent="save">
        <x-modal.modal wire:model.defer="showEditModal">
            <x-slot name="title">Edit transaction</x-slot>
            <x-slot name="content">
                <div class="flex flex-col w-full">

                    <div class="flex justify-between items-center w-full mb-4">
                        <label for="title">Title</label>
                        <input
                            type="text"
                            id="title"
                            wire:model.lazy="editing.title"
                            placeholder="Title"
                            class="border border-gray-400 p-1 mx-4 rounded w-3/4"
                            required
                        >
                    </div>

                    <div class="flex justify-between items-center w-full mb-4">
                        <label for="amount">Amount</label>
                        <input
                            type="text"
                            id="amount"
                            wire:model.lazy="editing.amount"
                            placeholder="Amount"
                            class="border border-gray-400 p-1 mx-4 rounded w-3/4"
                            required
                        >
                    </div>

                    <div class="flex justify-between items-center w-full mb-4">
                        <label for="status">Status</label>
                        <select wire:model.lazy="editing.status" id="status" class="border border-gray-400 p-1 mx-4 rounded w-3/4">
                            @foreach (App\Models\Transaction::STATUSES as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-between items-center w-full mb-4">
                        <label for="date_for_editing">Date</label>
                        <input
                            type="date"
                            id="date_for_editing"
                            wire:model="editing.date_for_editing"
                            class="border border-gray-400 p-1 mx-4 rounded w-3/4"
                        >
                    </div>

                </div>
            </x-slot>
            <x-slot name="footer">
                <button wire:click="$set('showEditModal', false)" class="py-2 px-6 bg-red-100 text-red-700 border border-red-700 rounded">Cancel</button>
                <button type="submit" class="bg-blue-600 text-blue-100 py-2 px-8 ml-4 rounded">Save</button>
            </x-slot>
        </x-modal.modal>
    </form>
</div>
