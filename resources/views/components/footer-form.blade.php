@props(['backLink' => null, 'isLeft' => true, 'backButton' => true])
<div class="mt-6 space-x-1 {{ !$isLeft ? 'text-center' : '' }}">
    <x-button fit type="submit">Simpan</x-button>
    @if ($backButton)
        <x-link-button title="Kembali" href="{{ $backLink }}" />
    @endif
</div>
