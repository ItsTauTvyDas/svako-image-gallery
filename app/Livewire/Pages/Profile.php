<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Profile extends Component
{
    public ?User $user;
    public bool $isFollowing;

    public function mount(int $id): void
    {
        $this->user        = User::find($id);
        if (auth()->check())
            $this->isFollowing = auth()->user()->isFollowing($this->user);
    }

    public function follow(): void
    {
        if (!auth()->check())
            return;
        $loggedInUser = auth()->user();
        if ($loggedInUser->id === $this->user->id)
            return;
        if (!$loggedInUser->isFollowing($this->user)) {
            auth()->user()->following()->create([
                'followed_user_id' => $this->user->id,
                'created_at'       => now(),
            ]);
            $this->isFollowing = true;
        }
    }

    public function unfollow(): void
    {
        if (!auth()->check())
            return;
        auth()->user()->following()
                   ->where('followed_user_id', $this->user->id)
                   ->delete();
        $this->isFollowing = false;
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.pages.profile')->layout('components.layouts.app.page');
    }
}
