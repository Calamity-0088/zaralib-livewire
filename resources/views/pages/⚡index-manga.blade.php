<?php

use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Manga;

new class extends Component {
    use WithPagination;

    #[Url]
    public $query;

    #[Computed]
    public function mangas()
    {
        if ($this->query) {
            return Manga::where('title', 'like', "%$this->query%")->paginate(25);
        }
        return Manga::paginate(25);
    }

    public function mangaEntry($mangaId)
    {
        return auth()->user()->mangas()->where('mangas.id', $mangaId)->first();
    }

    public function render()
    {
        return $this->view()->title(__('navigation.index'));
    }
};
?>

<div class="flex flex-col gap-8">
    <div class="flex w-full items-center justify-between">
        <flux:heading class="font-bold! text-green-500 dark:text-green-200" size="xl" level="1">{{ __('navigation.index') }} </flux:heading>
        @can('create', Manga::class)
            <flux:button class="bg-green-600 hover:bg-green-200 dark:bg-green-300" href="{{ route('mangas.create') }}" variant="primary" wire:navigate>
                {{ __('manga.actions.add') }}</flux:button>
        @endcan
    </div>
    @if ($this->mangas->count() > 0)
        <div class="flex w-full flex-wrap gap-4 dark:text-zinc-200">
            @foreach ($this->mangas as $manga)
                <flux:card class="h-60 w-2/5 shrink grow overflow-hidden rounded-md bg-zinc-50 p-0 md:w-40 dark:bg-zinc-900">
                    <div class="relative h-4/5">
                        <a class="absolute inset-0 hover:bg-black/25" href="{{ route('mangas.show', $manga->id) }}" wire:navigate></a>
                        <img class="h-full w-full object-cover" src="{{ Storage::url($manga->cover_image) }}" alt="">
                        <a class="absolute right-2 top-2 rounded-md border-green-200 bg-transparent p-2 text-green-200"
                            href="{{ route('mangas.edit', $manga->id) }}"><i data-lucide="square-pen"></i></a>
                    </div>
                    <div class="flex h-1/5 w-full items-center gap-2 p-3 text-xs">
                        <span class="truncate">{{ $manga->title }}</span>
                    </div>
                </flux:card>
            @endforeach
        </div>
        <flux:pagination :paginator="$this->mangas" />
    @else
        <p class="dark:text-zinc-200">{{ __('manga.empty') }}</p>
    @endif
</div>
