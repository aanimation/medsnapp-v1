<div class="table-responsive p-0">
    <table class="table table-striped mb-0">
        <thead>
            <tr class="text-capitalize text-secondary text-xxs opacity-7">
                <th>No.</th>
                <th>Start</th>
                <th>Patient</th>
                <th>Examination</th>
                <th>Investigation</th>
                <th>Treatment</th>
                <th>Health</th>
                <th>Reputation</th>
                <th>Finished</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patientLogs as $item)
            <tr wire:key="{{ $loop->index }}" class="text-sm">
                <td>{{ $loop->iteration }}.</td>
                <td>
                    {{ date("D d, M Y H:i a", strtotime($item->created_at)) }}
                </td>
                <td>
                    {{ $item->Quest->title }}
                </td>
                <td class="text-center">
                    {{ $item->examination }}
                </td>
                <td class="text-center">
                    {{ $item->investigation }}
                </td>
                <td class="text-center">
                    {{ $item->treatment }}
                </td>
                <td class="text-center">
                    {{ $item->amount }}%
                </td>
                <td class="text-center">
                    {{ $item->reputation ?? '-' }}
                </td>
                <td>
                    @if($item->finished_at)
                        {{ date("D d, M Y H:i a", strtotime($item->finished_at)) }}
                    @else
                        <span class="text-danger">Not finished yet</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>