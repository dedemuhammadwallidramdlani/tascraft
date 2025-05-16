<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <!-- Name -->
    <div class="mt-4">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
            :value="old('name', $user->name)" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
            :value="old('email', $user->email)" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password (optional) -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password (optional)')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
            name="password_confirmation" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <!-- Role -->
    <div class="mt-4">
        <x-input-label for="role" :value="__('Role')" />
        <select name="role" id="role" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
        </select>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    <!-- Buttons -->
    <div class="flex items-center justify-end mt-6">
        <a href="{{ route('users.index') }}"
            class="text-sm text-gray-600 hover:text-gray-900 underline mr-4">
            {{ __('Back') }}
        </a>
        <x-primary-button>
            {{ __('Save') }}
        </x-primary-button>
    </div>
</form>
