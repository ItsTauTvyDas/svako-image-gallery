<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CommentForm extends Form
{
    #[Validate('required|min:4|max:250')]
    public $content = '';

    public int $commentId = 0;

    public function store(Post $post): void
    {
        $this->validate();
        Comment::create([
            'content' => $this->content,
            'post_id' => $post->id,
            'user_id' => auth()->id()
        ]);
    }

    public function update(Comment $comment): bool
    {
        $data = $this->validate();
        if ($comment->only(['content']) == $data) {
            $this->addError('general', __('Neįvyko jokių pasikeitimų!'));
            return false;
        }
        return $comment->update([
            'content' => $this->content,
        ]);
    }
}
