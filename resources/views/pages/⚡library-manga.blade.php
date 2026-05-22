<?php

use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component {
    #[Computed]
    public function libraryMangas()
    {
        return auth()->user()->mangas()->get();
    }
};
?>

<div class="flex flex-col gap-8">
    <div class="flex w-full items-center justify-between">
        <flux:heading class="font-bold! text-green-200" size="xl" level="1">{{ __('Mi biblioteca') }} </flux:heading>
    </div>
    @if ($this->libraryMangas->count() > 0)
        <div class="flex w-full flex-wrap gap-4 dark:text-zinc-200">
            @foreach ($this->libraryMangas as $manga)
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
                            <span class="text-green-200">{{ $manga->pivot->rating ?? 'N/A' }}</span>
                        </div>
                    </div>
                </flux:card>
            @endforeach
        </div>
    @else
        <p class="dark:text-zinc-200">No hay mangas disponibles.</p>
    @endif
</div>
