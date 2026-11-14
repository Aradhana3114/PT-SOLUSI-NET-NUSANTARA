<x-filament-panels::page>
    <style>
        /* Tanda sukses upload pada FilePond tidak ikut terbawa di beberapa build Filament. */
        .filepond--item[data-filepond-item-state="processing-complete"] .filepond--file-status-sub {
            color: rgb(22 163 74);
            font-weight: 600;
        }

        .filepond--item[data-filepond-item-state="processing-complete"] .filepond--file-status-sub::before {
            content: '✓';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.25rem;
            height: 1.25rem;
            margin-right: .35rem;
            border-radius: 9999px;
            background: rgb(22 163 74);
            color: white;
            font-size: .8rem;
            line-height: 1;
        }

        .filepond--item[data-filepond-item-state="processing-complete"] .filepond--file-status-main {
            color: rgb(22 163 74);
        }
    </style>

    <form wire:submit="save" class="space-y-6">
        {{ $this->form }}

        <x-filament::button type="submit">Simpan Perubahan</x-filament::button>
    </form>
</x-filament-panels::page>
