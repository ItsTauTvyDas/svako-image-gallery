<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class AddPostForm extends Form
{
    #[Validate('required|min:5|max:100')]
    public $title = '';

    #[Validate('min:5|max:500')]
    public $content = '';

    #[Validate('required|boolean')]
    public bool $acceptedRules = false;

    #[Validate('required|image|max:25600')]
    public ?TemporaryUploadedFile $photo;

    public function store(): bool
    {
        if (!$this->acceptedRules) {
            $this->addError('acceptedRules', __('Turite sutikti su taisyklėmis!'));
            return false;
        }

        $this->validate();

        $path = $this->photo->store('photos', ['disk' => 'public', 'visibility' => 'public']);
        if ($path === false) {
            $this->addError('photo', __('Atsitiko klaida ir nuotraukos įkelti nepavyko!'));
            return false;
        }

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image_url' => $path,
            'user_id' => auth()->id()
        ]);
        return true;
    }
}
