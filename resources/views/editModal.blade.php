<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editRecord" method="post" enctype="multipart/form-data">
                @CSRF
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" id="editId" name="editId">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Firstname</label>
                        <input class="form-control col-12" type="text" id="editFirstname" name="editFirstname">
                        <span class="text-danger" id="editFirstnameError"></span>
                    </div>

                    <div class="form-group">
                        <label>Lastname</label>
                        <input class="form-control col-12" type="text" id="editLastname" name="editLastname">
                        <span class="text-danger" id="editLastnameError"></span>
                    </div>
                    <div class="form-group">
                        <label>Birth Date</label>
                        <input class="form-control col-12" type="date" id="editBirthdate" name="editBirthdate">
                        <span class="text-danger" id="editBirthdateError"></span>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="editStatus" name="editStatus">
                            <option></option>
                            <option value="Active">Active</option>
                            <option value="Disabled">Disabled</option>
                        </select>
                        <span class="text-danger" id="editStatusError"></span>
                    </div>
                    <div class="form-group">
                        <label>CV (pdf)</label>
                        <input class="form-control-file col-12" type="file" id="cv" name="editCv">
                        <span class="text-danger" id="editCvError"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

