@isset($list)
<div class="modal fade" id="delete-list-{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="delete-list-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="delete-list-label">Delete {{ $list->name }}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body lead-smaller">
				Are you sure you want to delete this list?<br>All followings in this list will be deleted.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Nevermind</button>
                <form action="{{ route('member.follow-lists.destroy', $list->id) }}" method="post">
                    @csrf
                    @method('delete')
				    <button type="submit" class="btn btn-danger"><i class="fad fa-trash-alt"></i> Delete</button>
                </form>
			</div>
		</div>
	</div>
</div>
@endisset
