@php
    function containsFreeChapter($section)
    {
        foreach ($section->chapters as $ch) {
            if ($ch->is_free) {
                return true;
            }
        }
        return false;
    }
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
                <div class="gap-2 d-flex align-items-center">
                    <span class="text-warning">4.4</span>
                    <div class="d-flex">
                        <x-lucide-star class="w-4 h-4 text-warning" />
                        <x-lucide-star class="w-4 h-4 text-warning" />
                        <x-lucide-star class="w-4 h-4 text-warning" />
                        <x-lucide-star class="w-4 h-4 text-warning" />
                        <x-lucide-star-half class="w-4 h-4 text-warning" />
                    </div>
                    <span>(122,012 ratings)</span>
                    <span>437,902 students</span>
                </div>
                <p>Created by {{ $course->user->name }}</p>
                <div class="gap-4 d-flex align-items-center">
                    <div>
                        <x-lucide-alert-circle class="w-4 h-4 text-dark" />
                        <span>Last updated 8/2022</span>
                    </div>
                    <div>
                        <x-lucide-globe class="w-4 h-4 text-dark" />
                        <span>English</span>
                    </div>
                </div>
            </div>
            <!-- END HEAING -->

            <!-- COURSE CONTENT -->
            <div class="py-4 my-4">
                <h3 class="m-0">Course content</h3>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-sm text-muted">
                        <span>8 sections</span> &bull; <span>27 lectures</span> &bull; <span>11h 22m total
                            length</span>
                    </div>
                    <button class="btn">Expand all sections</button>
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
                                                            <span><button data-url="{{ $ch->video_url }}"
                                                                    x-bind:data-sections="JSON.stringify(freeSections)"
                                                                    @click="previewChapter"
                                                                    class="btn">preview</button></span>
                                                        @endif
                                                        <span>12:31</span>
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
                                            <span><button data-url="{{ $ch->video_url }}"
                                                    x-bind:data-sections="JSON.stringify(freeSections)"
                                                    @click="previewChapter" class="btn">preview</button></span>
                                        @endif
                                        <span>12:31</span>
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
                    <button
                        class="z-30 p-0 m-0 bg-white border-none btn d-flex rounded-circle align-items-center justify-content-center"
                        data-url="{{ getFirstFreeChapter($sections) }}" 
                        x-bind:data-sections="JSON.stringify(freeSections)" 
                        style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 34px; height: 34px;">

                        <x-lucide-play-circle data-url="{{ getFirstFreeChapter($sections) }}" @click="previewChapter"
                            x-bind:data-sections="JSON.stringify(freeSections)" class="text-black"
                            style="width: 32px; height: 32px;" />
                    </button>
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
