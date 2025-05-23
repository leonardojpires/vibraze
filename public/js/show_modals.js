document.addEventListener("DOMContentLoaded", function() {

    /* DELETE USERS MODAL */
    const userModelEl = document.getElementById("deleteUserModal");
    const userDeleteModal = new bootstrap.Modal(userModelEl);
    const deleteButtons  = document.querySelectorAll(".openDeleteModal");
    const confirmDeleteLink = document.getElementById("confirmDeleteLink");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            const userId = this.getAttribute("data-user-id");
            confirmDeleteLink.href = `/delete-user/${userId}`;
            userDeleteModal.show();
        });
    });

    /* DELETE BANDS MODAL */
    const bandModelEl = document.getElementById("deleteBandModal");
    const bandDeleteModal = new bootstrap.Modal(bandModelEl);
    
});
