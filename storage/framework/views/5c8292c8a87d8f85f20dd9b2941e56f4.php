<div id="confirm-delete-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Confirm delete</p>
        <button class="delete cancel-delete-button" aria-label="close"></button>
      </header>
      <section class="modal-card-body">
        <p>Are you sure you want to delete this size?</p>
      </section>
      <footer class="modal-card-foot">
        <form style="display: inline-block" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        <button type="submit" class="button is-danger mr-3" id="confirm-delete-button">Delete</button>
        <button type="button" class="button cancel-delete-button">Cancel</button>
        </form>
      </footer>
    </div>
  </div>
  <?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/admin/sizes/confirm-modal.blade.php ENDPATH**/ ?>