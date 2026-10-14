<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * Custom button-style pagination template
 * Usage: <?= $pager->links('group', 'custom_buttons') ?>
 *
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);

$group = $group ?? 'default';

if ($pager->getPageCount($group) <= 1) {
    return;
}

$currentPage = $pager->getCurrentPageNumber($group);
$pageCount   = $pager->getPageCount($group);
?>

<nav aria-label="Page navigation" class="d-flex justify-content-center">
    <ul class="pagination pagination-sm mb-0 gap-1">
        <!-- First Page -->
        <?php if ($currentPage > 1): ?>
            <li class="page-item">
                <a class="page-link btn btn-outline-primary btn-sm" href="<?= $pager->getFirst($group) ?>" aria-label="First">
                    <i class="bi bi-chevron-double-left"></i>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link btn btn-outline-primary btn-sm disabled"><i class="bi bi-chevron-double-left"></i></span>
            </li>
        <?php endif; ?>

        <!-- Previous Page -->
        <?php if ($pager->hasPreviousPage($group)): ?>
            <li class="page-item">
                <a class="page-link btn btn-outline-primary btn-sm" href="<?= $pager->getPreviousPage($group) ?>" aria-label="Previous">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link btn btn-outline-primary btn-sm disabled"><i class="bi bi-chevron-left"></i></span>
            </li>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php foreach ($pager->links($group) as $link): ?>
            <?php if ($link['active']): ?>
                <li class="page-item active" aria-current="page">
                    <span class="page-link btn btn-primary btn-sm"><?= $link['title'] ?></span>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link btn btn-outline-primary btn-sm" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Next Page -->
        <?php if ($pager->hasNextPage($group)): ?>
            <li class="page-item">
                <a class="page-link btn btn-outline-primary btn-sm" href="<?= $pager->getNextPage($group) ?>" aria-label="Next">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link btn btn-outline-primary btn-sm disabled"><i class="bi bi-chevron-right"></i></span>
            </li>
        <?php endif; ?>

        <!-- Last Page -->
        <?php if ($currentPage < $pageCount): ?>
            <li class="page-item">
                <a class="page-link btn btn-outline-primary btn-sm" href="<?= $pager->getLast($group) ?>" aria-label="Last">
                    <i class="bi bi-chevron-double-right"></i>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link btn btn-outline-primary btn-sm disabled"><i class="bi bi-chevron-double-right"></i></span>
            </li>
        <?php endif; ?>
    </ul>
</nav>