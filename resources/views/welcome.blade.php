<x-app-layout>
    <div class="pb-5">
        <div class="gap-2 d-flex">
            @if ($category)
                <p>
                    Showing courses in the category:
                    <span class="text-blue-500">
                        {{ $category->name }}
                    </span>
                </p>
            @endif
        </div>

        <div class="gap-2 d-flex">
            <a href="/">
                <span class="btn btn-outline-primary">All</span>
            </a>
            @foreach ($categories as $category)
                <a href="/?category={{ $category->slug }}">
                    <span class="btn btn-outline-primary">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
    <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @if ($courses->count() == 0)
            <p class="text-lg italic font-bold text-gray-500">No courses found.</p>
        @else
            @foreach ($courses as $item)
                <div class="col">
                    <div class="border shadow-none card rounded-4">
                        <a href="/courses/{{ $item->slug }}/chapter/1" class="p-2">
                            <img src="@thumbnail($item)" class="object-cover rounded-3 ratio ratio-4x3"
                                alt="{{ $item->title }}" style="max-height: 160px;;" />
                        </a>
                        <div class="p-3 pt-0 card-body">
                            <a href="/courses/{{ $item->slug }}/chapter/1" class="text-black">
                                <div class="fs-6 fw-bold">{{ $item->title }}</div>
                            </a>
                            <div class="fs-sm text-neutral-100">{{ $item->category_name }}</div>
                            <div class="gap-2 py-2 hstack">
                                <div class="bg-blue-50 rounded-circle d-flex justify-content-center align-items-center"
                                    style="width: 30px; height: 30px; padding: 6px;">
                                    <x-lucide-book-open class="text-blue-100" />
                                </div>
                                <span class="text-neutral-100 fs-sm">{{ $item->chapters_count }} Chapters</span>
                            </div>
                            <div class="fw-bold fs-sm">
                                @currency($item->price)
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="p-4 m-auto mt-6 w-full">
        {{ $courses->links() }}
    </div>
</x-app-layout>
