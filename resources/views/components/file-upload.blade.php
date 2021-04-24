<div class="file-upload">
    <div class="i-file-upload">
        <span>{{ $placeholder }}</span>
        <input type="file" class="file-upload" id="files" name="{{ $name }}"/>
    </div>

    <span class="filesize"></span>

    @if (isset($value->thumb))
    بنر دوره: 
    <img src="{{ $value->thumb }}" width="150" height="150" style="margin-top: 25px;">
    @else
    <span class="selectedFiles">فایلی انتخاب نشده است</span>        
    @endif

    <x-validation-error item="{{ $name }}" />

</div>