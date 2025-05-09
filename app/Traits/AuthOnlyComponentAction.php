<?php

namespace App\Traits;

trait AuthOnlyComponentAction
{
    public function hydrate(): void
    {
        if (!auth()->check())
            abort(403);
        elseif (!auth()->user()->hasVerifiedEmail())
            redirect(route('verification.notice'));
    }
}
