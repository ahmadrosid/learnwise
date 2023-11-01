<x-app-layout>
    <div class="pb-5">
        <div class="gap-2 d-flex">
            @foreach (['All', 'Laravel', 'PHP', 'CSS', 'Javascript'] as $label)
                <span class="btn btn-outline-primary">{{ $label }}</span>
            @endforeach
        </div>
    </div>
    <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @foreach (range(1, 10) as $item)
            <div class="col">
                <div class="border shadow-none card rounded-4">
                    <a href="/courses/chapter-free" class="p-2">
                        <img src="/images/example-course.png" class="card-img-top rounded-3" alt="green iguana" />
                    </a>
                    <div class="p-3 pt-0 card-body">
                        <a href="/courses/chapter-free" class="text-black">
                            <div class="fs-6 fw-bold">Fullstack Notion Clone</div>
                        </a>
                        <div class="fs-sm text-neutral-100">Antonio Erdeljac</div>
                        <div class="gap-2 py-2 hstack">
                            <div class="bg-blue-50 rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 30px; height: 30px; padding: 6px;">
                                <x-lucide-book-open class="text-blue-100" />
                            </div>
                            <span class="text-neutral-100 fs-sm">22 Chapters</span>
                        </div>
                        <div class="fw-bold fs-sm">
                            Free
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
