@php
    $value= $value?? null;
@endphp
<div class=" @error($name) is-invalid @enderror {{ $class ?? 'col-md-6' }}">
    @isset($type)
        @switch($type)
            @case('select')
                <select class="ud-form-select form-select " name="{{ $name ?? '' }}" wire:model="{{ $name ?? '' }}" id="{{ $id ?? ($name ?? '') }}"
                    placeholder="{{ $placeholder ?? '' }}">
                    <option value="">{{ __('choose an item') }}</option>
                    @foreach ($options ?? [] as $id => $text)
                        <option value="{{ $id }}" @selected(old($name,$value) == $id)> {{ $text }}</option>
                    @endforeach
                </select>
            @break

            @case('checkbox')
            <input class="form-check-input" type="{{ $type ?? '' }}" name="{{ $name ?? '' }}" wire:model="{{ $name ?? '' }}" id="{{ $id ?? ($name ?? '') }}"
            placeholder="{{ $placeholder ?? '' }}" value="1" @checked(old($name,$value)) />
            <label for="{{ $id ?? ($name ?? '') }}">{{ $placeholder ?? '' }}</label>
            @break

            @case('textarea')
                <textarea class="form-control" name="{{ $name ?? '' }}" wire:model="{{ $name ?? '' }}" id="{{ $id ?? ($name ?? '') }}"
                    placeholder="{{ $placeholder ?? '' }}" cols="30" rows="3"> {{ $value ?? old($name,$value) }} </textarea>
            @break

            @default
                <input class="form-control" type="{{ $type ?? '' }}" name="{{ $name ?? '' }}" wire:model="{{ $name ?? '' }}" id="{{ $id ?? ($name ?? '') }}"
                    placeholder="{{ $placeholder ?? '' }}" value="{{ $value  }}" /> 
        @endswitch
    @endisset
    @isset($name)
        @error($name)
            <span class=" text-danger"> {{ $message }} </span>
        @enderror
    @endisset
</div>
{{-- value="{{ old($name,$value) }} --}}