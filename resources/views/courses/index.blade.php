@php
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
            'star' => 3,
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
    <img src="@thumbnail($course)" class="object-cover rounded-3 ratio ratio-4x3" alt="{{ $course->title }}"
        style="max-height: 320px;;" />

    <div class="my-5">
        <h1>{{ $course->title }}</h1>
        <div class="my-2">
            <x-markdown :options="['commonmark' => ['enable_strong' => false]]" theme="github-dark">
                {!! $course->description !!}
            </x-markdown>
        </div>
    </div>

    <h2>Chapters</h2>
    <div class="gap-5 d-flex flex-column">
        @foreach ($chapters as $chapter)
            <div>
                <h4> <a href="/course/{{ $slug }}/chapter/{{ $chapter->position }}">{{ $chapter->title }} </a>
                </h4>
                <div class="my-2">
                    <x-markdown :options="['commonmark' => ['enable_strong' => false]]" theme="github-dark">
                        {!! $chapter->description !!}
                    </x-markdown>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        <h2>What they say?</h2>
        <div class="gap-4 d-flex flex-column">
            @foreach ($feedbacks as $feedback)
                <div class="gap-4 d-flex align-items-start">
                    <img src="https://randomuser.me/portraits/{{ $feedback['gender'] }}/{{ $feedback['imgId'] }}.jpg"
                        class="rounded-circle" width="65px" />
                    <div class="p-2 text-white rounded bg-dark">
                        <h5>{{ $feedback['name'] }}</h5>
                        <div class="d-flex">
                            {{-- <x-lucide-star-half class="w-4 h-4 text-warning" /> --}}
                            @for ($i = 0; $i < $feedback['star']; $i++)
                                <x-lucide-star class="w-4 h-4 text-warning" />
                            @endfor
                        </div>
                        <blockquote>
                            {{ $feedback['comment'] }}
                        </blockquote>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
