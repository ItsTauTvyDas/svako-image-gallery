<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditPostForm extends Form
{
    #[Validate('required|min:5|max:100')]
    public $title = '';

    #[Validate('min:5|max:500')]
    public $content = '';

    public function update(Post $post): bool
    {
        $data = $this->validate();
        if ($post->only(['title', 'content']) == $data) {
            $this->addError('general', __('Neįvyko jokių pasikeitimų!'));
            return false;
        }
        return $post->update($data);
    }
}
