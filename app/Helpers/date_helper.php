<?php

if (!function_exists('format_indo')) {
    /**
     * Fungsi untuk memformat tanggal ke dalam format Bahasa Indonesia.
     *
     * @param string $date_sql Tanggal dalam format SQL (Y-m-d H:i:s)
     * @param string $format   Format output yang diinginkan
     * @return string
     */
    function format_indo($date_sql, $format = 'd MMMM Y')
    {
        if ($date_sql === null || $date_sql === '0000-00-00 00:00:00') {
            return '-';
        }
        
        $date = new DateTime($date_sql);

        // Daftar nama bulan dan hari dalam Bahasa Indonesia
        $nama_bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $nama_hari = [
            'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 
            'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
        ];
        
        // Ganti placeholder format dengan nilai yang sesuai
        $replacements = [
            'd' => $date->format('d'),
            'j' => $date->format('j'),
            'D' => substr($nama_hari[$date->format('l')], 0, 3),
            'l' => $nama_hari[$date->format('l')],
            'm' => $date->format('m'),
            'M' => substr($nama_bulan[(int)$date->format('n')], 0, 3),
            'F' => $nama_bulan[(int)$date->format('n')],
            'Y' => $date->format('Y'),
            'y' => $date->format('y'),
            'H' => $date->format('H'),
            'h' => $date->format('h'),
            'i' => $date->format('i'),
            's' => $date->format('s'),
            'A' => $date->format('A'),
            'a' => $date->format('a'),
        ];
        
        $formatted_date = strtr($format, $replacements);

        return $formatted_date;
    }
}
