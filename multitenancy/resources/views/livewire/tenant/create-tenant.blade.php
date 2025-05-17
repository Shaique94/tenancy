<div>
    @if (session()->has('message'))
        <div class="text-green-600 mb-4">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="createTenant" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Tenant Name</label>
            <input type="text" wire:model="name" class="mt-1 block w-full" />
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Tenant ID (e.g. tenant1)</label>
            <input type="text" wire:model="id" class="mt-1 block w-full" />
            @error('id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Domain (e.g. tenant1.localhost)</label>
            <input type="text" wire:model="domain" class="mt-1 block w-full" />
            @error('domain') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
            Create Tenant
        </button>
    </form>
</div>
