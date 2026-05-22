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

<form wire:submit="save">
    <flux:card class="flex flex-col gap-8">
        <div class="flex flex-col gap-4">
            <flux:select label="Estado" wire:model="status">
                <flux:select.option value="reading">reading</flux:select.option>
                <flux:select.option value="pending">pending</flux:select.option>
                <flux:select.option>completed</flux:select.option>
                <flux:select.option>pause</flux:select.option>
                <flux:select.option>abandoned</flux:select.option>
            </flux:select>
            <flux:select label="Calificación" wire:model="rating">
                @for ($i = 1; $i <= 10; $i = $i + 0.5)
                    <flux:select.option>{{ $i }}</flux:select.option>
                @endfor
            </flux:select>
        </div>

        <flux:button type="submit">{{ __('messages.actions.save') }}</flux:button>
    </flux:card>
</form>
