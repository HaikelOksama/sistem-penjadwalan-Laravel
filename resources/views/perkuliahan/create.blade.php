<x-layout>
    <x-slot:title>Perkuliahan Baru</x-slot:title>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Perkuliahan Baru</h3>
                @if (Session::has('error'))
                    <code>{{ Session::get('error') }}</code>
                @endif
            </div>
            <div class="card-body">
                <livewire:perkuliahan-create />
            </div>
        </div>
    </div>
    <x-slot:livewire>@livewireScripts</x-slot:livewire>
</x-layout>