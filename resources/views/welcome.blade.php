<x-app-layout>
    <div class="pb-5">
        <div class="d-flex gap-2">
            @foreach(['All', 'Laravel', 'PHP', 'CSS', 'Javascript'] as $label)
            <span class="btn btn-outline-primary">{{$label}}</span>
            @endforeach
        </div>
    </div>
    <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @foreach(range(1,9) as $item)
        <div class="col">
            <div class="card border">
                <a href="/courses/chapter-free"><img src="/images/d2ebdb09-0a4d-4edf-9681-b0a864f01687-8nhtey.png" class="card-img-top" alt="green iguana" /></a>
                <div class="card-body p-3">
                    <a href="/courses/chapter-free" class="text-black">
                        <div class="fs-6 fw-bold">Fullstack Notion Clone</div>
                    </a>
                    <div class="fs-sm text-neutral-100">Antonio Erdeljac</div>
                    <div class="hstack gap-2 py-2">
                        <div class="bg-blue-50 p-1 px-2 rounded-circle">
                            <x-lucide-book-open class="w-4 h-4 text-blue-100" />
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