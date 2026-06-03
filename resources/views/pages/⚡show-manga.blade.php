<?php

use Livewire\Component;
use App\Models\Manga;
use Livewire\Attributes\Computed;

new class extends Component {
    public $id, $manga;

    public function mount($id)
    {
        if ($this->id) {
            $this->manga = Manga::findOrFail($this->id);
        }
    }

    #[Computed]
    public function hasManga()
    {
        return auth()->user()->mangas()->where('mangas.id', $this->id)->exists();
    }

    public function addToLibrary()
    {
        auth()->user()->mangas()->attach($this->id);
    }

    public function removeFromLibrary()
    {
        auth()->user()->mangas()->detach($this->id);
    }

    public function delete()
    {
        $this->authorize('update', $this->manga);

        if ($this->manga->cover_image) {
            Storage::disk('public')->delete($this->manga->cover_image);
        }
        $this->manga->delete();

        return $this->redirect('/mangas', navigate: true);
    }

    public function render()
    {
        return $this->view()->title($this->manga->title);
    }
};
?>

<div class="flex justify-center py-8 dark:text-zinc-200">
    <div class="flex flex-col gap-8 md:w-2/3">
        <div class="flex items-center justify-center gap-4 text-green-500 md:justify-start dark:text-green-200">
            <h1 class="text-3xl font-bold">{{ $manga->title }}<span class="ml-4 text-lg">{{ $manga->end_date }}</span></h1>
        </div>
        <div class="flex flex-col gap-8 md:flex-row md:items-start">
            <div class="flex flex-col gap-8 md:w-2/3">
                <div class="flex flex-col gap-8 md:flex-row">
                    <div class="h-70 flex flex-col items-center gap-4 overflow-hidden rounded-md md:w-2/5">
                        <img class="h-full" src="{{ Storage::url($manga->cover_image) }}" alt="">
                        @if ($this->hasManga)
                            <flux:modal.trigger name="edit-entry">
                                <flux:button class="dark:text-green-200! text-green-500! w-full grow" variant="ghost" size="sm">
                                    {{ __('manga.actions.edit_entry') }}</flux:button>
                            </flux:modal.trigger>
                        @endif
                    </div>

                    <div class="md:w-3/5">
                        <p>{{ $manga->synopsis }}</p>
                    </div>
                </div>
                {{-- * Buttons --}}
                <div class="flex flex-wrap gap-4">
                    <div class="flex w-full gap-4">
                        @if ($this->hasManga)
                            <flux:button
                                class="grow bg-green-600 hover:bg-green-700 dark:bg-green-300 dark:hover:bg-green-200 dark:focus:bg-green-100"
                                variant="primary" wire:click="removeFromLibrary">
                                {{ __('manga.actions.delete_library') }}
                            </flux:button>
                        @else
                            <flux:button
                                class="grow bg-green-600 hover:bg-green-700 dark:bg-green-300 dark:hover:bg-green-200 dark:focus:bg-green-100"
                                variant="primary" wire:click="addToLibrary">
                                {{ __('manga.actions.add_library') }}
                            </flux:button>
                        @endif
                    </div>

                    @can('update', $manga)
                        <div class="flex w-full gap-4">
                            <flux:button class="grow bg-green-600 hover:bg-green-700 dark:bg-green-300 dark:hover:bg-green-200 dark:focus:bg-green-100"
                                href="{{ route('mangas.edit', $id) }} " variant="primary" wire:navigate>
                                {{ __('manga.actions.edit') }}</flux:button>
                            <flux:modal.trigger name="delete">
                                <flux:button class="grow bg-green-600 hover:bg-green-700 focus:bg-green-100 dark:bg-green-300 dark:hover:bg-green-200"
                                    variant="primary">
                                    {{ __('manga.actions.delete') }}
                                </flux:button>
                            </flux:modal.trigger>
                        </div>

                        <flux:modal name="delete">
                            <div class="flex flex-col gap-4">
                                <flux:heading size="lg">{{ __('manga.actions.delete') }}</flux:heading>
                                <flux:text>{{ __('manga.form.delete_confirm') }}</flux:text>
                                <flux:button wire:click="delete" variant="danger">{{ __('manga.actions.delete') }}</flux:button>
                            </div>
                        </flux:modal>
                    @endcan
                </div>
            </div>

            <flux:card class="flex w-full flex-col gap-6 rounded-md p-6 text-sm md:w-1/3">
                <flux:heading>{{ __('manga.details') }}</flux:heading>
                <div class="flex flex-col gap-2">
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('manga.author') }}:</span>
                        <p>{{ $manga->author }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('manga.volumes') }}:</span>
                        <p>{{ $manga->volumes }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('manga.chapters') }}:</span>
                        <p>{{ $manga->chapters }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('manga.status') }}:</span>
                        <p>{{ __("manga.publication_status.$manga->status") }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('manga.published') }}:</span>
                        <p>{{ $manga->start_date }}</p>
                    </div>
                    <div class="flex gap-4">
                        <span class="w-2/5">{{ __('manga.completed') }}:</span>
                        <p>{{ $manga->end_date }}</p>
                    </div>
            </flux:card>
        </div>
    </div>
    <livewire:edit-entry :id=$id></livewire:edit-entry>
</div>
