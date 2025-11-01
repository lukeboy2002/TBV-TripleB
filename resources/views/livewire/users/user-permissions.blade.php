<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-4">Gebruikers Rechten Beheer</h2>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <!-- Gebruikers Lijst -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gebruiker</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rollen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Directe Permissies</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acties</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4">
                        <div>
                            <div class="font-medium">{{ $user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @forelse($user->roles as $role)
                                <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded flex items-center gap-1">
                                        {{ $role->name }}
                                        <button wire:click="removeUserRole({{ $user->id }}, {{ $role->id }})"
                                                onclick="return confirm('Weet je het zeker?')"
                                                class="text-purple-600 hover:text-purple-900 ml-1">
                                            ×
                                        </button>
                                    </span>
                            @empty
                                <span class="text-gray-400 text-sm">Geen rollen</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @forelse($user->permissions as $permission)
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded flex items-center gap-1">
                                        {{ $permission->name }}
                                        <button wire:click="removeUserPermission({{ $user->id }}, {{ $permission->id }})"
                                                onclick="return confirm('Weet je het zeker?')"
                                                class="text-blue-600 hover:text-blue-900 ml-1">
                                            ×
                                        </button>
                                    </span>
                            @empty
                                <span class="text-gray-400 text-sm">Geen permissies</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button wire:click="selectUser({{ $user->id }})"
                                class="text-blue-600 hover:text-blue-900">
                            Bewerken
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- User Permissions Modal -->
    @if($showUserModal && $selectedUser)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
                <div class="mb-4">
                    <h3 class="text-lg font-bold">
                        Rechten voor {{ $selectedUser->name }}
                    </h3>
                    <p class="text-sm text-gray-600">{{ $selectedUser->email }}</p>
                </div>

                <form wire:submit.prevent="updateUserPermissions">
                    <!-- Rollen Selectie -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Rollen
                        </label>
                        <div class="border rounded p-3 max-h-48 overflow-y-auto bg-gray-50">
                            @forelse($availableRoles as $role)
                                <label class="flex items-center mb-2 p-2 hover:bg-white rounded">
                                    <input type="checkbox"
                                           wire:model="userRoles"
                                           value="{{ $role->id }}"
                                           class="mr-2">
                                    <div class="flex-1">
                                        <span class="font-medium">{{ $role->name }}</span>
                                        @if($role->permissions->count() > 0)
                                            <div class="text-xs text-gray-500 mt-1">
                                                Bevat:
                                                @foreach($role->permissions->take(3) as $perm)
                                                    {{ $perm->name }}@if(!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                                @if($role->permissions->count() > 3)
                                                    en {{ $role->permissions->count() - 3 }} meer...
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </label>
                            @empty
                                <p class="text-gray-500 text-sm">Geen rollen beschikbaar</p>
                            @endforelse
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            Nieuwe selectie vervangt bestaande rollen
                        </p>
                    </div>

                    <!-- Directe Permissies -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Directe Permissies
                        </label>
                        <div class="border rounded p-3 max-h-48 overflow-y-auto bg-gray-50">
                            @forelse($availablePermissions as $permission)
                                <label class="flex items-center mb-2 p-2 hover:bg-white rounded">
                                    <input type="checkbox"
                                           wire:model="userPermissions"
                                           value="{{ $permission->id }}"
                                           class="mr-2">
                                    <span>{{ $permission->name }}</span>
                                </label>
                            @empty
                                <p class="text-gray-500 text-sm">Geen permissies beschikbaar</p>
                            @endforelse
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            Deze worden toegevoegd naast permissies van rollen
                        </p>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-3 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    De gebruiker krijgt alle permissies van de geselecteerde rollen,
                                    plus eventuele directe permissies.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-2">
                        <button type="button"
                                wire:click="closeUserModal"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Annuleren
                        </button>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Rechten Opslaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>