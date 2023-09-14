import Swal from "sweetalert2";

export function useConfirmationDialog() {
    const showConfirmationDialog = () => {
        return new Promise((resolve) => {
            Swal.fire({
                title: "<p>Sure to Delete?<p>",
                text: `Are you sure to delete?
        Be careful, the actions performed over delete are permanent.`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Yes, Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    resolve(true);
                } else {
                    resolve(false);
                }
            });
        });
    };

    return {
        showConfirmationDialog,
    };
}
