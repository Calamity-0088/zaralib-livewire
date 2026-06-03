<?php

use App\Models\Manga;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

new class extends Component {
    public $query;
    public $manga;
    public $currentRoute;

    public function mount()
    {
        $this->currentRoute = Route::currentRouteName();
    }

    public function searchManga()
    {
        if ($this->currentRoute === 'mangas.library') {
            return $this->redirect("/mangas/library?query=$this->query", navigate: true);
        }

        return $this->redirect("/mangas?query=$this->query", navigate: true);
    }
};
?>

<flux:modal class="flex flex-col gap-4" name="search">
    <flux:heading>{{ __('common.form.search_description') }}</flux:heading>
    <flux:input.group>
        <flux:input wire:model.live="query" placeholder="{{ __('common.form.search') }}" />
        <flux:button wire:click="searchManga" icon="magnifying-glass"></flux:button>
    </flux:input.group>
</flux:modal>
