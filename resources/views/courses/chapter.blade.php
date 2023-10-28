<x-course-layout :title="$course->title">
    <div class="layout-sidebar">
        <div class="sidenav show border-end">
            <div class="menu accordion">
                <ul class="menu-list">
                    @foreach ($chapters as $item)
                        <li>
                            <a class="menu-item p-4 {{ $item->position == $chapterPosition ? 'active rounded-0 border-blue-100 border-4 border-end' : '' }}"
                                href="/courses/{{ $slug }}/chapter/{{ $item->position }}">
                                @if ($item->is_free || $isEnrolled)
                                    <x-lucide-play-circle class="w-4 h-4 me-2" />
                                @else
                                    <x-lucide-lock-keyhole class="w-4 h-4 me-2" />
                                @endif
                                <span class="text-truncate" style="width:220px;">{{ $item->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <main class="bg-neutral-10">
        <div class="p-5">
            <div class="pb-2">
                @if ($isEnrolled || $chapter->is_free)
                    <video src="{{ asset('/storage/' . $chapter->video_url) }}" class="rounded card-img-top"
                        controls></video>
                @else
                    <div class="rounded card-img-top bg-neutral-800 ratio-16x9" style="height: 600px;">
                        <div class="text-center text-white" style="padding-top: 280px;">
                            <x-lucide-lock-keyhole width="60" height="60" />
                            <div class="py-2">This chapter is locked</div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="py-2 rounded border-2 d-flex justify-content-between align-items-center border-bottom">
                <h1>{{ $chapter->title }}</h1>
                <div>
                    @if (!Auth::user())
                        <button class="btn btn-primary">Start course</button>
                    @else
                        @if (!$isEnrolled)
                            <form action="{{ route('enroll') }}" method="POST">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                <input type="hidden" name="description"
                                    value="{{ 'Payment for ' . $course->title }}" />
                                <input type="hidden" name="amount" value="{{ $course->price }}" />
                                <input type="hidden" name="payer_email" value={{ auth()->user()->email }} />
                                <button type="submit" class="btn btn-primary">Enrol course</button>
                            </form>
                        @else
                            <button class="btn btn-success">Mark as complete <x-lucide-check-circle
                                    class="w-4 h-4 ms-2" /></button>
                        @endif
                    @endif
                </div>
            </div>
            <div class="py-2">
                <x-markdown :options="['commonmark' => ['enable_strong' => false]]" theme="github-dark">
                    {!! $chapter->description !!}
                </x-markdown>

            </div>
        </div>
    </main>
</x-course-layout>
