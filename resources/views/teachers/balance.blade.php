<x-teacher-layout>
    <div class="p-5">
        <div class="gap-2 p-4 d-flex">
            <div class="p-3 rounded border flex-grow-1">
                <p>Balance</p>
                <p class="fw-bold fs-3"> @currency(12000)</p>
            </div>

            <div class="p-3 rounded border flex-grow-1">
                <p>Withdraw</p>
                <form method="POST" action="{{ route('transaction.withdraw') }}">
                    @csrf
                    <div class="gap-4 d-flex">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                        <input class="form-control" name="amount" /> <button class="btn btn-primary">Withdraw</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="gap-2 p-4">
            <h3>History</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date, time</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($history as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>#{{ $item->id }}</td>
                            <td>@currency($item->amount)</td>
                            <td>{{ $item->description }}</td>
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
</x-teacher-layout>
