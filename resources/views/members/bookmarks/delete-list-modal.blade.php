@isset($list)
<!-- Modal -->
<div class="modal fade" id="delete-list" tabindex="-1" role="dialog" aria-labelledby="delete-list-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="delete-list-label">Delete {{ $list->name }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body lead-smaller">
				Are you sure you want to delete this list?<br>All bookmarks in this list will be deleted.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-dismiss="modal">Nevermind</button>
				<a href="{{ route('member.bookmarks.destroy-list', $list->id) }}" class="btn btn-danger"><i class="fad fa-trash-alt"></i> Delete</a>
			</div>
		</div>
	</div>
</div>
@endisset