@php
    // save this for later
    $feedbacks = [
        [
            'name' => 'Liu Chen',
            'comment' => 'This course is such a game changer for me. It helps me understand myself and those around me.',
            'star' => 4,
            'gender' => 'women',
            'imgId' => 17,
        ],
        [
            'name' => 'Eva Rodriguez',
            'comment' => 'Introduction to Psychology opened my eyes to the complexities of human behavior. The engaging content and discussions have made me more aware and empathetic in both my personal and professional life.',
            'star' => 5,
            'gender' => 'women',
            'imgId' => 1,
        ],
        [
            'name' => 'Samir Patel',
            'comment' => 'This course exceeded my expectations! The topics were presented in a way that was both accessible and thought-provoking. I\'ve gained valuable insights into the mind and behavior.',
            'star' => 4,
            'gender' => 'men',
            'imgId' => 9,
        ],
        [
            'name' => 'Sophie Davis',
            'comment' => 'I was initially skeptical, but Introduction to Psychology turned out to be incredibly interesting. The blend of theory and real-world examples made the concepts easy to grasp. Highly recommended!',
            'star' => 5,
            'gender' => 'women',
            'imgId' => 49,
        ],
        [
            'name' => 'Alex Thompson',
            'comment' => 'As someone new to psychology, this course provided a solid foundation. The instructor\'s passion for the subject was contagious, and I now find myself applying psychological concepts in everyday situations.',
            'star' => 4,
            'gender' => 'men',
            'imgId' => 8,
        ],
        [
            'name' => 'Jordan Kim',
            'comment' => 'The course covered a broad range of topics, and while some were fascinating, others didn\'t quite capture my interest. It\'s a decent introduction, but I expected a bit more depth in certain areas.',
            'star' => 4,
            'gender' => 'men',
            'imgId' => 43,
        ],
        [
            'name' => 'Olivia Mitchell',
            'comment' => 'Honestly, this course fell short for me. The material felt outdated, and the delivery was uninspiring. I was hoping for a more dynamic exploration of psychology, but it left me wanting more.',
            'star' => 3,
            'gender' => 'women',
            'imgId' => 95,
        ],
        [
            'name' => 'Chris Baker',
            'comment' => 'I regret taking this course. The content was dry, and the assignments felt disconnected from the real world. I was hoping for a more engaging and practical introduction to psychology.',
            'star' => 3.5,
            'gender' => 'men',
            'imgId' => 51,
        ],
    ];

@endphp
<x-app-layout>
    <!-- 'course'
        'slug'
        'isEnrolled'
        'chapters'
        'isTheCreator'
        'sections'
    -->
    <div class="row">
        <div class="col-8">
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
            {{--
                SAVE THIS FOR LATER
            <div class="py-4 my-4">
                <h3>This course includes:</h3>
                <div class="row">
                    <div class="col-6">
                        <div class="gap-2 d-flex">
                            <x-lucide-monitor-play class="w-4 h-4" />
                            <span>22 hours of video</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="gap-2 d-flex">
                            <x-lucide-smartphone class="w-4 h-4" />
                            <span>Access on mobile and TV</span>
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="gap-2 d-flex">
                            <x-lucide-code class="w-4 h-4" />
                            <span>27 coding exercises</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="gap-2 d-flex">
                            <x-lucide-trophy class="w-4 h-4" />
                            <span>Certificate of completion</span>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="gap-2 d-flex">
                            <x-lucide-file class="w-4 h-4" />
                            <span>18 articles</span>
                        </div>
                    </div>
                </div>
            </div>
            --}}

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
                                    <button class="px-2 accordion-button bg-neutral-50" type="button"
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
                                                <div class="py-2 d-flex justify-content-between ps-4">
                                                    <div class="gap-2 d-flex">
                                                        <span>
                                                            <x-lucide-play-circle class="w-4 h-4" />
                                                        </span>
                                                        <span>{{ $ch->title }}</span>
                                                    </div>
                                                    <div class="gap-2 d-flex">
                                                        <span><a href="#">preview</a></span>
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
                                    <div class="gap-2 d-flex align-items-center">
                                        <x-lucide-play-circle class="w-4 h4" />
                                        <span>{{ $ch->title }}</span>
                                    </div>

                                    <div class="gap-2 d-flex">
                                        <span><a href="#">preview</a></span>
                                        <span>12:31</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            {{--
            SAVE THIS FOR LATER
            <div>
                <h3>What they said</h3>
                @foreach ($feedbacks as $index => $feedback)
                    <div class="gap-4 p-2 d-flex align-items-start">
                        <img src="https://randomuser.me/portraits/{{ $feedback['gender'] }}/{{ $feedback['imgId'] }}.jpg"
                            class="order-{{ $index % 2 === 0 ? 1 : 2 }} rounded-circle" width="65px" />
                        <div class="order-{{ $index % 2 === 0 ? 2 : 1 }} p-2 text-white rounded bg-dark flex-grow-1">
                            <h5>{{ $feedback['name'] }}</h5>
                            <div class="d-flex">
                                @for ($i = 0; $i < floor($feedback['star']); $i++)
                                    <x-lucide-star class="w-4 h-4 text-warning" />
                                @endfor
                                @if ($feedback['star'] - floor($feedback['star']) === 0.5)
                                    <x-lucide-star-half class="w-4 h-4 text-warning" />
                                @endif
                            </div>
                            <blockquote>
                                {{ $feedback['comment'] }}
                            </blockquote>
                        </div>
                    </div>
                @endforeach

            </div>
            --}}

            <div class="my-4">
                <h3>Care to share your thought about this course?</h3>
                <p class="lead">Write a few words and help others to find good courses!</p>
                <form>
                    <div class="mb-3">
                        <label for="review" class="form-label">Your comment</label>
                        <textarea class="form-control" rows="3" id="review"></textarea>
                    </div>
                    <div class="mb-3 d-flex align-items-center" id="ratingButtons">
                        <x-lucide-star class="rating-button" />
                        <x-lucide-star class="rating-button" />
                        <x-lucide-star class="rating-button" />
                        <x-lucide-star class="rating-button" />
                        <x-lucide-star class="rating-button" />
                    </div>
                    <div class="text-start">
                        <button type="submit" class="btn btn-primary me-2">Post your review</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-4 position-relative">
            <div class="card" style="position: sticky; top:65px;">
                <div class="card-img-top position-relative">
                    <img src="@thumbnail($course)" class="card-img-top" alt="{{ $course->title }}" />
                    <button data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        class="z-30 p-0 m-0 bg-white border-none btn d-flex rounded-circle align-items-center justify-content-center"
                        style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 34px; height: 34px;">
                        <x-lucide-play-circle class="text-black" style="width: 32px; height: 32px;" />
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
                        <form action="/" method="post">
                            <button type="button" class="btn btn-primary" type="buy">Enroll</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{}" class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="text-muted">Course preview</p>
                        <h5 class="modal-title" id="staticBackdropLabel">{{ $course->title }}</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/8v_4O44sfjM?si=AMOvaAF6JkCVsfTq"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>


                    <div class="my-4 accordion" id="previewAccordion">
                        @foreach ($sections as $item)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="preview-heading{{ $item->id }}">
                                    <button class="px-2 accordion-button bg-neutral-50" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#preview-collapse{{ $item->id }}" aria-expanded="false"
                                        aria-controls="preview-collapse{{ $item->id }}">
                                        {{ $item->title }}
                                    </button>
                                </h2>
                                <div id="preview-collapse{{ $item->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="preview-heading{{ $item->id }}"
                                    data-bs-parent="#sectionAccordion">
                                    <div class="accordion-body ps-2">
                                        @foreach ($chapters as $ch)
                                            @if ($ch->section_id === $item->id)
                                                <div class="py-2 d-flex justify-content-between ps-4">
                                                    <div class="gap-2 d-flex">
                                                        <span>
                                                            <x-lucide-play-circle class="w-4 h-4" />
                                                        </span>
                                                        <span>{{ $ch->title }}</span>
                                                    </div>
                                                    <div class="gap-2 d-flex">
                                                        <span><a href="#">preview</a></span>
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
                                    <div class="gap-2 d-flex align-items-center">
                                        <x-lucide-play-circle class="w-4 h4" />
                                        <span>{{ $ch->title }}</span>
                                    </div>

                                    <div class="gap-2 d-flex">
                                        <span><a href="#">preview</a></span>
                                        <span>12:31</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <div class="modal-footer"> </div>
            </div>
        </div>
    </div>


    <script>
        const ratingButtons = document.querySelectorAll('.rating-button');
        ratingButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                // console.log(e);
                console.log(e.clientX);
            });
        });
        ratingButtons.forEach(function(button) {
            button.addEventListener('mouseover', function(e) {
                console.log(e);
            })
        })
    </script>
</x-app-layout>
