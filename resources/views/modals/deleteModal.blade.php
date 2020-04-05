
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: pink; color: white;">
        <h4 class="modal-title" id="exampleModalLabel">Are You Sure To Delete?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">Cancel</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="deleteUser" >
          @csrf
            {{ method_field('DELETE') }}

            <h2><p>Deleting this user will delete any action and data releted to this user.</p> 
            <p>Are you sure to delete? once deleted, cannot be UNDO</p></h2>

            <input required type="hidden" name="del_id" id="del_id">

            <label id="pw" class="col-md-4 col-form-label text-md-right"></label>
                            
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
    </form>
      </div>
    </div>
  </div>
</div>