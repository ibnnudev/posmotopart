@props(['backLink' => null, 'isLeft' => true])
<div class="mt-6 space-x-1 {{ !$isLeft ? 'text-center' : '' }}">
    <x-button fit type="submit">Simpan</x-button>
    <x-link-button title="Kembali" href="{{ $backLink }}" />
</div>
