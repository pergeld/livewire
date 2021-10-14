<div>
    <button wire:click="$toggle('showModal')" class="flex items-center space-x-2">Import</button>

    <form wire:submit.prevent="import">
        <x-modal.modal wire:model="showModal">
            <x-slot name="title">Import Transactions</x-slot>

            <x-slot name="content">
                @unless ($upload)
                    <div class="py-12 flex flex-col items-center justify-center">
                        <div class="flex items-center space-x-2 text-xl">
                            <input type="text" wire:model="upload" id="upload">
                        </div>
                        @error('upload') <div class="mt-3 text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>
                @else
                    <div>
                        <div class="group">
                            <select wire:model="fieldColumnMap.title" id="title">
                                <option value="" disabled>Select Column...</option>
                                @foreach ($columns as $column)
                                    <option>{{ $column }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="group">
                            <select wire:model="fieldColumnMap.amount" id="amound">
                                <option value="" disabled>Select Column...</option>
                                @foreach ($columns as $column)
                                    <option>{{ $column }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="group">
                            <select wire:model="fieldColumnMap.status" id="status">
                                <option value="" disabled>Select Column...</option>
                                @foreach ($columns as $column)
                                    <option>{{ $column }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="group">
                            <select wire:model="fieldColumnMap.date" id="date">
                                <option value="" disabled>Select Column...</option>
                                @foreach ($columns as $column)
                                    <option>{{ $column }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
            </x-slot>

            <x-slot name="footer">
                <a wire:click="$set('showModal', false)" class="py-2 px-6 bg-red-100 text-red-700 border border-red-700 rounded">Cancel</a>
                <button type="submit" class="bg-red-600 text-red-100 py-2 px-8 ml-4 rounded">Import</button>
            </x-slot>
        </x-modal.modal>
    </form>
</div>