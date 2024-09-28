<div id="confirm-delete-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Confirm delete</p>
        <button class="delete cancel-delete-button" aria-label="close"></button>
      </header>
      <section class="modal-card-body">
        <p>Are you sure you want to delete this?</p>
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
  
  <script>
    document.addEventListener("DOMContentLoaded", () => {
    const deleteButtons = document.querySelectorAll(".delete-size-button");
    const confirmModal = document.getElementById("confirm-delete-modal");
    const confirmForm = confirmModal.querySelector("form");
    const cancelButton = document.querySelectorAll(".cancel-delete-button");
    const confirmDeleteButton = document.getElementById(
        "confirm-delete-button"
    );

    deleteButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            event.preventDefault();
            const deleteUrl = button.getAttribute("data-size");
            confirmForm.setAttribute("action", deleteUrl);
            confirmModal.classList.add("is-active");
        });
    });

    cancelButton.forEach((button) => {
        button.addEventListener("click", () => {
            confirmModal.classList.remove("is-active");
        });
    });

    confirmDeleteButton.addEventListener("click", () => {
        confirmForm.submit();
    });
});
  </script><?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/admin/helpers/confirm-modal.blade.php ENDPATH**/ ?>