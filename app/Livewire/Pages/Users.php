<?php

namespace App\Livewire\Pages;

use App\Livewire\Forms\AddPostForm;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public AddPostForm $addPostForm;
    #[Url(as: 'q', except: '')]
    public $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        $search = preg_replace('/\s+/', '%', $this->search);

        return view('livewire.pages.users', [
            'users' => User::leftJoin('cities', 'cities.id', '=', 'users.city_id')
                ->where(function($query) use ($search) {
                    $query->whereRaw("(users.name || ' ' || cities.name) LIKE ?", ["%{$search}%"]);
                })
                ->select('users.*')
                ->paginate(18),
        ])->layout('components.layouts.app.page');
    }
}
