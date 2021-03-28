<table id="{{ $id }}" class="display" style="width:100%">
    <thead>
        <tr>
            @foreach ($datas as $data)
                <th>{{ $data }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    </tbody>
    {{ $footer ?? '' }}
</table>