<x-admin-layout>
    <div class="p-5">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>
                            @if ($transaction->type === 'withdraw' && $transaction->status === 'pending')
                                <form action="{{ route('admin.approvewithdrawal') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}" />
                                    <button class="btn btn-outline-success" type="submit">
                                        <x-lucide-check class="w-3 h-3" />
                                        <span>Approve</span>
                                    </button>
                                </form>
                            @elseif($transaction->type === 'withdraw' && $transaction->status === 'approved')
                                <button class="btn btn-outline-success disabled">
                                    <x-lucide-check class="w-3 h-3" />
                                    <span>Approved</span>
                                </button>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
