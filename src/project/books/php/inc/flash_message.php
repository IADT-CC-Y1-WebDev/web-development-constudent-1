<?php
$flash = getFlashMessage();
if ($flash): ?>
    <div class="flash flash-<?= h($flash['type']) ?>">
        <?= h($flash['message']) ?>
    </div>
<?php endif; ?>