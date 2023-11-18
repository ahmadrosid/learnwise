<x-app-layout>
    <div class="row" x-data="{ freeChapters: {{ json_encode($freeChapters) }}, }">
        <div class="col-8">
            <div class="pb-4 mb-4">
                <h1>Introduction to psychology and human behaviour</h1>
                <div class="my-2">
                    <x-markdown :options="['commonmark' => ['enable_strong' => false]]" theme="github-dark">
                        {!! $course->description !!}
                    </x-markdown>
                </div>
                <div class="flex-wrap gap-4 d-flex">
                    <div class="gap-1 d-flex align-items-center fs-sm">
                        <x-lucide-user-circle class="w-4 h-4" />
                        <span>Created by {{ $course->user->name }}</span>
                    </div>
                    <div class="gap-1 d-flex align-items-center fs-sm">
                        <x-lucide-alert-circle class="w-4 h-4 text-dark" />
                        <span>Last updated {{ $course->updated_at->format('m/d') }}</span>
                    </div>
                    <div class="gap-1 d-flex align-items-center fs-sm">
                        <x-lucide-globe class="w-4 h-4 text-dark" />
                        @if ($course->lang)
                        <span>{{ $course->lang }}</span>
                        @else
                        <span class="fst-italic text-muted fs-sm">No language defined</span>
                        @endif
                    </div>

                </div>
            </div>
            <div class="py-4 my-4">
                <h3 class="my-2">Course content</h3>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="fs-sm text-muted">
                        <span>{{ $sections->count() }} sections</span> &bull; <span>{{ $course->chapters->count() }}
                            lectures</span> &bull;
                        <span> @sec2HMS($videoCourseDuration) total
                            length</span>
                    </div>
                </div>
                <div>
                    <div class="accordion" id="sectionAccordion">
                        @foreach ($sections as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $item->id }}">
                                <button class="px-2 accordion-button collapsed bg-neutral-50" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                                    {{ $item->title }}
                                </button>
                            </h2>
                            <div id="collapse{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $item->id }}" data-bs-parent="#sectionAccordion">
                                <div class="accordion-body ps-2">
                                    @foreach ($chapters as $chapter)
                                    @if ($chapter->section_id === $item->id)
                                    <x-chapter-item :chapter="$chapter" />
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @foreach ($chapters as $chapter)
                        @if (!$chapter->section_id)
                        <x-chapter-item :chapter="$chapter" />
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 position-relative">
            <div class="card" style="position: sticky; top:65px;">
                <div class="card-img-top position-relative video-preview-btn" data-video-id="{{ $firstFreeChapter }}">
                    <img src="@thumbnail($course)" class="card-img-top" alt="{{ $course->title }}" />
                    <div class="top-0 left-0 bg-black video-preview-overlay d-flex align-items-center justify-content-center w-100 h-100 position-absolute card-img-top" style="opacity:0.2" @click="previewChapter('{{ $firstFreeChapter }}')">
                    </div>
                    <div class="z-30 p-0 bg-primary rounded-circle position-absolute video-preview-btn" style="opacity:0.8; width: 32px; height: 32px;  top: 50%; left: 50%; transform: translate(-50%, -50%)" @click="previewChapter('{{ $firstFreeChapter }}')">
                        <x-lucide-play-circle class="text-white" style="width: 32px; height: 32px;" />
                    </div>
                </div>
                <div class="card-body">
                    <h4>{{ $course->title }}</h4>
                    <p class="card-text">
                        <x-markdown :options="['commonmark' => ['enable_strong' => false]]" theme="github-dark">
                            {!! $course->description !!}
                        </x-markdown>
                    </p>
                    <p>@currency($course->price)</p>
                    <div>
                        @if (!Auth::user())
                        <a href="{{ route('login') }}" class="btn btn-primary">Login to Enroll</a>
                        @else
                        <form action="{{ route('enroll') }}" method="POST">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}" />
                            <input type="hidden" name="description" value="{{ 'Payment for ' . $course->title }}" />
                            <input type="hidden" name="amount" value="{{ $course->price }}" />
                            <input type="hidden" name="payer_email" value={{ auth()->user()->email }} />
                            <input type="hidden" name="user_id" value={{ auth()->user()->id }} />
                            <button type="submit" class="btn btn-primary" {{ $isTheCreator ? ' disabled' : '' }}>Enroll course </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ handlePreviewLink, closePreview }" class="modal fade show" id="previewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="text-muted">Course preview</p>
                        <h5 class="modal-title" id="previewModalLabel">{{ $course->title }}</h5>
                    </div>
                    <button type="button" class="btn-close" @click="closePreview" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="videoFrame"> </div>
                    <div class="my-4 accordion" id="previewAccordion">
                        @foreach ($freeChapters as $chapter)
                        <a @click="handlePreviewLink" class="py-2 px-4 d-flex justify-content-between modal-video-preview-link align-items-center" data-video-id="{{ $chapter->video_url }}">
                            <div class="gap-2 d-flex align-items-center">
                                <x-lucide-play-circle class="w-4 h-4" />
                                <span>{{ $chapter->title }}</span>
                            </div>
                            <div class="gap-2 d-flex align-items-center">
                                <span>Preview</span>
                                <!-- TODO: fix preview duration -->
                                <!-- <span class="text-decoration-none">{{ $chapter->video_duration ? $chapter->video_duration : '' }}</span> -->
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer"> </div>
            </div>
        </div>
    </div>
</x-app-layout>