<main>
    <div class="py-5">
        <div class="container">
            <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <flux:icon.magnifying-glass variant="mini" class="d-inline me-2"/>{{ __('Paieška') }}
                    </span>
                <input type="text" wire:model.live="search" class="form-control">
            </div>
            <div class="mb-3">
                {{ $users->links(data: ['scrollTo' => false]) }}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <caption>{{ __('Vartotojų sąrašas') }}</caption>
                    <thead class="table-active">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Vardas') }}</th>
                            <th scope="col">{{ __('Miestas') }}</th>
                            <th scope="col">{{ __('Įkeltos nuotraukos') }}</th>
                            <th scope="col">{{ __('Komentarai') }}</th>
                            <th scope="col">{{ __('Seka') }}</th>
                            <th scope="col">{{ __('Sekėjai') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->city->name }}</td>
                                <td>{{ $user->posts->count() }}</td>
                                <td>{{ $user->comments->count() }}</td>
                                <td>{{ $user->following->count() }}</td>
                                <td>{{ $user->followers->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</main>
