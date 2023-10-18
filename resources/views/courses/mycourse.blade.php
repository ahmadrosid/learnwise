<x-app-layout>
    <div class="grid align-items-center gap-4">
        <div class="g-col-6 border rounded-3 bg-white p-1">
            <div class="d-flex gap-2 align-items-center py-2 px-2">
                <div class="d-flex justify-content-center bg-blue-50 p-1 rounded-circle" style="width: 30px; height: 30px">
                    <x-lucide-clock class="text-blue-400 w-5 h-5" />
                </div>
                <div>
                    <div class="fw-bold">In Progress</div>
                    <div class="fs-sm text-neutral-100">
                        {{ $inProgressCoursesCount == 0 ? "You don't currently have unfinished course. ": $inProgressCoursesCount. " Courses"}}
                    </div>
                </div>
            </div>
        </div>
        <div class="g-col-6 border rounded-3 bg-white p-1">
            <div class="d-flex gap-2 align-items-center py-2 px-2">
                <div class="d-flex justify-content-center bg-green-50 p-1 rounded-circle" style="width: 30px; height: 30px">
                    <x-lucide-check-circle class="text-green-400 w-5 h-5" />
                </div>
                <div>
                    <div class="fw-bold">Completed</div>
                    <div class="fs-sm text-neutral-100">
                        {{ $completedCoursesCount == 0 ? "You haven't finished any course yet. ": $completedCoursesCount. " Courses"}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        @if($courses->count() < 0) <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            @foreach($courses as $item)

            @php
            $progress = number_format(($item->progress_count / $item->chapters_count) * 100, 2)
            @endphp
            <div class="col">
                <div class="card border shadow-none rounded-4">
                    <a href="/courses/{{$item->slug}}/chapter/1" class="p-2">
                        <img src="{{$item->thumbnail}}" class="card-img-top rounded-3" alt="green iguana" />
                    </a>
                    <div class="card-body p-3 pt-0">
                        <a href="/courses/{{$item->slug}}/chapter/1" class="text-black">
                            <div class="fs-6 fw-bold">{{$item->title}}</div>
                        </a>
                        <div class="fs-sm text-neutral-100">{{$item->category_name}}</div>
                        <div class="hstack gap-2 pt-2">
                            <div class="bg-blue-50 rounded-circle d-flex justify-content-center align-items-center" style="width: 25px; height: 25px; padding: 5px;">
                                <x-lucide-book-open class="text-blue-100" />
                            </div>
                            <span class="text-neutral-100 fs-sm">{{$item->chapters_count}} Chapters</span>
                        </div>
                        <div class="pt-3">
                            <div class="progress">
                                <div style="width: {{$progress}}%;" class="progress-bar bg-success" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="fs-sm pt-2 text-neutral-400">{{ $progress }}% Complete</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    @else
    <p class="fs-6 text-muted fst-italic">The course you enroll will appear here.</p>
    @endif
    </div>
</x-app-layout>
