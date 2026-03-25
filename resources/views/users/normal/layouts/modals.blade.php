<div class="modal fade" id="renameModal" tabindex="-1" aria-labelledby="renameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('adm.site.users.renameUserFile', ['id' => $user->id]) }}">
            @csrf
            <input type="hidden" name="user_id" id="renameUserId">
            <input type="hidden" name="old_name" id="renameOldName">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rename File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_name" class="form-label">New File Name</label>
                        <input type="text" class="form-control" name="new_name" id="renameNewName" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Rename</button>
                </div>
            </div>
        </form>

    </div>
</div>
<div class="modal fade" id="moveFileModal" tabindex="-1" aria-labelledby="moveFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('adm.site.users.moveUserFile', $user->id) }}">
            @csrf
            <input type="hidden" name="source_user_id" id="moveSourceUserId">
            <input type="hidden" name="file_name" id="moveFileName">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="moveFileModalLabel">Move File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label for="moveTargetUserId" class="form-label">Destination User ID</label>
                    <input type="number" class="form-control" name="target_user_id" id="moveTargetUserId" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Move</button>
                </div>
            </div>
        </form>
    </div>
</div>