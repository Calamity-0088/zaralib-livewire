<?php

use App\Models\Manga;
use Livewire\Component;

new class extends Component {
    public $query;
    public $manga;

    public function searchManga()
    {
        return $this->redirect("/mangas?query=$this->query", navigate: true);
    }
};
?>

<div class="contents">
    <flux:modal.trigger name="search">
        <flux:tooltip :content="__('messages.navigation.search')" position="bottom">
            <flux:navbar.item class="h-10! [&>div>svg]:size-5" icon="magnifying-glass" :label="__('Search')" />
        </flux:tooltip>
    </flux:modal.trigger>
    <flux:modal class="flex flex-col gap-4" name="search">
        <flux:heading>Ingrese un manga para buscar</flux:heading>
        <flux:input.group>
            <flux:input wire:model.live="query" placeholder="Buscar" />
            <flux:button wire:click="searchManga" icon="magnifying-glass"></flux:button>
        </flux:input.group>
    </flux:modal>
</div>
