<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
  data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- EDIT FORM  body-->
        <form id="edit_form" action="./edit/edit_pro.php" method="post">

          <input class="edit_input" name="id" type="hidden" id="id">

          <div class="mb-3">
            <label for='name' class="form-label">First Name</label>
            <input class="edit_input" name="first_name" type="text" id="name">
          </div>

          <div class="mb-3">
            <label for='last_name' class="form-label">Last Name</label>
            <input class="edit_input" type="text" name="last_name" id="last_name">
          </div>

          <div class="mb-3">
            <label for='email' class="form-label">email</label>
            <input class="edit_input" type="email" name="email" id="email">
          </div>

          <div class="mb-3 text">
            <label for="address" class="form-label">Address</label>
            <textarea class="edit_input" id="address" name="address"></textarea>
          </div>

          <div class="mb-3">
            <label for="phone_number" class="form-label">Phone #</label>
            <input class="edit_input" type="tel" class="form-control" id="phone_number" name="phone_number">
          </div>

          <div class="mb-3 option">
            <label for="status">status</label>
            <select name="status">
              <option value="1">Active</option>
              <option value="0">inactive</option>
            </select>
          </div>
          
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
        
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
  data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Create FORM  body-->
        <form action="./create/create_pro.php" method="post">
          <div class="mb-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" name="first_name">
          </div>

          <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" name="last_name">
          </div>


          <div class="mb-3">
            <label for='email' class="form-label">email</label>
            <input type="email" name="email" class="form-control" />
          </div>

          <div class="mb-3 text">
            <label for="address" class="form-label">Address</label>
            <textarea name="address"></textarea>
          </div>

          <div class="mb-3">
            <label for="phone_number" class="form-label">Phone #</label>
            <input type="tel" class="form-control" name="phone_number">
          </div>

          <div class="mb-3 option">
            <label for="status">status</label>
            <select name="status">
              <option value="1">Active</option>
              <option value="0">inactive</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>