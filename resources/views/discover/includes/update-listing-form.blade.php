<?php
use App\Helpers\ListingRequestHelper;
/**
 * @var \Illuminate\Database\Eloquent\Model $entity
 */

$entityClass = get_class($entity);
$entityType = ListingRequestHelper::getEntityTypeByClass($entityClass);
$entityId = $entity->getKey();
?>
<form method="post" action="{{ route('listing.request') }}">
    @csrf
    <input type="hidden" name="entity_type" value="{{$entityType}}"/>
    <input type="hidden" name="is_update" value="1"/>
    <input type="hidden" name="to_update_id" value="{{$entityId}}"/>
    @isset($preview)
        <input type="hidden" name="preview_request" value="{{$preview}}"/>
        <button type="submit" class="btn btn-info">Approve &amp; Update This Listing</button>
    @else
        <button type="submit" class="btn btn-link text-secondary-emphasis fw-bold btn-sm p-0 text-uppercase">Update this listing</button>
    @endisset
</form>

