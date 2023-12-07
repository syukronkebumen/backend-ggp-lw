<x-layouts.base>
    {{-- If the user is authenticated --}}
    @auth()
        {{-- If the user is authenticated on the static sign up or the sign up page --}}
        @if (in_array(request()->route()->getName(),['static-sign-up', 'sign-up'],))
            @include('components.layouts.navbars.guest.sign-up')
            {{ $slot }}
            @include('components.layouts.footers.guest.with-socials')
            {{-- If the user is authenticated on the static sign in or the login page --}}
        @elseif (in_array(request()->route()->getName(),['sign-in', 'login'],))
            @include('components.layouts.navbars.guest.login')
            {{ $slot }}
            @include('components.layouts.footers.guest.description')
        @elseif (in_array(request()->route()->getName(),['profile', 'my-profile'],))
            @include('components.layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100">
                @include('components.layouts.navbars.auth.nav-profile')
                <div>
                    {{ $slot }}
                    @include('components.layouts.footers.auth.footer')
                </div>
            </div>
            @include('components.plugins.fixed-plugin')
        @else
            @include('components.layouts.navbars.auth.sidebar')
            @include('components.layouts.navbars.auth.nav')
            @include('components.plugins.fixed-plugin')
            {{ $slot }}
            <main>
                <div class="container-fluid">
                    <div class="row">
                        @include('components.layouts.footers.auth.footer')
                    </div>
                </div>
            </main>
        @endif
    @endauth

    {{-- If the user is not authenticated (if the user is a guest) --}}
    @guest
        {{-- If the user is on the login page --}}
        @if (!auth()->check() && in_array(request()->route()->getName(),['login'],))
            {{-- @include('components.layouts.navbars.guest.login') --}}
            {{ $slot }}
            {{-- <div class="mt-5"> --}}
                {{-- @include('components.layouts.footers.guest.with-socials') --}}
            {{-- </div> --}}

            {{-- If the user is on the sign up page --}}
        @elseif (!auth()->check() && in_array(request()->route()->getName(),['sign-up'],))
            <div>
                @include('components.layouts.navbars.guest.sign-up')
                {{ $slot }}
                @include('components.layouts.footers.guest.with-socials')
            </div>
        @endif
    @endguest

</x-layouts.base>
