<div>
    <ul drag-root="reorder" class="overflow-hidden rounded shadow divide-y">
        @foreach($things as $thing)
            <li drag-item="{{ $thing['id'] }}" draggable="true" wire:key="{{ $thing['id'] }}" class="w-64 p-4 bg-white">
                {{ $thing['title'] }}
            </li>
        @endforeach
    </ul>
</div>