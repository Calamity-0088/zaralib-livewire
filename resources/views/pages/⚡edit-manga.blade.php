<?php

use Livewire\Component;

new class extends Component {
    public $id;
};
?>

<div class="flex justify-center">
    <livewire:manga-form form-title="{{ __('messages.ui.edit') }}" form-description="{{ __('messages.ui.edit_description') }}" :id="$id" />
</div>
