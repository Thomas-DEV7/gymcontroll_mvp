<?php if (isset($_SESSION['toast'])): ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        <div id="liveToast" class="toast align-items-center text-bg-<?= $_SESSION['toast']['type'] ?> border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($_SESSION['toast']['message']) ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toastEl = document.getElementById('liveToast');
            const toast = new bootstrap.Toast(toastEl, {
                delay: 3000 // 3 seconds
            });
            toast.show();
        });
    </script>

    <?php unset($_SESSION['toast']); ?>
<?php endif; ?>
