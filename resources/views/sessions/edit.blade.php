<x-layout>
    <x-setting heading="Account Profile" :links="[
        [
            'text' => 'Edit Profile',
            'href' => '/' . auth()->user()->username . '/settings',
            'class' => auth()->user()->username . '/settings',
        ],
        [
            'text' => 'Change Password',
            'href' => '/' . auth()->user()->username . '/settings/password',
            'class' => auth()->user()->username . '/settings/password',
        ],
    ]">
        <div class="flex flex-col justify-center items-center mt-6">
            <x-user-avatar src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/lary-head.svg') }}"
                onError="this.src='{{ asset('images/lary-head.svg') }}'" />
            <h1 class="text-xl font-bold">{{ $user->name }}</h1>
            <p>&#64;{{ auth()->user()->username }}</p>
        </div>
        <form action="/{{ auth()->user()->username }}/update" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="old('name', $user->name)" required />
            <x-form.input name="username" :value="old('username', $user->username)" required />
            <x-form.input name="email" :value="old('email', $user->email)" required />
            <x-form.input name="image" type="file" />

            <div class="flex
                justify-end space-x-4">
                <div class="flex items-center mt-6 text-gray-950">
                    <a href="/{{ auth()->user()->username }}"
                        class="bg-gray-50 px-10 py-1.5 rounded-2xl text-sm font-semibold">Go
                        back
                    </a>
                </div>
                <x-form.button class="flex items-center">Update Profile</x-form.button>
            </div>
        </form>
    </x-setting>
</x-layout>
