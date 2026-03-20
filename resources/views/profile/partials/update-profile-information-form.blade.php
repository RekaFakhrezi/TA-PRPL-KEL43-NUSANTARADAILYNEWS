<section>
    <header>
        <h2 class="text-xl font-black text-ink">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-ink-muted">
            Perbarui informasi profil, alamat email, foto profil, dan bio singkat Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex items-start gap-6">
            <div class="flex-shrink-0">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="w-24 h-24 rounded-2xl object-cover border-2 border-border-light">
                @else
                    <div class="w-24 h-24 rounded-2xl bg-surface-2 flex items-center justify-center text-ink text-3xl font-black border-2 border-border-light">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <x-input-label for="avatar" value="Foto Profil (Opsional)" />
                <input type="file" id="avatar" name="avatar" accept="image/*" class="mt-1 block w-full text-sm text-ink-light file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-2 file:border-ink file:text-sm file:font-bold file:bg-ink file:text-surface hover:file:bg-ink/80 file:cursor-pointer file:transition-all">
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                <p class="text-xs text-ink-muted mt-2">Format: JPG, PNG, GIF. Maks: 2MB.</p>
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full input-light" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full input-light" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-ink-muted">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-accent-dark hover:text-ink rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ink transition-colors">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-emerald-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="bio" value="Bio Singkat (Opsional)" />
            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full input-light resize-none">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200"
                >Tersimpan.</p>
            @endif
        </div>
    </form>
</section>
