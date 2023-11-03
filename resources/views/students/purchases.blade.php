<x-app-layout>

    <div class="p-5">
        <div class="gap-2 p-4">
            <h3>History</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date, time</th>
                        <th>Transaction ID</th>
                        <th>Course</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Status</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($purchases as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>#{{ $item->id }}</td>
                            <td>{{ $item->course_title }}</td>
                            <td>{{ $item->type === 'withdraw' ? '-' : '' }}
                                @currency($item->amount)
                            </td>
                            <td>{{ $item->type }}</td>
                            <td>
                                <div
                                    class="gap-1 d-flex text-capitalize {{ $item->status === 'approved' || $item->status === 'settled' ? ' text-success' : ($item->status === 'pending' ? ' text-muted' : 'text-danger') }}">
                                    @if ($item->status === 'settled' || $item->status === 'approved')
                                        <x-lucide-check-square class="w-3 h-3" />
                                    @elseif($item->status === 'pending')
                                        <x-lucide-list-end class="w-3 h-3" />
                                    @elseif($item->status === 'declined')
                                        <x-lucide-x-square class="w-3 h-3" />
                                    @endif
                                    <span>{{ $item->status }}</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
