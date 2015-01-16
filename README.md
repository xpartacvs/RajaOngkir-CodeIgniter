RajaOngkir-CodeIgniter
===================

Library codeigniter 2.x untuk layanan query ongkos kirim dari <a href="http://rajaongkir.com" target="_blank">RajaOngkir</a>. Dokumientasi API asli lihat <a href="http://rajaongkir.com/dokumentasi" target="_blank">disini</a>.

Kebutuhan Sistem
================

<ul>
  <li>PHP >= 5.3</li>
  <li>cURL extension</li>
  <li>JSON extension</li>
  <li>Framework CodeIgniter 2.x</li>
</ul>

Instalasi
=========

<ol>
  <li>Copy file <code>application/config/rajaongkir.php</code> ke direktori <code>application/config</code> pada instalasi codeigniter Anda.</li>
  <li>Copy file <code>application/libraries/Rajaongkir.php</code> ke direktori <code>application/libraries</code> pada instalasi codeigniter Anda.</li>
  <li>Buka file <code>application/config/rajaongkir.php</code> yang sudah di-<i>copy</i> dengan text editor Anda.</li>
  <li>
    Masukan API Key yang Anda dapat dari akun RajaOngkir:<br><br>
    <ul>
      <li><code>$config['rajaongkir_key_api'] = 'API-KEY-ANDA';</code></li>
    </ul>
  </li>
</ol>

Daftar Konstanta
=============
<ul>
  <li><code>Rajaongkir::RETURN_DEFAULT</code><br>Jika Anda menghedaki nilai return dalam betuk asli (default - string). Gunakan sebagai parameter untuk semua fungsi public.</li>
  <li><code>Rajaongkir::RETURN_JSON</code><br>Jika Anda menghedaki nilai return berupa JSON object. Gunakan sebagai parameter untuk semua fungsi public.</li>
  <li><code>Rajaongkir::RETURN_ARRAY</code><br>Jika Anda menghedaki nilai return berupa array. Gunakan sebagai parameter untuk semua fungsi public.</li>
  <li><code>Rajaongkir::COURIER_ALL</code><br>Jika Anda menghedaki untuk mendapatkan daftar tarif dari seluruh ekspedisi yang ada. Gunakan sebagai parameter untuk fungsi <code>get_cost()</code>.</li>
  <li><code>Rajaongkir::COURIER_JNE</code><br>Jika Anda menghedaki untuk mendapatkan daftar tarif dari ekspedisi Jalur Nugraha Ekakurir (JNE). Gunakan sebagai parameter untuk fungsi <code>get_cost()</code>.</li>
  <li><code>Rajaongkir::COURIER_POS</code><br>Jika Anda menghedaki untuk mendapatkan daftar tarif dari ekspedisi PT POS Indonesia (POS). Gunakan sebagai parameter untuk fungsi <code>get_cost()</code>.</li>
  <li><code>Rajaongkir::COURIER_TIKI</code><br>Jika Anda menghedaki untuk mendapatkan daftar tarif dari ekspedisi Citra Van Titipan Kilat (TIKI). Gunakan sebagai parameter untuk fungsi <code>get_cost()</code>.</li>
  <li><code>Rajaongkir::COURIER_PCP</code><br>Jika Anda menghedaki untuk mendapatkan daftar tarif dari ekspedisi Priority Cargo and Package (PCP). Gunakan sebagai parameter untuk fungsi <code>get_cost()</code>.</li>
  <li><code>Rajaongkir::COURIER_ESL</code><br>Jika Anda menghedaki untuk mendapatkan daftar tarif dari ekspedisi Eka Sari Lorena (ESL). Gunakan sebagai parameter untuk fungsi <code>get_cost()</code>.</li>
  <li><code>Rajaongkir::COURIER_RPX</code><br>Jika Anda menghedaki untuk mendapatkan daftar tarif dari ekspedisi RPX Holding (RPX). Gunakan sebagai parameter untuk fungsi <code>get_cost()</code>.</li>
</ul>

Daftar Fungsi
=============
<ul>
  <li><code>mixed get_province([$id_province=NULL] [,$return_type=Rajaongkir::RETURN_DEFAULT])</code><br>Mendapatkan daftar propinsi yang ada di Indonesia. Return FALSE jika gagal.</li>
  <li><code>mixed get_city([$id_province=NULL] [,$id_city=NULL] [,$return_type=Rajaongkir::RETURN_DEFAULT])</code><br>Mendapatkan daftar kota/kabupaten yang ada di Indonesia. Return FALSE jika gagal.</li>
  <li><code>mixed get_cost($id_city_origin, $id_city_destination, $weight [,$courier=Rajaongkir::COURIER_ALL] [,$return_type=Rajaongkir::RETURN_DEFAULT])</code><br>Mengetahui tarif pengiriman (ongkos kirim) dari dan ke kota tujuan tertentu dengan berat tertentu. Return FALSE jika gagal.</li>
</ul>