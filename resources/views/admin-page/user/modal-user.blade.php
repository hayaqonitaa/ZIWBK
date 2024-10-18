<!-- Modal untuk tambah user -->
<div class="modal fade" id="addUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">ADD USER</h3>
        </div>
        <form id="addUserForm" class="row g-3" onsubmit="return false">
          <div class="col-12 col-md-12">
            <label class="form-label" for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" required/>
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required/>
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required/>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
