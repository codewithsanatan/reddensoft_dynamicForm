<h2>This is a Dynamic Form Email</h2>

<br>

@foreach ($data["file_data"] as $filedata)
    @foreach ( $filedata as $key => $file)
        <strong>{{$key}} : {{$file}} </strong><br>
    @endforeach
@endforeach
<br>
<br>
@foreach ($data["data"] as $key => $m_data)
    @foreach ( $m_data as $key => $data)
        @if ($key != "_token")
            <strong>{{$key}} : {{$data}} </strong><br>
        @endif
    @endforeach
@endforeach


Thank you
