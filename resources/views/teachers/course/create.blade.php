<x-teacher-layout>
    <div class="d-flex w-100 vh-100 align-items-center justify-content-center">
        <div class="p-6">
            <form method="POST" action="/teacher/course">
                @csrf
                <h2>Name your course</h2>
                <p class="lead">
                    What would you like to name your course? Don't worry, you can change this later.
                </p>

                </p>

                <div class="d-flex flex-column gap-2">
                    <label>Course title</label>
                    <input placeholder="e.g: 'Advanced web development'" value="" type="text" class="form-control" id="course-title" aria-describedby="course-name-helper" name="title" />
                    <p class="text-muted fs-sm" id="course-name-helper"> What will you teach in this course? </p>
                </div>
                <div>

                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                    <a href="/teacher" class="btn btn-default"> Cancel </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-teacher-layout>
