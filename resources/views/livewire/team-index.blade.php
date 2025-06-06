<div class="mx-auto flex max-w-7xl flex-wrap py-4 bg-background/80 rounded-lg">

    @foreach($this->users as $user)
        <div class="md:flex gap-4 w-full px-3 md:w-3/4">
            <div class="w-full md:w-1/2">
                <img class="rounded-lg w-full h-[40rem] object-cover"
                     src="{{ asset($user->profile->image_path) }}"
                     alt="{{ $user->username }}"/>
            </div>
            <div class="w-full md:w-1/2 pt-4">
                <div class="text-2xl font-secondary font-bold text-secondary flex justify-between">
                    <div>{{ ucfirst($user->username)}}</div>
                    <div>{{ $this->users->links() }}</div>
                </div>
                <div class="mt-8">{!! $user->profile->biography !!}</div>
            </div>
        </div>
    @endforeach

    <aside class="md:flex w-full flex-col pt-4 px-3 md:w-1/4 gap-4">
        <div class="rounded-lg bg-background-accent shadow-xs ring-1 ring-ring/30 p-2">
            <x-tbv-heading_h5>Player Info</x-tbv-heading_h5>


            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right">
                    <tbody>
                    <tr class="text-primary-muted font-medium whitespace-nowrap">
                        <th scope="row" class="py-4">
                            Name
                        </th>
                        <td class="py-4 text-primary">
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr class="text-primary-muted font-medium whitespace-nowrap">
                        <th scope="row" class="py-4">
                            City
                        </th>
                        <td class="py-4 text-primary">
                            {{ $user->profile->city }}
                        </td>
                    </tr>
                    <tr class="text-primary-muted font-medium whitespace-nowrap">
                        <th scope="row" class="py-4">
                            Points
                        </th>
                        <td class="py-4 text-primary">
                            1
                        </td>
                    </tr>
                    <tr class="text-primary-muted font-medium whitespace-nowrap">
                        <th scope="row" class="py-4">
                            Played Games
                        </th>
                        <td class="py-4 text-primary">
                            2
                        </td>
                    </tr>
                    <tr class="text-primary-muted font-medium whitespace-nowrap">
                        <th scope="row" class="py-4">
                            Games Won
                        </th>
                        <td class="py-4 text-primary">
                            3
                        </td>
                    </tr>
                    <tr class="text-primary-muted font-medium whitespace-nowrap">
                        <th scope="row" class="py-4">
                            Cups
                        </th>
                        <td class="py-4 text-primary">
                            4
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </aside>
</div>