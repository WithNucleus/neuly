<!-- text input -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    <div class="input-group">
        <input
            id="{{ $field['name'] }}"
            type="text"
            name="{{ $field['name'] }}"
            value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
            @include('crud::fields.inc.attributes')
        >
        <div class="input-group-append">
            <button class="btn btn-secondary" type="button"
             onclick="document.getElementById('{{ $field['name'] }}').value = generateToken();">Generate token</button>
        </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
    </div>
</div>
<script>
    function generateToken(length = 60) {
        let result           = '';
        let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let charactersLength = characters.length;
        for ( let i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
</script>
