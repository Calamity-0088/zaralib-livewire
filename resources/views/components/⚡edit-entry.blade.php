<?php

use Livewire\Component;

new class extends Component {
    public $id;
    public $rating = 1,
        $status = 'reading';

    public function mount()
    {
        $mangaLibrary = auth()->user()->mangas()->where('mangas.id', $this->id)->first();
        if ($mangaLibrary) {
            $this->rating = $mangaLibrary->pivot->rating;
            $this->status = $mangaLibrary->pivot->status;
        }
    }

    public function save()
    {
        auth()
            ->user()
            ->mangas()
            ->updateExistingPivot($this->id, [
                'rating' => $this->rating,
                'status' => $this->status,
            ]);

        Flux::modal('edit-entry')->close();
    }
};
?>

<flux:modal name=edit-entry>
    <div class="flex flex-col gap-6">
        <flux:heading>{{ __('manga.actions.edit_entry') }}</flux:heading>
        <form wire:submit="save">
            <flux:card class="flex flex-col gap-8">
                <div class="flex flex-col gap-4">
                    <flux:select label="{{ __('manga.status') }}" wire:model="status">
                        <flux:select.option value="reading">{{ __('manga.reading_status.reading') }}</flux:select.option>
                        <flux:select.option value="pending">{{ __('manga.reading_status.pending') }}</flux:select.option>
                        <flux:select.option value="completed">{{ __('manga.reading_status.completed') }}</flux:select.option>
                        <flux:select.option value="paused">{{ __('manga.reading_status.paused') }}</flux:select.option>
                        <flux:select.option value="abandoned">{{ __('manga.reading_status.abandoned') }}</flux:select.option>
                    </flux:select>
                    <flux:select label="{{ __('manga.rating') }}" wire:model="rating">
                        @for ($i = 1; $i <= 10; $i = $i + 0.5)
                            <flux:select.option>{{ $i }}</flux:select.option>
                        @endfor
                    </flux:select>
                </div>

                <flux:button class="bg-green-600 hover:bg-green-700 dark:bg-green-300 dark:hover:bg-green-200" type="submit" variant="primary">
                    {{ __('common.actions.save') }}</flux:button>
            </flux:card>
        </form>
    </div>
</flux:modal>
