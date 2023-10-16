<x-teacher-layout>
    <div class="d-flex align-items-center pb-4">
        <div class="flex-fill">
            <div style="max-width: 260px;">
                <input type="text" class="form-control bg-white" placeholder="Filter course..." />
            </div>
        </div>
        <div class="">
            <button class="btn btn-primary d-flex align-items-center gap-2"><x-lucide-plus-circle class="w-4 h-4" /> New course</button>
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
                <tr>
                    <td>
                        <a href="/teacher/course/setup">Fullstack Saas Laravel</a>
                    </td>
                    <td>$30</td>
                    <td>
                        <span class="badge bg-primary p-2 rounded-pill text-white">Published</span>
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
                <tr>
                    <td>
                        <a href="/teacher/course/setup">Build an LMS Platform</a>
                    </td>
                    <td>$15</td>
                    <td>
                        <span class="badge bg-info p-2 rounded-pill text-white">Unpublished</span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">More</button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item p-2 px-3" href="#"><x-lucide-pencil class="w-4 h-4" style="margin-right: 8px;" /> Edit course</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="/teacher/course/setup">Fullstack Saas Laravel</a>
                    </td>
                    <td>$29</td>
                    <td>
                        <span class="badge bg-primary p-2 rounded-pill text-white">Published</span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">More</button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item p-2 px-3" href="#"><x-lucide-pencil class="w-4 h-4" style="margin-right: 8px;" /> Edit course</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-teacher-layout>