<div>
    @if($external)
        <button type="button" wire:click="applyLink" class="btn btn-lg btn-primary">Apply Now</button>
    @else
        <a href="{{ $url }}" class="btn btn-lg btn-primary">Apply Now</a>
    @endif
</div>
