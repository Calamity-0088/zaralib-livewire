<?php

use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Manga;

new class extends Component {
    #[Url]
    public $query;

    #[Computed]
    public function mangas()
    {
        if ($this->query) {
            return Manga::where('title', 'like', "%$this->query%")->get();
        }
        return Manga::all();
    }
};
?>

<div class="flex flex-col gap-8">
    <div class="flex w-full items-center justify-between">
        <flux:heading class="font-bold! text-green-200" size="xl" level="1">{{ __('messages.ui.title') }} </flux:heading>
        <flux:button class="bg-green-300 hover:bg-green-200" href="{{ route('mangas.create') }}" variant="primary" wire:navigate>
            {{ __('messages.actions.add') }}</flux:button>
    </div>
    @if ($this->mangas->count() > 0)
        <div class="flex w-full flex-wrap gap-4 dark:text-zinc-200">
            @foreach ($this->mangas as $manga)
                <flux:card class="h-60 w-2/5 shrink grow overflow-hidden rounded-md bg-zinc-900 p-0 md:w-40">
                    <div class="relative h-4/5">
                        <a class="absolute inset-0 hover:bg-black/25" href="{{ route('mangas.show', $manga->id) }}" wire:navigate></a>
                        <img class="h-full w-full object-cover" src="{{ Storage::url($manga->cover_image) }}" alt="">
                        <a class="absolute right-2 top-2 rounded-md border-green-200 bg-transparent p-2 text-green-200"
                            href="{{ route('mangas.edit', $manga->id) }}"><i data-lucide="square-pen"></i></a>
                    </div>
                    <div class="flex h-1/5 w-full items-center gap-2 p-3 text-xs">
                        <span class="w-2/3 truncate">{{ $manga->title }}</span>
                        <div class="flex w-1/3 items-center justify-end gap-2">
                            <i class="size-3 shrink-0" data-lucide="star"></i>
                            <span class="text-green-200">{{ $manga->rating }}</span>
                        </div>
                    </div>
                </flux:card>
            @endforeach
        </div>
    @else
        <p class="dark:text-zinc-200">No hay mangas disponibles.</p>
    @endif
</div>
