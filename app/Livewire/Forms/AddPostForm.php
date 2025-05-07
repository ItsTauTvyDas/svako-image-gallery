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

    #[Validate('image|max:25600')]
    public TemporaryUploadedFile $photo;

    public function store(): void
    {
        $this->validate();

        $path = $this->photo->storePublicly(path: 'photos');
        if ($path === false) {
            $this->addError('photo', 'Atsitiko klaida ir nuotraukos įkelti nepavyko!');
            return;
        }

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image_url' => $path,
            'user_id' => auth()->id()
        ]);
    }
}
