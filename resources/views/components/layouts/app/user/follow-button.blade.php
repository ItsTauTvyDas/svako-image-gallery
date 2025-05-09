@props([
    'class'       => '',
    'buttonClass' => '',
    'isFollowing' => false,
    'user'        => null,
])

<div @class([$class => isset($class)])>
    @if(auth()->check())
        @if($isFollowing)
            <button type="button" {{ $attributes->merge(['class' => 'btn btn-primary ' . $buttonClass]) }}>{{ __('Nebesekti') }}</button>
        @elseif($user->isMe())
            <div title="{{ __('Negalite sekti savęs!') }}">
                <button type="button" {{ $attributes->merge(['class' => 'btn btn-outline-primary ' . $buttonClass]) }} disabled>
                    {{ __('Sekti') }}
                </button>
            </div>
        @else
            <button type="button" {{ $attributes->merge(['class' => 'btn btn-outline-primary ' . $buttonClass]) }}>{{ __('Sekti') }}</button>
        @endif
    @endif
</div>
