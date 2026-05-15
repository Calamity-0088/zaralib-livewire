<?php

use Livewire\Component;
use App\Models\Manga;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    public $id;
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

    #[Validate('required|in:ongoing,completed,hiatus,cancelled,not_yet_released')]
    public $status;

    #[Validate('nullable|numeric|max:4')]
    public $rating;

    #[Validate('nullable|date')]
    public $start_date;

    #[Validate('nullable|date')]
    public $end_date;

    public $current_cover;

    #[Validate('nullable|image|max:5120')]
    public $new_cover;

    public function mount($id = null)
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
            $this->current_cover = $manga->cover_image;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->id != null) {
            $manga = Manga::findOrFail($this->id);

            if ($this->new_cover && $this->current_cover) {
                Storage::disk('public')->delete($this->current_cover);
            }

            $manga->update([
                'title' => $this->title,
                'synopsis' => $this->synopsis,
                'author' => $this->author,
                'genre' => $this->genre,
                'volumes' => $this->volumes,
                'chapters' => $this->chapters,
                'status' => $this->status,
                'rating' => $this->rating,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'cover_image' => $this->new_cover ? $this->new_cover->store(path: 'images', options: 'public') : $this->current_cover,
            ]);

            return $this->redirect("/mangas/$this->id", navigate: true);
        } else {
            $manga = Manga::create([
                'title' => $this->title,
                'synopsis' => $this->synopsis,
                'author' => $this->author,
                'genre' => $this->genre,
                'volumes' => $this->volumes,
                'chapters' => $this->chapters,
                'status' => $this->status,
                'rating' => $this->rating,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'cover_image' => $this->new_cover ? $this->new_cover->store(path: 'images', options: 'public') : null,
            ]);

            return $this->redirect('/mangas', navigate: true);
        }
    }

    public function delete()
    {
        $manga = Manga::findOrFail($this->$id);
        $manga->delete();
    }
};
?>

<form class="" wire:submit="save">
    <flux:card class="space-y-4">
        <div>
            <flux:heading size="lg">{{ $formTitle }}</flux:heading>
            <flux:text class="mt-2">{{ $formDescription }}</flux:text>
        </div>
        <div class="space-y-4">
            <flux:field class="flex-1">
                <flux:input label="{{ __('messages.manga.title') }}" wire:model.live.blur="title" />
            </flux:field>
            <flux:field class="flex-1">
                <flux:textarea label="{{ __('messages.manga.synopsis') }}" wire:model.live.blur.live.blur="synopsis" />
            </flux:field>
            <div class="flex gap-4">
                <flux:field class="flex-1">
                    <flux:input label="{{ __('messages.manga.genre') }}" wire:model.live.blur="genre" />
                </flux:field>
                <flux:field class="flex-1">
                    <flux:input label="{{ __('messages.manga.author') }}" wire:model.live.blur="author" />
                </flux:field>
            </div>
            <div class="flex gap-4">
                <flux:field class="flex-1">
                    <flux:input label="{{ __('messages.manga.volumes') }}" wire:model.live.blur="volumes" />
                </flux:field>
                <flux:field class="flex-1">
                    <flux:input label="{{ __('messages.manga.chapters') }}" wire:model.live.blur="chapters" />
                </flux:field>
            </div>
            <div class="flex gap-4">
                <flux:field class="flex-1">
                    <flux:input label="{{ __('messages.manga.status') }}" wire:model.live.blur="status" />
                </flux:field>
                <flux:field class="flex-1">
                    <flux:input label="{{ __('messages.manga.rating') }}" wire:model.live.blur="rating" />
                </flux:field>
            </div>
            <div class="flex gap-4">
                <flux:field class="flex-1">
                    <flux:input type="date" label="{{ __('messages.manga.start_date') }}" wire:model.live.blur="start_date" />
                </flux:field>
                <flux:field class="flex-1">
                    <flux:input type="date" label="{{ __('messages.manga.end_date') }}" wire:model.live.blur="end_date" />
                </flux:field>
            </div>
        </div>
        <div class="space-y-4">
            <flux:input type="file" wire:model="new_cover" label="{{ __('messages.manga.cover_image') }}" placeholder="iwi" text="...x" />
            <flux:button class="bg-green-300" type="submit" variant="primary">{{ __('messages.actions.save') }}
            </flux:button>
        </div>
    </flux:card>
</form>
