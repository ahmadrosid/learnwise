@php
    function getFirstFreeChapter($sections)
    {
        foreach ($sections as $sec) {
            foreach ($sec->chapters as $ch) {
                if ($ch->is_free) {
                    return $ch['video_url'];
                }
            }
        }
    }

    function getFreeSections($sections, $chapters, $course_id)
    {
        $result = [];

        foreach ($sections as $sec) {
            $sectionId = $sec['id'];

            $freeChapters = array_filter($chapters, function ($ch) use ($sectionId) {
                return $ch['section_id'] === $sectionId && $ch['is_free'];
            });

            if (!empty($freeChapters)) {
                $sec['chapters'] = $freeChapters;
                $result[] = $sec;
            }
        }

        $ungroupedFreeChapters = array_filter($chapters, function ($ch) {
            return $ch['section_id'] === null && $ch['is_free'];
        });

        $ungroupSection = [
            'id' => 999999999999,
            'is_ungrouped' => true,
            'title' => 'ungrouped',
            'course_id' => $course_id,
            'next_section_id' => null,
            'created_at' => date('Y-m-d\TH:i:s.u\Z'),
            'updated_at' => date('Y-m-d\TH:i:s.u\Z'),
            'chapters' => array_values($ungroupedFreeChapters),
        ];
        if (!empty($ungroupedFreeChapters)) {
            $result[] = $ungroupSection;
        }

        return $result;
    }
    function secondsToHMS($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        if ($hours > 0) {
            $formattedHours = str_pad($hours, 2, '0', STR_PAD_LEFT);
            $formattedMinutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
            $formattedSeconds = str_pad($remainingSeconds, 2, '0', STR_PAD_LEFT);
            return "$formattedHours:$formattedMinutes:$formattedSeconds";
        } else {
            $formattedMinutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
            $formattedSeconds = str_pad($remainingSeconds, 2, '0', STR_PAD_LEFT);
            return "$formattedMinutes:$formattedSeconds";
        }
    }

    function calculateVideoDurations($sections)
    {
        $count = 0;

        foreach ($sections as $section) {
            foreach ($section->chapters as $chapter) {
                $count += $chapter->video_duration;
            }
        }

        return $count;
    }

    $totalDurationInSecond = calculateVideoDurations($sections);
    $prettyDuration = secondsToHMS($totalDurationInSecond);
    $freeSections = getFreeSections($sections, $chapters, $course->id);

@endphp
<x-app-layout>
    <div class="row" x-data="{ freeSections: {{ json_encode($freeSections) }} }">
        <div class="col-8">
            <!-- HEADING -->
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

                    {{-- We might want to have another column called language --}}
                    <div class="gap-1 d-flex align-items-center fs-sm">
                        <x-lucide-globe class="w-4 h-4 text-dark" />
                        <span>English</span>
                    </div>
                </div>
            </div>
            <!-- END HEADING -->

            <!-- COURSE CONTENT -->
            <div class="py-4 my-4">
                <h3 class="my-2">Course content</h3>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="fs-sm text-muted">
                        <span>{{ $sections->count() }} sections</span> &bull; <span>{{ $course->chapters->count() }}
                            lectures</span> &bull;
                        <span>{{ $prettyDuration }} total
                            length</span>
                    </div>
                </div>
                <div>
                    <div class="accordion" id="sectionAccordion">
                        @foreach ($sections as $item)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $item->id }}">
                                    <button class="px-2 accordion-button collapsed bg-neutral-50" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}"
                                        aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                                        {{ $item->title }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $item->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $item->id }}" data-bs-parent="#sectionAccordion">
                                    <div class="accordion-body ps-2">
                                        @foreach ($chapters as $ch)
                                            @if ($ch->section_id === $item->id)
                                                <div
                                                    class="py-2 d-flex justify-content-between ps-4 align-items-center">
                                                    <div class="gap-2 d-flex align-items-center">
                                                        @if ($ch->is_free)
                                                            <x-lucide-play-circle class="w-4 h-4" />
                                                        @else
                                                            <x-lucide-lock class="w-4 h-4" />
                                                        @endif
                                                        <span>{{ $ch->title }}</span>
                                                    </div>
                                                    <div class="gap-2 d-flex align-items-center">
                                                        @if ($ch->is_free)
                                                            <span>
                                                                <button
                                                                    @click="previewChapter('{{ $ch->video_url }}', freeSections)"
                                                                    class="btn">preview</button></span>
                                                        @endif
                                                        <span>{{ $ch->video_duration ? secondsToHMS($ch->video_duration) : '-' }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($chapters as $ch)
                            @if (!$ch->section_id)
                                <div class="gap-2 py-1 ps-4 d-flex align-items-center justify-content-between">
                                    <div class="gap-2 py-2 d-flex align-items-center">
                                        @if ($ch->is_free)
                                            <x-lucide-play-circle class="w-4 h-4" />
                                        @else
                                            <x-lucide-lock class="w-4 h-4" />
                                        @endif
                                        <span>{{ $ch->title }}</span>
                                    </div>

                                    <div class="gap-2 d-flex align-items-center">
                                        @if ($ch->is_free)
                                            <span><button @click="previewChapter('{{ $ch->video_url }}', freeSections)"
                                                    class="btn">preview</button></span>
                                        @endif
                                        <span>{{ $ch->video_duration ? secondsToHMS($ch->video_duration) : '-' }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- END COURSE CONTENT -->

            <!-- REVIEW FORM -->

            <!-- END REVIEW FORM -->
        </div>

        <!-- CHECKOUT CARD -->
        <div class="col-4 position-relative">
            <div class="card" style="position: sticky; top:65px;">
                <div class="card-img-top position-relative">
                    <img src="@thumbnail($course)" class="card-img-top" alt="{{ $course->title }}" />
                    <div class="top-0 left-0 bg-black video-preview-overlay d-flex align-items-center justify-content-center w-100 h-100 position-absolute card-img-top"
                        style="opacity:0.2"
                        @click="previewChapter('{{ getFirstFreeChapter($sections) }}', freeSections)">
                    </div>
                    <div class="z-30 p-0 bg-primary rounded-circle position-absolute video-preview-btn"
                        style="opacity:0.8; width: 32px; height: 32px;  top: 50%; left: 50%; transform: translate(-50%, -50%)"
                        @click="previewChapter('{{ getFirstFreeChapter($sections) }}', freeSections)">
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
                                <input type="hidden" name="description"
                                    value="{{ 'Payment for ' . $course->title }}" />
                                <input type="hidden" name="amount" value="{{ $course->price }}" />
                                <input type="hidden" name="payer_email" value={{ auth()->user()->email }} />
                                <input type="hidden" name="user_id" value={{ auth()->user()->id }} />
                                <button type="submit" class="btn btn-primary"
                                    {{ $isTheCreator ? ' disabled' : '' }}>Enroll course </button>

                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END CHECKOUT CARD -->
    </div>

    <!-- PREVIEW MODAL -->
    <div class="modal fade show" id="previewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="text-muted">Course preview</p>
                        <h5 class="modal-title" id="previewModalLabel">{{ $course->title }}</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="videoFrame"> </div>
                    <div class="my-4 accordion" id="previewAccordion"> </div>
                </div>
                <div class="modal-footer"> </div>
            </div>
        </div>
    </div>
    <!-- END PREVIEW MODAL -->

</x-app-layout>
