-- ============================================================
-- Migrasi: Peminjaman multi-buku
-- Kolom peminjaman.id_buku diubah dari int menjadi array JSON,
-- contoh: [3, 4, 7]
-- Jalankan file ini satu kali pada database maldinci (run/copast ke sql).
-- ============================================================

ALTER TABLE `peminjaman` MODIFY `id_buku` TEXT NOT NULL;

-- Ubah data lama (id tunggal) menjadi array JSON.
-- Nilai yang tidak valid diubah menjadi array kosong.
UPDATE `peminjaman`
SET `id_buku` = CASE
    WHEN `id_buku` REGEXP '^[1-9][0-9]*(,[1-9][0-9]*)*$' THEN CONCAT('[', `id_buku`, ']')
    ELSE '[]'
END
WHERE `id_buku` NOT LIKE '[%';
