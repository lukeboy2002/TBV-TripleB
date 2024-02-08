<x-app-layout>
    OUR BLOG

    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-6">
        <div class="border-l-4 border-orange-500 pl-4 flex justify-between items-center">
            <div class="text-orange-500 hover:text-orange-600 font-black uppercase focus:outline-none focus:text-orange-600">
                Blog
            </div>
        </div>
            <div class="mt-4 md:grid md:grid-cols-6 md:gap-4">
                @foreach ($posts as $post)
                    <x-cards.post
                        :post="$post"
                        class="md:col-span-3 lg:col-span-2 mt-4 lg:mt-0"
                    />
                @endforeach
            </div>
            <div class="py-6">
                {{ $posts->links() }}
            </div>

    </section>
</x-app-layout>
