-- v_last_riwayat

SELECT
    `ranked_messages`.`id_riwayat` AS `id_riwayat`,
    `ranked_messages`.`id_produk` AS `id_produk`,
    `ranked_messages`.`id_user` AS `id_user`,
    `ranked_messages`.`tgl_plotting` AS `tgl_plotting`,
    `ranked_messages`.`tgl_selesai` AS `tgl_selesai`,
    `ranked_messages`.`keterangan` AS `keterangan`,
    `ranked_messages`.`status_kerjaan` AS `status_kerjaan`,
    `ranked_messages`.`rn` AS `rn`
FROM
    (
        SELECT
            `orange-press`.`riwayat`.`id_riwayat` AS `id_riwayat`,
            `orange-press`.`riwayat`.`id_produk` AS `id_produk`,
            `orange-press`.`riwayat`.`id_user` AS `id_user`,
            `orange-press`.`riwayat`.`tgl_plotting` AS `tgl_plotting`,
            `orange-press`.`riwayat`.`tgl_selesai` AS `tgl_selesai`,
            `orange-press`.`riwayat`.`keterangan` AS `keterangan`,
            `orange-press`.`riwayat`.`status_kerjaan` AS `status_kerjaan`,
            row_number() over(
                PARTITION BY `orange-press`.`riwayat`.`id_produk`
                ORDER BY
                    `orange-press`.`riwayat`.`id_riwayat` DESC
            ) AS `rn`
        FROM
            `orange-press`.`riwayat`
    ) `ranked_messages`
WHERE
    `ranked_messages`.`rn` = 1