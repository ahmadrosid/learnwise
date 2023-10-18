<x-teacher-layout>
    <div class="p-5">
        <div class="d-flex align-items-center pb-4">
            <div class="flex-fill">
                <div style="max-width: 260px;">
                    <input type="text" class="form-control bg-white" placeholder="Filter course..." />
                </div>
            </div>
            <div class="">
                <a href="/teacher/course/create" class="btn btn-primary d-flex align-items-center gap-2"><x-lucide-plus-circle class="w-4 h-4" /> New course</a>
            </div>
        </div>
        <div class="border border-bottom-0 bg-white rounded-3 overflow-hidden">
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
                            <a href="/teacher/course/setup">{{$course->title}}</a>
                        </td>
                        <td>${{$course->price}}</td>
                        <td>
                            @if($course->is_published)
                            <span class="badge bg-primary p-2 rounded-pill text-white">Published</span>
                            @else
                            <span class="badge bg-info p-2 rounded-pill text-white">Unpublished</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">More</button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item p-2 px-3" href="#">
                                            <x-lucide-pencil class="w-4 h-4" style="margin-right: 8px;" /> Edit course
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
