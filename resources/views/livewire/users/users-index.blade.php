<div>
    <div class="mx-auto flex max-w-7xl flex-wrap flex-col-reverse lg:flex-row">
        <main class="w-full px-3 lg:w-3/4">
            <x-heading.sub>All Users</x-heading.sub>
            <x-card.default>
                <div class="relative overflow-x-auto shadow-md rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-primary-muted border border-secondary/30">
                        <thead class="text-xs text-primary bg-background-hover">
                        <tr>
                            @include('livewire.components.sortable-th',[
                                'name' => 'username',
                                 'displayName' => __('Username')
                            ])

                            <th scope="col" class="px-6 py-3">{{ __('Role') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Permissions') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('Ban') }}</th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr wire:key="{{$user->id}}" class="bg-transparent border-b border-secondary/30 ">
                                <td class="px-6 py-4 font-medium whitespace-nowrap ">
                                    {{ $user->username }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($user->roles as $role)
                                            <x-badge.default>{{ $role->name }}</x-badge.default>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($user->permissions as $permission)
                                            <x-badge.default>{{ $permission->name }}</x-badge.default>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input
                                                type="checkbox"
                                                class="sr-only peer"
                                                @checked($user->is_banned)
                                                wire:click="toggleBan({{ $user->id }})"
                                        >
                                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500 dark:peer-checked:bg-orange-500"></div>
                                    </label>
                                </td>
                                <td class="py-4 pr-4 text-right flex item-center justify-end gap-2">
                                    <x-link.icon :href="route('users.edit', $user->username)"
                                                 class="text-edit"
                                                 icon="edit"/>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-4">
                    {{ $users->links() }}
                </div>
            </x-card.default>
        </main>
        <aside class="pt-6 flex w-full flex-col px-3 lg:pt-0 lg:w-1/4 mb-6 lg:mb-20 gap-6">
            <livewire:users.users-banned/>
        </aside>
    </div>
</div>