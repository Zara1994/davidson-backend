{{ $type }} <br>
{{ $file }} <br>

@if ($type === 'image' && $file)
    <img src="{{ Storage::url($file) }}" style="height: 60px; border-radius: 4px;" />
@elseif ($type === 'video' && $file)
    <video src="{{ Storage::url($file) }}" style="height: 60px;" muted autoplay loop></video>
@elseif ($type === 'text')
    <span style="color: #555;">Text only</span>
@endif
