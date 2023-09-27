<div>
    @isset($filters[$key])
        @if(is_array($filters[$key]))
            <div>
                @if(!empty($filters[$key]))
                    <div>
                        <strong class="text-uppercase">{{ $label }}:</strong>
                        @foreach($filters[$key] as $id => $value)
                            <div>
                                <span>{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div>
                <strong class="text-uppercase">{{ $label }}:</strong>
                <span>{{ $filters[$key] }}</span>
            </div>
        @endif
    @endisset
</div>
