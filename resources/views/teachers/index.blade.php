<x-teacher-layout>
    <div class="p-5">
        <div class="pb-4 d-flex align-items-center">
            <div class="flex-fill">
                <div style="max-width: 260px;">
                    <input type="text" class="bg-white form-control" placeholder="Filter course..." />
                </div>
            </div>
            <div class="">
                <a href="{{ route('teacher.course.create') }}"
                    class="gap-2 btn btn-primary d-flex align-items-center"><x-lucide-plus-circle class="w-4 h-4" /> New
                    course</a>
            </div>
        </div>
        <div class="overflow-hidden bg-white border border-bottom-0 rounded-3">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>
                                <a href="/teacher/course/setup/{{ $course->slug }}">{{ $course->title }}</a>
                            </td>
                            <td>${{ $course->price }}</td>
                            <td>
                                @if ($course->is_published)
                                    <span class="p-2 text-white badge bg-primary rounded-pill">Published</span>
                                @else
                                    <span class="p-2 text-white badge bg-info rounded-pill">Unpublished</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">More</button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="p-2 px-3 dropdown-item" href="#">
                                                <x-lucide-pencil class="w-4 h-4" style="margin-right: 8px;" /> Edit
                                                course
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-teacher-layout>
