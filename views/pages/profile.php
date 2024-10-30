<section class="py-10 ">
    <h1 class="text-xl font-medium mb-4 text-gray-700">Hii <i class="text-primary underline"> <?= $_SESSION['username']; ?></i></h1>

    <h2 class="text-sm font-medium mb-2 text-gray-700">Profile Information</h2>



    <p class="text-sm mb-5 text-gray-700">Update Your Account's Profile Information</p>
    <form action="../routes.php?action=user_update" method="post" class="space-y-4 w-[50%] mb-10">
        <div>
            <label for="new_username" class="block text-sm font-medium text-gray-700">New Username</label>
            <input type="text" id="new_username" name="new_username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm  sm:text-sm" placeholder="Enter new username">
        </div>
        <div>
            <label for="old_password" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" id="old_password" name="old_password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm" placeholder="Enter current password">
        </div>
        <div>
            <button type="submit" class="w-[50%] bg-primary text-white py-2 rounded-md  ">
                Save
            </button>
        </div>
    </form>
    <hr>
    <h2 class="text-sm font-medium mb-2  mt-10 text-gray-700">Update Password</h2>
    <p class="text-sm mb-5 text-gray-700">Ensure Your Account is using long and random password to stay secure</p>
    <form action="../routes.php?action=user_update" method="POST" class="space-y-4 w-[50%]">
        <div>
            <label for="old_password" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" id="old_password" name="old_password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm" placeholder="Enter current password">
        </div>
        <div>
            <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" id="new_password" name="new_password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter new password">
        </div>

        <div>
            <button type="submit" class="w-[50%] bg-primary text-white py-2 rounded-md ">
                Save
            </button>
        </div>
    </form>
</section>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    <?php if (isset($_SESSION['error'])): ?>
        Toast.fire({
            icon: "error",
            title: "<?= $_SESSION['error']; ?>"
        });
        <?php unset($_SESSION['error']); // Clear error session here after displaying 
        ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        Toast.fire({
            icon: "success",
            title: "<?= $_SESSION['success']; ?>"
        });
        <?php unset($_SESSION['success']); // Clear error session here after displaying 
        ?>
    <?php endif; ?>
</script>