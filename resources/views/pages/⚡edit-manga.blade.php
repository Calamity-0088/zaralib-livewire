<?php

use Livewire\Component;

new class extends Component {
    public $id;
};
?>

<div class="flex justify-center">
    <livewire:manga-form form-title="{{ __('manga.form.edit_title') }}" form-description="{{ __('manga.form.edit_description') }}" :id="$id" />
</div>
