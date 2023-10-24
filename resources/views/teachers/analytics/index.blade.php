<x-teacher-layout>
    <div class="d-flex p-4 gap-2">
        <div class="flex-grow-1 border rounded p-3">
            <p>Total Revenue</p>
            <p class="fw-bold fs-3">$ {{$totalRevenue}}</p>
        </div>
        <div class="flex-grow-1 border rounded p-3">
            <p>Total Sales</p>
            <p class="fw-bold fs-3">{{$salesCount}}</p>
        </div>
    </div>

    <div class="d-flex p-4 gap-2">
        <div class="flex-grow-1 border rounded p-3">
            <canvas id="totalRevenue" class="w-full" style="height: 320px; margin:auto"></canvas>
        </div>
    </div>
</x-teacher-layout>