<div class="modal fade" id="deleteModal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal}Label-{{ $id }}"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $id }}">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                Are you sure want to delete the selected item ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('delete-form').submit()">
                    Yes
                </button>

                <form id="delete-form" action="{{ $link }}" method="post">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
    </div>
</div>