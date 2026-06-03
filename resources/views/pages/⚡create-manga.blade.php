<?php

use Livewire\Component;

new class extends Component {};
?>

<div class="flex justify-center">
    <livewire:manga-form form-title="{{ __('manga.form.add_title') }}" form-description="{{ __('manga.form.add_description') }}" />
</div>