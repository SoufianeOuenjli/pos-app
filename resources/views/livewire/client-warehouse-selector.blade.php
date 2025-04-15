<div class="row g-2 mb-3">
    <div class="col-6">
        <select class="form-select" wire:model="client"  wire:change='handleClient()'>
            <option value="null">Selecter Client</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6">
        <select class="form-select" disabled>
            <option>Depos Soon...</option>
        </select>
    </div>
</div>
