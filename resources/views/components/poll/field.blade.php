
<div class="poll-card-body" style="padding-top: 1rem; padding-bottom: 0rem; padding-left: 1rem; padding-right: 1rem;">
    <div>
        <input name="{{$name}}" value="{{$value}}" type="{{$type}}" class="poll-input poll-form-control" style="margin-bottom: 1rem;">
    </div>
    @error($name)
        <h5 class="poll-h5 poll-card-header inline-flex justify-around" style="font-size: 0.9rem; width: 100%; background-color: rgba(242,113,90,0.6); border-radius: 0.25rem; box-sizing: content-box; margin-left: -16px;">
            {{$message}}</h5>
    @enderror
</div>
