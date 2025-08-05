<div class="table-responsive p-0">
    <table class="table table-striped mb-0">
        <thead>
            <tr class="text-capitalize text-secondary text-xxs opacity-7">
                <th>No.</th>
                <th>Datetime</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Like</th>
                <th>Favorite</th>
                <th>Tag</th>
                <th>Comment</th>
                <th>Suggestion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questionLogs as $item)
            <tr wire:key="{{ $loop->index }}" class="text-sm">
                <td>{{ $loop->iteration }}.</td>
                <td>
                    {{ date("D d, M Y H:i a", strtotime($item->created_at)) }}
                </td>
                <td>
                    {{ $item->Question->title }}
                </td>
                <td>
                    {{ $item->is_correct ? 'Correct' : 'Incorrect' }}
                </td>
                <td>
                    {{ $item->is_like ? 'Like' : ($item->is_dislike ? 'Dislike' : '') }}
                </td>
                <td>
                    {{ $item->is_favorite ? 'Favorite' : '' }}
                </td>
                <td>
                    {{ $item->is_tag ? 'Saved' : '' }}
                </td>
                <td>
                    {{ $item->review }}
                </td>
                <td>
                    {{ $item->improve }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>