<div class="{{ $class }}">
  <label for="{{$name}}"  class="block text-sm font-medium text-gray-700">{{$slot}}</label>
  <select name="{{$name}}" id="{{$name}}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" {{ ($readonly != "edit") ? 'disabled' : '' }} wire:model="{{$name}}">
    {{$options}}
  </select>
  @error($name) <span class="error text-primary-500">{{ $message }}</span> @enderror
</div>
