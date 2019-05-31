{{--<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="createRecord" method="post" enctype="multipart/form-data">
                @CSRF
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Firstname</label>
                        <input class="form-control col-12" type="text" id="firstname" name="firstname">
                        <span class="text-danger" id="firstnameError"></span>
                    </div>

                    <div class="form-group">
                        <label>Lastname</label>
                        <input class="form-control col-12" type="text" id="lastname" name="lastname">
                        <span class="text-danger" id="lastnameError"></span>
                    </div>
                    <div class="form-group">
                        <label>Birth Date</label>
                        <input class="form-control col-12" type="date" id="birthdate" name="birthdate">
                        <span class="text-danger" id="birthdateError"></span>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="status" name="status">
                            <option></option>
                            <option value="Active">Active</option>
                            <option value="Disabled">Disabled</option>
                        </select>
                        <span class="text-danger" id="statusError"></span>
                    </div>
                    <div class="form-group">
                        <label>CV (pdf)</label>
                        <input class="form-control-file col-12" type="file" id="cv" name="cv">
                        <span class="text-danger" id="cvError"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>--}}

<div class="modal fade" id="JSmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="createRecord" method="post" enctype="multipart/form-data">
                @CSRF
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="JSmodalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

