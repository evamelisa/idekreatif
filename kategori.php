<?php

include '.include/header.php';

include '.include/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="card-header d-flex justify-content-between
    align-items-center">
            <h4>Data Kategori</h4>

            <button type="button" class="btn btn-primary" data-bs-
        toggle="modal" data-bs-target="#addCategory">
                Tambah Kategori
</button>
</div>

<div class="card-body">
    <div class="table-responsive text-nowrap">
        <table id="datatable" class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th width="50px">#</th>
                    <th>Nama</th>
                    <th width="150px">Pilihan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <?php
            $index = 1;
            $query = "SELECT * FROM categories";
            $exec = mysqli_query($conn, $query);
            while ($category = mysqli_fetch_assoc($exec)) :
            ?>
            <tr>

            <td><?= $index++; ?></td>
            <td><?= $category['category_name']; ?></td>

            <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle 
                hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                data-bs-target="#editCategory_<?= $category['category_id']; ?>">
                    <i class="bx bx-edit-alt me-2"></i>Edit </a>
                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                data-bs-target="#deleteCategory_<?= $category['category_id']; ?>">
                    <i class="bx bx-trash me-2"></i> Delete </a>
            </div>
        </div>
    </td>
            </tr>

            <?php endwhile; ?>
            </tbody>
            </table>
            </div>
            </div>
            </div>
            </div>
            <?php include '.includes/footer.php'; ?>