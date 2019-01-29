<button type="button" class="btn btn-white" data-toggle="modal" data-target="#deleteModal">
    <i class="material-icons">delete</i>
</button>

<!-- Modal Body -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><i class="material-icons small text-danger">info</i> Delete
                    confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Are you sure want to delete the selected item?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Yeas</button>
            </div>
        </div>
    </div>
</div>