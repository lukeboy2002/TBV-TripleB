<x-app-layout title="Profile">

    <div class="mx-auto max-w-7xl bg-background/80 rounded-lg relative pb-4">
        <div class="md:flex h-screen">
            <ul class="pt-10 flex-column space-y space-y-4 text-sm font-medium text-primary-muted mb-4 md:mb-0 md:w-1/4"
                id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <li role="presentation">
                        <button class="inline-flex items-center gap-2 px-4 py-3 rounded-lg w-full text-primary text-nowrap hover:bg-background-accent hover:text-secondary active:bg-background-accent active:text-secondary"
                                id="profile-tab" data-tabs-target="#profile" type="button" role="tab"
                                aria-controls="profile" aria-selected="false">
                            <x-lucide-user class="h-4 w-4"/>
                            Profile Information
                        </button>
                    </li>
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <li role="presentation">
                        <button class="inline-flex items-center gap-2 px-4 py-3 rounded-lg w-full text-primary text-nowrap hover:bg-background-accent hover:text-secondary active:bg-background-accent active:text-secondary"
                                id="password-tab" data-tabs-target="#password" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">
                            <x-lucide-shield-alert class="h-4 w-4"/>
                            Update Password
                        </button>
                    </li>
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <li role="presentation">
                        <button class="inline-flex items-center gap-2 px-4 py-3 rounded-lg w-full text-primary text-nowrap hover:bg-background-accent hover:text-secondary active:bg-background-accent active:text-secondary"
                                id="factor-tab" data-tabs-target="#factor" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">
                            <x-lucide-key-round class="h-4 w-4"/>
                            Two Factor Authentication
                        </button>
                    </li>
                @endif
                <li role="presentation">
                    <button class="inline-flex items-center gap-2 px-4 py-3 rounded-lg w-full text-primary text-nowrap hover:bg-background-accent hover:text-secondary active:bg-background-accent active:text-secondary"
                            id="browser-tab" data-tabs-target="#browser" type="button" role="tab"
                            aria-controls="contacts" aria-selected="false">
                        <x-lucide-globe class="h-4 w-4"/>
                        Browser Sessions
                    </button>
                </li>
                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <li role="presentation">
                        <button class="inline-flex items-center gap-2 px-4 py-3 rounded-lg w-full text-primary text-nowrap hover:bg-background-accent hover:text-secondary active:bg-background-accent active:text-secondary"
                                id="delete-tab" data-tabs-target="#delete" type="button" role="tab"
                                aria-controls="contacts" aria-selected="false">
                            <x-lucide-user-minus class="h-4 w-4"/>
                            Delete Account
                        </button>
                    </li>
                @endif
                
            </ul>
            <div class="p-6 bg-background text-medium text-primary rounded-lg w-full"
                 id="default-tab-content">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    <div class="hidden" id="profile" role="tabpanel"
                         aria-labelledby="profile-tab">
                        <div class="p-4 rounded-lg bg-background-accent">
                            @livewire('profile.update-profile-information-form')
                        </div>
                        <div class=" mt-4 p-4 rounded-lg bg-background-accent">
                            @livewire('profile-edit')
                        </div>
                    </div>
                @endif



                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="hidden p-4 rounded-lg bg-background-accent" id="password" role="tabpanel"
                         aria-labelledby="password-tab">
                        @livewire('profile.update-password-form')
                    </div>
                @endif
                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="hidden p-4 rounded-lg bg-background-accent" id="factor" role="tabpanel"
                         aria-labelledby="factor-tab">
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                @endif
                <div class="hidden p-4 rounded-lg bg-background-accent" id="browser" role="tabpanel"
                     aria-labelledby="browser-tab">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>
                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <div class="hidden p-4 rounded-lg bg-background-accent" id="delete" role="tabpanel"
                         aria-labelledby="delete-tab">
                        @livewire('profile.delete-user-form')
                    </div>
                @endif
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const tabs = document.querySelectorAll('[role="tab"]'); // Selecteer alle tabs
                const tabContents = document.querySelectorAll('[role="tabpanel"]'); // Selecteer alle inhoud

                // Function to activate a tab
                function activateTab(tab) {
                    // Remove active classes from all tabs
                    tabs.forEach(t => {
                        t.classList.remove("active", "tab-active", "bg-background-accent", "text-secondary");
                        t.setAttribute("aria-selected", "false");
                    });

                    // Add active classes to the selected tab
                    tab.classList.add("active", "tab-active", "bg-background-accent", "text-secondary");
                    tab.setAttribute("aria-selected", "true");

                    // Hide all tab content
                    tabContents.forEach(content => content.classList.add("hidden"));

                    // Show the content connected to the active tab
                    const target = document.querySelector(tab.dataset.tabsTarget);
                    if (target) {
                        target.classList.remove("hidden");
                    }
                }

                // Set the first tab as active by default
                if (tabs.length > 0) {
                    activateTab(tabs[0]);
                }

                // Add click event listeners to all tabs
                tabs.forEach(tab => {
                    tab.addEventListener("click", function () {
                        activateTab(tab);
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
