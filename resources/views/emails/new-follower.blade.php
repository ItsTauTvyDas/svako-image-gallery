Sveiki, {{ $user->name }}!
Jus ką tik pradėjo sekti {{ $follower->name }}!
Nuoroda - {{ route('profile', ['id' => $follower->id]) }}
