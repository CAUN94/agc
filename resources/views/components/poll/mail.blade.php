<div class="poll-card lg:w-3/5 lg:col-span-10 mx-auto poll-mt-4">
    <h6 class="poll-h6 poll-card-header" style="color:#f2715a; background-color: white;">
        Tu Mail
    </h6>

    <div class="poll-card-body" style="padding-top: 1rem; padding-bottom: 0rem; padding-left: 1rem; padding-right: 1rem;">
        <div>
            <input name="mail" value="{{ old('mail') }}" type="email" class="poll-input poll-form-control" placeholder="you@justbetter.cl" style="margin-bottom: 1rem;">
        </div>
            @error('mail')
                <h5 class="poll-h5 poll-card-header inline-flex justify-around" style="font-size: 0.9rem; width: 100%; background-color: rgba(242,113,90,0.6); border-radius: 0.25rem; box-sizing: content-box; margin-left: -16px;">
                    Por favor ingrese un valor</h5>
            @enderror
    </div>
</div>
