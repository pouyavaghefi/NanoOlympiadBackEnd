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