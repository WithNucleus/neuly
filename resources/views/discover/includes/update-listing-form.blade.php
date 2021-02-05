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
    <button type="submit" class="btn btn-link btn-sm p-0">Update this listing</button>
</form>

