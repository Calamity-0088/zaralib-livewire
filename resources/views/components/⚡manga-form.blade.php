<?php

use Livewire\Component;
use App\Models\Manga;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    public $id, $manga;
    public $formTitle, $formDescription;
    #[Validate('required|string|min:3')]
    public $title;

    #[Validate('nullable|string|min:3')]
    public $synopsis;

    #[Validate('required|string|min:3')]
    public $author;

    #[Validate('required|string|min:3')]
    public $genre;

    #[Validate('nullable|integer|max:1000')]
    public $volumes;

    #[Validate('nullable|integer|max:10000')]
    public $chapters;

    #[Validate('required|in:ongoing,completed,hiatus,cancelled')]
    public $status = 'ongoing';

    #[Validate('nullable|date')]
    public $start_date;

    #[Validate('nullable|date')]
    public $end_date;

    public $current_cover;

    #[Validate('nullable|image|max:5120')]
    public $new_cover;

    public function mount($id = null)
    {
        if ($this->id) {
            $this->manga = Manga::findOrFail($this->id);

            $this->fill($this->manga->toArray());
            $this->current_cover = $this->manga->cover_image;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->manga) {
            $this->authorize('update', $this->manga);

            if ($this->new_cover && $this->current_cover) {
                Storage::disk('public')->delete($this->current_cover);
            }

            $this->manga->update([
                'title' => $this->title,
                'synopsis' => $this->synopsis,
                'author' => $this->author,
                'genre' => $this->genre,
                'volumes' => $this->volumes,
                'chapters' => $this->chapters,
                'status' => $this->status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'cover_image' => $this->new_cover ? $this->new_cover->store(path: 'images', options: 'public') : $this->current_cover,
            ]);

            return $this->redirect("/mangas/$this->id", navigate: true);
        } else {
            $this->authorize('create', Manga::class);

            Manga::create([
                'title' => $this->title,
                'synopsis' => $this->synopsis,
                'author' => $this->author,
                'genre' => $this->genre,
                'volumes' => $this->volumes,
                'chapters' => $this->chapters,
                'status' => $this->status,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'cover_image' => $this->new_cover ? $this->new_cover->store(path: 'images', options: 'public') : null,
            ]);

            return $this->redirect('/mangas', navigate: true);
        }
    }
};
?>

<form class="max-lg:w-full" wire:submit="save">
    <flux:card class="space-y-4">
        <div>
            <flux:heading size="lg">{{ $formTitle }}</flux:heading>
            <flux:text class="mt-2">{{ $formDescription }}</flux:text>
        </div>
        <div class="space-y-4">
            <flux:field class="flex-1">
                <flux:input :label="__('manga.title')" wire:model.live.blur="title" />
            </flux:field>
            <flux:field class="flex-1">
                <flux:textarea :label="__('manga.synopsis')" wire:model.live.blur.live.blur="synopsis" />
            </flux:field>
            <div class="flex gap-4 max-lg:flex-col">
                <flux:field class="flex-1">
                    <flux:input :label="__('manga.genre')" wire:model.live.blur="genre" />
                </flux:field>
                <flux:field class="flex-1">
                    <flux:input :label="__('manga.author')" wire:model.live.blur="author" />
                </flux:field>
            </div>
            <div class="flex gap-4 max-lg:flex-col">
                <flux:field class="flex-1">
                    <flux:input :label="__('manga.volumes')" wire:model.live.blur="volumes" />
                </flux:field>
                <flux:field class="flex-1">
                    <flux:input :label="__('manga.chapters')" wire:model.live.blur="chapters" />
                </flux:field>
            </div>
            <div class="flex gap-4">
                <div class="flex-1">
                    <flux:select :label="__('manga.status')" wire:model="status">
                        <flux:select.option value="ongoing">{{ __('manga.publication_status.ongoing') }}</flux:select.option>
                        <flux:select.option value="completed">{{ __('manga.publication_status.completed') }}</flux:select.option>
                        <flux:select.option value="hiatus">{{ __('manga.publication_status.hiatus') }}</flux:select.option>
                        <flux:select.option value="cancelled">{{ __('manga.publication_status.cancelled') }}</flux:select.option>
                    </flux:select>
                </div>
            </div>
            <div class="flex gap-4 max-lg:flex-col">
                <flux:field class="flex-1">
                    <flux:input type="date" :label="__('manga.start_date')" wire:model.live.blur="start_date" />
                </flux:field>
                <flux:field class="flex-1">
                    <flux:input type="date" :label="__('manga.end_date')" wire:model.live.blur="end_date" />
                </flux:field>
            </div>
        </div>
        <div class="space-y-4">
            <div class="flex">
                <flux:input type="file" :label="__('manga.cover_image')" wire:model="new_cover" />
            </div>
            <flux:button class="w-full bg-green-600 hover:bg-green-700 dark:bg-green-300 dark:hover:bg-green-200" type="submit" variant="primary">
                {{ __('common.actions.save') }}
            </flux:button>
        </div>
    </flux:card>
</form>
