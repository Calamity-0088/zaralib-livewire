<?php

use Livewire\Component;
use App\Models\Manga;

new class extends Component {
    public $id;
    public $formTitle, $formDescription;
    public $title, $synopsis, $author, $genre, $volumes, $chapters, $status, $rating, $start_date, $end_date, $cover_image;

    public function mount($id)
    {
        if ($id) {
            $manga = Manga::findOrFail($id);

            $this->title = $manga->title;
            $this->synopsis = $manga->synopsis;
            $this->author = $manga->author;
            $this->genre = $manga->genre;
            $this->volumes = $manga->volumes;
            $this->chapters = $manga->chapters;
            $this->status = $manga->status;
            $this->rating = $manga->rating;
            $this->start_date = $manga->start_date;
            $this->end_date = $manga->end_date;
            $this->cover_image = $manga->cover_image;
        }
    }

    public function delete()
    {
        $manga = Manga::findOrFail($this->id);
        Storage::disk('public')->delete($manga->cover_image);
        $manga->delete();

        return $this->redirect('/mangas', navigate: true);
    }
};
?>

<div class="flex justify-center p-8 text-zinc-200">
    <div class="flex flex-col gap-8 md:w-2/3">
        <div class="flex items-center justify-center gap-4 text-green-200 md:justify-start">
            <h1 class="text-3xl font-bold">{{ $title }}<span class="ml-4 text-lg">{{ $end_date }}</span></h1>
        </div>
        <div class="flex flex-col gap-8 md:flex-row md:items-start">
            <div class="flex flex-col gap-8 md:w-2/3">
                <div class="flex flex-col gap-8 md:flex-row">
                    <div class="h-70 flex items-start justify-center overflow-hidden rounded-md md:w-2/5">
                        <img class="h-full" src="{{ Storage::url($cover_image) }}" alt="">
                    </div>
                    <div class="md:w-3/5">
                        <p>{{ $synopsis }}</p>
                    </div>
                </div>
                <div class="flex gap-4 text-sm">
                    <flux:button class="grow bg-green-300 hover:bg-green-200 focus:bg-green-100"
                        href="{{ route('mangas.edit', $id) }} " variant="primary" wire:navigate>
                        {{ __('messages.actions.edit') }}</flux:button>
                    <flux:modal.trigger name="delete">
                        <flux:button class="grow bg-green-300 hover:bg-green-200 focus:bg-green-100"
                            x="Are you sure you want to delete this manga?" variant="primary">
                            {{ __('messages.actions.delete') }}
                        </flux:button>
                    </flux:modal.trigger>

                    <flux:modal name="delete">
                        <div class="flex flex-col gap-4">
                            <flux:heading size="lg">Delete manga</flux:heading>
                            <flux:text>Are you sure you want to delete this manga?</flux:text>
                            <flux:button wire:click="delete" variant="danger">Delete</flux:button>
                        </div>
                    </flux:modal>
                </div>
            </div>
            <flux:card class="flex w-full flex-col gap-6 rounded-md p-6 text-sm md:w-1/3">
                <flux:heading>{{ __('messages.manga.details') }}</flux:heading>
                <div class="flex flex-col gap-2">
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('messages.manga.author') }}:</span>
                        <p>{{ $author }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('messages.manga.volumes') }}:</span>
                        <p>{{ $volumes }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('messages.manga.chapters') }}:</span>
                        <p>{{ $chapters }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('messages.manga.status') }}:</span>
                        <p>{{ $status }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('messages.manga.published') }}:</span>
                        <p>{{ $start_date }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('messages.manga.completed') }}:</span>
                        <p>{{ $end_date }}</p>
                    </div>
            </flux:card>
        </div>
    </div>
</div>
</div>
