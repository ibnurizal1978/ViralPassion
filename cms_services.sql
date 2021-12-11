-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for cms_services
CREATE DATABASE IF NOT EXISTS `cms_services` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cms_services`;

-- Dumping structure for table cms_services.berita
CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `updater` varchar(32) NOT NULL,
  `slug_berita` varchar(255) NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `status_berita` varchar(20) NOT NULL,
  `jenis_berita` varchar(20) NOT NULL,
  `keywords` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `hits` int(11) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_publish` datetime NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `slug_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.berita: 0 rows
/*!40000 ALTER TABLE `berita` DISABLE KEYS */;
/*!40000 ALTER TABLE `berita` ENABLE KEYS */;

-- Dumping structure for table cms_services.download
CREATE TABLE IF NOT EXISTS `download` (
  `id_download` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori_download` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul_download` varchar(200) DEFAULT NULL,
  `jenis_download` varchar(20) NOT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `hits` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_download`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.download: 2 rows
/*!40000 ALTER TABLE `download` DISABLE KEYS */;
INSERT INTO `download` (`id_download`, `id_kategori_download`, `id_user`, `judul_download`, `jenis_download`, `isi`, `gambar`, `website`, `hits`, `tanggal`) VALUES
	(2, 1, 4, 'Panduan Untuk Admin Engineering Utama', 'Download', '<p>Panduan Untuk Admin Engineering</p>', 'banner-top-asli-1591956558.pdf', 'https://javawebmedia.com', 2, '2020-06-12 17:21:41'),
	(3, 1, 4, 'Buku Panduan PT SBI (ADMIN ENGINEERING', 'Download', '<p>Buku Panduan PT SBI (ADMIN ENGINEERING</p>', 'instagram-feed-2020-1592019516.pptx', NULL, 2, '2020-06-13 10:47:45');
/*!40000 ALTER TABLE `download` ENABLE KEYS */;

-- Dumping structure for table cms_services.galeri
CREATE TABLE IF NOT EXISTS `galeri` (
  `id_galeri` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori_galeri` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul_galeri` varchar(200) DEFAULT NULL,
  `jenis_galeri` varchar(20) NOT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `popup_status` enum('Publish','Draft','','') NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `status_text` enum('Ya','Tidak','','') NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_galeri`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.galeri: 2 rows
/*!40000 ALTER TABLE `galeri` DISABLE KEYS */;
INSERT INTO `galeri` (`id_galeri`, `id_kategori_galeri`, `id_user`, `judul_galeri`, `jenis_galeri`, `isi`, `gambar`, `website`, `hits`, `popup_status`, `urutan`, `status_text`, `tanggal`) VALUES
	(9, 4, 4, 'Java Web Media <span>Kursus</span>', 'Homepage', '<p>Pusat Kursus Programming, Desain dan Statistik dengan format Kelas dan Private</p>', 'produk-javawebmedia-01-1592630207.jpg', 'https://javawebmedia.com', NULL, 'Publish', 0, 'Ya', '2020-06-20 12:16:48'),
	(11, 4, 4, 'Selamat Datang di Educamedia', 'Homepage', '<p>Yuk download dan kursus langsung di Educamedia</p>', '3169210-1592003020.jpg', 'https://javawebmedia.com', NULL, 'Publish', 1, 'Ya', '2020-06-20 12:15:35');
/*!40000 ALTER TABLE `galeri` ENABLE KEYS */;

-- Dumping structure for table cms_services.gambar_produk
CREATE TABLE IF NOT EXISTS `gambar_produk` (
  `id_gambar_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_gambar_produk` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_gambar_produk`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.gambar_produk: 1 rows
/*!40000 ALTER TABLE `gambar_produk` DISABLE KEYS */;
INSERT INTO `gambar_produk` (`id_gambar_produk`, `id_user`, `id_produk`, `nama_gambar_produk`, `gambar`, `keterangan`, `urutan`, `tanggal`) VALUES
	(2, 0, 1, '', 'NITRICO_Distributor_Ad_01_b2.jpg', '', 0, '2020-05-30 06:45:38');
/*!40000 ALTER TABLE `gambar_produk` ENABLE KEYS */;

-- Dumping structure for table cms_services.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `slug_kategori` varchar(255) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `hits` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `nama_kategori` (`nama_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.kategori: 3 rows
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`id_kategori`, `id_user`, `slug_kategori`, `nama_kategori`, `urutan`, `hits`, `tanggal`) VALUES
	(4, 1, 'penelitian-internal', 'Penelitian Internal', 4, 0, '2020-06-11 05:08:23'),
	(5, 1, 'kegiatan-organisasi', 'Kegiatan Organisasi', 5, 0, '2020-06-11 05:08:31'),
	(6, 0, 'penelitian-internasional', 'Penelitian Internasional', 3, 0, '2020-06-11 04:31:46');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

-- Dumping structure for table cms_services.kategori_download
CREATE TABLE IF NOT EXISTS `kategori_download` (
  `id_kategori_download` int(11) NOT NULL AUTO_INCREMENT,
  `slug_kategori_download` varchar(255) NOT NULL,
  `nama_kategori_download` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kategori_download`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.kategori_download: 2 rows
/*!40000 ALTER TABLE `kategori_download` DISABLE KEYS */;
INSERT INTO `kategori_download` (`id_kategori_download`, `slug_kategori_download`, `nama_kategori_download`, `urutan`) VALUES
	(1, 'product-pricelist', 'Product Pricelist', 1),
	(2, 'informasi-nitrico', 'Informasi Nitrico', 2);
/*!40000 ALTER TABLE `kategori_download` ENABLE KEYS */;

-- Dumping structure for table cms_services.kategori_galeri
CREATE TABLE IF NOT EXISTS `kategori_galeri` (
  `id_kategori_galeri` int(11) NOT NULL AUTO_INCREMENT,
  `slug_kategori_galeri` varchar(255) NOT NULL,
  `nama_kategori_galeri` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kategori_galeri`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.kategori_galeri: 2 rows
/*!40000 ALTER TABLE `kategori_galeri` DISABLE KEYS */;
INSERT INTO `kategori_galeri` (`id_kategori_galeri`, `slug_kategori_galeri`, `nama_kategori_galeri`, `urutan`) VALUES
	(4, 'kegiatan', 'Kegiatan', 2),
	(6, 'kegiatan-kampus', 'Kegiatan Kampus', 1);
/*!40000 ALTER TABLE `kategori_galeri` ENABLE KEYS */;

-- Dumping structure for table cms_services.kategori_produk
CREATE TABLE IF NOT EXISTS `kategori_produk` (
  `id_kategori_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori_produk` varchar(200) NOT NULL,
  `slug_kategori_produk` varchar(200) NOT NULL,
  `urutan` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_kategori_produk`),
  UNIQUE KEY `nama_kategori` (`nama_kategori_produk`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.kategori_produk: 3 rows
/*!40000 ALTER TABLE `kategori_produk` DISABLE KEYS */;
INSERT INTO `kategori_produk` (`id_kategori_produk`, `nama_kategori_produk`, `slug_kategori_produk`, `urutan`, `keterangan`, `gambar`, `tanggal`) VALUES
	(1, 'Kursus Programming', 'kursus-programming', 1, '<p>Kursus Programming</p>', 'produk-javawebmedia-02-1592630261.jpg', '2020-06-20 12:17:41'),
	(3, 'Kursus Desain', 'kursus-desain', 2, '<p>Kursus Desain dan UI/UX</p>', 'produk-javawebmedia-05-1592630467.jpg', '2020-06-20 12:21:07'),
	(4, 'Kursus Statistik dan Manajemen Data', 'kursus-statistik-dan-manajemen-data', 3, '<p>Kursus Statistik dan Manajemen Data</p>', 'produk-javawebmedia-11-1592630490.jpg', '2020-06-20 12:21:30');
/*!40000 ALTER TABLE `kategori_produk` ENABLE KEYS */;

-- Dumping structure for table cms_services.konfigurasi
CREATE TABLE IF NOT EXISTS `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT,
  `namaweb` varchar(200) NOT NULL,
  `nama_singkat` varchar(20) DEFAULT NULL,
  `tagline` varchar(200) DEFAULT NULL,
  `tagline2` varchar(255) DEFAULT NULL,
  `tentang` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_cadangan` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `keywords` varchar(400) DEFAULT NULL,
  `metatext` text DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `google_plus` varchar(255) DEFAULT NULL,
  `nama_facebook` varchar(255) NOT NULL,
  `nama_twitter` varchar(255) NOT NULL,
  `nama_instagram` varchar(255) NOT NULL,
  `nama_google_plus` varchar(255) NOT NULL,
  `singkatan` varchar(255) NOT NULL,
  `google_map` text DEFAULT NULL,
  `judul_1` varchar(200) DEFAULT NULL,
  `pesan_1` varchar(200) DEFAULT NULL,
  `judul_2` varchar(200) DEFAULT NULL,
  `pesan_2` varchar(200) DEFAULT NULL,
  `judul_3` varchar(200) DEFAULT NULL,
  `pesan_3` varchar(200) DEFAULT NULL,
  `judul_4` varchar(200) DEFAULT NULL,
  `pesan_4` varchar(200) DEFAULT NULL,
  `judul_5` varchar(200) DEFAULT NULL,
  `pesan_5` varchar(200) NOT NULL,
  `judul_6` varchar(200) DEFAULT NULL,
  `pesan_6` varchar(200) NOT NULL,
  `isi_1` varchar(500) DEFAULT NULL,
  `isi_2` varchar(500) DEFAULT NULL,
  `isi_3` varchar(500) DEFAULT NULL,
  `isi_4` varchar(500) DEFAULT NULL,
  `isi_5` varchar(500) DEFAULT NULL,
  `isi_6` varchar(500) DEFAULT NULL,
  `link_1` varchar(255) DEFAULT NULL,
  `link_2` varchar(255) DEFAULT NULL,
  `link_3` varchar(255) DEFAULT NULL,
  `link_4` varchar(255) DEFAULT NULL,
  `link_5` varchar(255) DEFAULT NULL,
  `link_6` varchar(255) DEFAULT NULL,
  `javawebmedia` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `rekening` text DEFAULT NULL,
  `prolog_topik` text DEFAULT NULL,
  `prolog_program` text DEFAULT NULL,
  `prolog_sekretariat` text DEFAULT NULL,
  `prolog_aksi` text DEFAULT NULL,
  `prolog_kolaborasi` text DEFAULT NULL,
  `prolog_sebaran` text DEFAULT NULL,
  `gambar_berita` varchar(255) DEFAULT NULL,
  `prolog_agenda` text DEFAULT NULL,
  `prolog_wawasan` text DEFAULT NULL,
  `protocol` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_timeout` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `judul_pembayaran` varchar(255) DEFAULT NULL,
  `isi_pembayaran` text DEFAULT NULL,
  `gambar_pembayaran` varchar(255) DEFAULT NULL,
  `link_bawah_peta` varchar(255) DEFAULT NULL,
  `text_bawah_peta` varchar(255) NOT NULL,
  `cara_pesan` enum('Keranjang Belanja','Formulir Pemesanan') NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `currency` varchar(10) DEFAULT NULL,
  `currency_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_konfigurasi`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.konfigurasi: 1 rows
/*!40000 ALTER TABLE `konfigurasi` DISABLE KEYS */;
INSERT INTO `konfigurasi` (`id_konfigurasi`, `namaweb`, `nama_singkat`, `tagline`, `tagline2`, `tentang`, `deskripsi`, `website`, `email`, `email_cadangan`, `alamat`, `telepon`, `hp`, `fax`, `logo`, `icon`, `keywords`, `metatext`, `facebook`, `twitter`, `instagram`, `google_plus`, `nama_facebook`, `nama_twitter`, `nama_instagram`, `nama_google_plus`, `singkatan`, `google_map`, `judul_1`, `pesan_1`, `judul_2`, `pesan_2`, `judul_3`, `pesan_3`, `judul_4`, `pesan_4`, `judul_5`, `pesan_5`, `judul_6`, `pesan_6`, `isi_1`, `isi_2`, `isi_3`, `isi_4`, `isi_5`, `isi_6`, `link_1`, `link_2`, `link_3`, `link_4`, `link_5`, `link_6`, `javawebmedia`, `gambar`, `video`, `rekening`, `prolog_topik`, `prolog_program`, `prolog_sekretariat`, `prolog_aksi`, `prolog_kolaborasi`, `prolog_sebaran`, `gambar_berita`, `prolog_agenda`, `prolog_wawasan`, `protocol`, `smtp_host`, `smtp_port`, `smtp_timeout`, `smtp_user`, `smtp_pass`, `judul_pembayaran`, `isi_pembayaran`, `gambar_pembayaran`, `link_bawah_peta`, `text_bawah_peta`, `cara_pesan`, `id_user`, `tanggal`, `currency`, `currency_name`) VALUES
	(1, 'Services', 'Services', 'Services', 'Services', '<p>Web untuk Beli Followers</p>', 'Web untuk Beli Followers', 'http://localhost/pakrizal', 'taufan_h@hotmail.com', 'taufan_h@hotmail.com', 'Jakarta Pusat\r\nDKI Jakarta', '085770699410', '085770699410', '085770699410', 'logo-educamedia-putih-1592059001.png', 'icon-educamedia-1592059011.png', 'educamedia, java web media, laravel, online course, kursus online', NULL, NULL, NULL, NULL, 'https://www.youtube.com/channel/UCmm6mFZXYQ3ZylUMa0Tmc2Q', '', '', '', '', 'Services', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7930.3386078467065!2d106.82893243028725!3d-6.372131203377098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed5d166b756d%3A0x41d8cdc14c819774!2sDepok%20Town%20Square!5e0!3m2!1sen!2sid!4v1579565022446!5m2!1sen!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>', 'Tempat belajar nyaman', 'fa fa-home', 'Materi Kursus Selalu Update', 'fa fa-laptop', 'Jadwal Flexibel', 'fa fa-thumbs-up', 'Menjaga Amanah', 'fa-check-square-o', 'Tempat belajar nyaman', 'fa-home', 'Online service', 'fa-laptop', 'Kami menyediakan tempat belajar yang nyaman dan menyenangkan serasa di rumah sendiri', 'Materi kursus kamu selalu uptodate, Anda bisa mengunduh apa yang dipelajari', 'Bagi Anda siswa yang ingin belajar, kami menerapkan jadwal flexibel', 'Kami senantiasa menjaga amanah yang diberikan kepada donatur agar sampai di tangan yang berhak.', 'Kami menyediakan tempat belajar yang nyaman dan menyenangkan', 'Website kamu selalu uptodate, Anda bisa mengunduh apa yang dipelajari', '', '', '', '', '', '', '<p>Berawal dari keinginan ibunda Hj.Masah Muhari diakhir hidupnya untuk mewakaan sebagian hartanya dijalan Allah, gayungpun bersambut pada bulan Mei 2011 saat kami akan melaksanakan ibadah umrah, Seorang rekan kami sesama Jamaah bernama ustadzah Hj. Zainur Fahmid memberikan informasi Tentang Anggota yang hendak mewakaan sebidang tanahnya di wilayah Beji Timur. Kami pun memanjatkan doa di kota suci dengan penuh rasa harap pertolongan Allah untuk menunjukan jalan terbaik-Nya, maka sepulang umroh kami mengadakan pertemuan di kediaman Ibu Dra Hj Ratna Mardjanah untuk membicarakan visi misi kami dalam wakaf tersebut dan sepakat untuk mendirikan Istana Yatim Riyadhul Jannah ini.</p>\r\n<p>Nama Riyadhul Jannah Sendiri diambil dari nama pengelola wakaf (H. Ahmad Riyadh Muchtar, Lc) dan pemberi wakaf (Dra Hj Ratna Mardjanah). Istana Yatim Riyadhul Jannah hadir untuk melayani dan memfasilitasi segala kebutuhan anak yatim, terutama pendidikan agama, akhlak dan kehidupan yang layak untuk bekal masa depan mereka yang cerah agar bisa memberi manfaat bagi umat. Harapan kami semoga dengan membangunkan istana untuk anak yatim, maka Allah akan berikan istana-Nya di surga kelak dan kita termasuk manusia yang bisa memberika manfaat bagi sesama sebagaimana sabda Rasulullah SAW yang artinya:&nbsp;</p>\r\n<p>&ldquo;Sebaik-baik manusia adalah yang paling bermanfaat bagi manusia lainnya&rdquo;&nbsp;</p>\r\n<p>erimakasih atas segala bentuk bantuan yang dipercayakan kepada kami baik secara materi, tenaga dan kiran serta doa para muhsinin dan muhsinat Istana Yatim Riyadhul Jannah selama ini, mulai dari rencana pendirian hingga berkembang seperti saat ini. Semoga segala amal menjadi shadaqah jariyah disisi-Nya.&nbsp;</p>\r\n<p>&nbsp;</p>', 'wallpaper-v3-ori-01-1592023305.jpg', 'fsH_KhUWfho', '<table id="dataTables-example" class="table table-bordered" width="100%">\r\n<thead>\r\n<tr>\r\n<th tabindex="0" colspan="1" rowspan="1" width="19%">Nama Bank</th>\r\n<th tabindex="0" colspan="1" rowspan="1" width="21%">Nomor Rekening</th>\r\n<th tabindex="0" colspan="1" rowspan="1" width="7%">Atas nama</th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>BCA KCP Margo City</td>\r\n<td>4212548204</td>\r\n<td>Andoyo</td>\r\n</tr>\r\n<tr>\r\n<td>Bank Mandiri KCP Universitas Indonesia</td>\r\n<td>1570001807768</td>\r\n<td>Eflita Meiyetriani</td>\r\n</tr>\r\n<tr>\r\n<td>Bank BNI Syariah Kantor Cabang Jakarta Selatan</td>\r\n<td>0105301001</td>\r\n<td>Eflita Meiyetriani</td>\r\n</tr>\r\n</tbody>\r\n</table>', '<p>Dalam mewujudkan pembangunan berkelanjutan, pemerintah kabupaten anggota LTKL telah mengidentifikasi dan memilih topik yang sesuai dengan kondisi di daerahnya. Ada 5 topik prioritas yang dipilih dengan penerapan yang disesuaikan kembali di masing-masing kabupaten.</p>', NULL, '<p>Setelah Lingkar Temu Kabupaten Lestari (LTKL) diinisiasi, kesekretariatan dibentuk untuk membantu para pemerintah kabupaten anggota bekerja dan berkolaborasi. Walaupun tidak memiliki mandat implementasi, Sekretariat LTKL menjadi vital dalam melancarkan koordinasi, pengumpulan basis data, hingga pelaporan perkembangan. Sekretariat LTKL juga diperkuat dengan kehadiran personil yang telah berpengalaman di bidang management pengetahuan, program pembangunan berkelanjutan hingga kebijakan.</p>', '', '<p>Lingkar Temu Kabupaten Lestari (LTKL) mengedepankan kolaborasi dalam mewududkan pembangunan berkelanjutan. Ada 10 kabupaten yang tersebar di 6 provinsi di Indonesia telah menjadi anggota LTKL.</p>\r\n<p>Hingga kini, berbagai pihak telah ikut berkolaborasi, mulai dari pemerintah kabupaten, sekeretariat LTKL, mitra pembangunan hingga pihak swasta.</p>', '', 'balairung-budiutomo-01.jpg', '<p>Acara yang ditampilkan merupakan kumpulan acara LTKL, mitra, maupun pemerintah kabupaten anggota LTKL, mulai dari acara seminar hingga festival.</p>', '<p>LTKL bukan satu-satunya yang bergerak dalam mewujudkan pembangunan berkelanjutan, serta upaya penanggulangan perubahan iklim. Ikuti terus perkembangan usaha LTKL serta rekan-rekan lain menuju bumi dan Indonesia yang lestari.</p>', 'smtp', '-', '465', '12', 'test@test.com', '123', 'Metode Pembayaran Produk', '<p>Anda dapat melakukan pembayaran dengan beberapa cara, yaitu:</p>\r\n<ol>\r\n<li><strong>Pembayaran Tunai</strong>, dapat Anda serahkan secara langsung ke salah satu staff Java Web Media</li>\r\n<li><strong>Pembayar Via Transfer Rekening</strong></li>\r\n</ol>\r\n<p>Lakukan transfer biaya atas layanan dan produk&nbsp;<strong>Java Web Media</strong>&nbsp;ke salah satu rekening di bawah ini.</p>\r\n<h3>Konfirmasi Pembayaran</h3>\r\n<p>Anda dapat melakukan konfirmasi pembayaran melalui:</p>\r\n<ul>\r\n<li><strong>Melalui Email</strong>, silakan kirim bukti pembayaran ke:&nbsp;<strong><a href="mailto:contact@javawebmedia.co.id?subject=Konfirmasi%20Pembayaran">contact@javawebmedia.co.id</a></strong></li>\r\n<li><strong>Melalui Whatsapp</strong>, kirimkan bukti pembayaran Anda ke&nbsp;<strong>+6281210697841</strong></li>\r\n<li><strong>Melalui Formulir Konfirmasi Pembayaran</strong>, Anda dapat mengunggah bukti pembayaran Anda melalui form&nbsp;<strong><a title="Konfirmasi Pembayaran" href="https://javawebmedia.com/konfirmasi">&nbsp;Konfirmasi Pembayaran</a></strong></li>\r\n</ul>', 'payment.jpg', NULL, '', 'Formulir Pemesanan', 4, '2021-11-19 15:42:06', '$', 'USD');
/*!40000 ALTER TABLE `konfigurasi` ENABLE KEYS */;

-- Dumping structure for table cms_services.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cms_services.migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table cms_services.pemesanan
CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_rekening` int(11) DEFAULT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `token_transaksi` varchar(255) NOT NULL,
  `tanggal_order` date NOT NULL,
  `nomor_transaksi` int(11) NOT NULL,
  `status_pemesanan` varchar(255) NOT NULL DEFAULT 'Menunggu',
  `nama_pemesan` varchar(255) NOT NULL,
  `telepon_pemesan` varchar(255) NOT NULL,
  `email_pemesan` varchar(255) DEFAULT NULL,
  `alamat` varchar(300) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `harga_produk` bigint(20) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `ongkir` bigint(20) DEFAULT NULL,
  `total_biaya` bigint(20) DEFAULT NULL,
  `tanggal_pemesanan` datetime DEFAULT NULL,
  `cara_bayar` varchar(255) DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `pengirim` varchar(255) DEFAULT NULL,
  `nama_bank_pengirim` varchar(255) DEFAULT NULL,
  `nomor_rekening_pengirim` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_pemesanan`),
  UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  UNIQUE KEY `token_transaksi` (`token_transaksi`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.pemesanan: 6 rows
/*!40000 ALTER TABLE `pemesanan` DISABLE KEYS */;
INSERT INTO `pemesanan` (`id_pemesanan`, `id_user`, `id_produk`, `id_rekening`, `kode_transaksi`, `token_transaksi`, `tanggal_order`, `nomor_transaksi`, `status_pemesanan`, `nama_pemesan`, `telepon_pemesan`, `email_pemesan`, `alamat`, `jumlah_produk`, `harga_produk`, `total_harga`, `ongkir`, `total_biaya`, `tanggal_pemesanan`, `cara_bayar`, `tanggal_bayar`, `bukti`, `jumlah`, `pengirim`, `nama_bank_pengirim`, `nomor_rekening_pengirim`, `keterangan`, `tanggal_post`, `tanggal_update`) VALUES
	(1, 4, 2, 0, 'JWM202006100001', 'kMpUQADBlGkeTQhR7439a6zsqX6dWmzK', '2020-06-10', 1, 'Dikirim', 'Andoyo', '085715100485', 'javawebmedia@gmail.com', 'adadada', 1, 12000, 12000, 0, 0, '2020-06-10 07:57:46', '', '0000-00-00', '', 0, '', '', '', '', '2020-06-10 07:57:46', '2020-06-12 20:53:42'),
	(2, 4, 1, 0, 'JWM202006120002', 'wvFD60jruVx9vYJ1aFL4WLOZAeYQXkxx', '2020-06-12', 2, 'Menunggu', 'Eflita Meiyetriani', '085715100485', 'javawebmedia@gmail.com', 'ADADA ADADA ADADA AAFA', 1, 10000, 10000, 0, 0, '2020-06-12 12:12:56', '', '0000-00-00', '', 0, '', '', '', '', '2020-06-12 12:12:56', '2020-06-12 21:13:02'),
	(3, 0, 1, 0, 'JWM202006120003', 'alN7qAzNj1lopbjwsWswvKecvWjxQUzv', '2020-06-12', 3, 'Menunggu', 'Rayyan Andoyo', '085715100485', 'lalu-kekah@bkkbn.go.id', 'Perumahan Ferrari', 1, 10000, 10000, 0, 0, '2020-06-12 17:57:42', '', '0000-00-00', '', 0, '', '', '', '', '2020-06-12 17:57:42', '2020-06-13 00:57:42'),
	(4, 4, 1, 0, 'JWM202006120004', 'P3uAxeJ3TSvlfYzGRjwgMncwLBQdq3vb', '2020-06-12', 4, 'Konfirmasi', 'Rayyan Andoyo', '085715100485', 'lalu-kekah@bkkbn.go.id', 'Perumahan Ferrari', 1, 10000, 10000, 0, 0, '2020-06-12 17:58:15', '', '0000-00-00', '', 0, '', '', '', '', '2020-06-12 17:58:15', '2020-06-13 01:56:39'),
	(5, 4, 1, 2, 'JWM202006120005', 'rrzHk1NcrkK3KvYnqse4XdudWGz3tiZL', '1970-01-01', 5, 'Selesai', 'UDIN SIMALAKAMA', '085715100485', 'javawebmedia@gmail.com', 'Desa Sumberejo', 1, 10000, 10000, 200000, 210000, '2020-06-12 18:19:57', 'Transfer', '2020-06-13', '357-1591985014.jpg', 200000, 'Andoyo', 'BCA', '2424242', NULL, '2020-06-12 18:03:35', '2020-06-13 01:54:33'),
	(6, 0, 5, NULL, 'JWM202006180006', 'MxnOVRcARIiPe3vBI4O9YoVxJY0z3B2M', '2020-06-18', 6, 'Menunggu', 'Andoyo', '085715100485', 'javawebmedia@gmail.com', 'adadada adada', 1, 120000, 120000, NULL, NULL, '2020-06-18 07:57:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-18 07:57:03', '2020-06-18 14:57:03');
/*!40000 ALTER TABLE `pemesanan` ENABLE KEYS */;

-- Dumping structure for table cms_services.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_kategori_produk` int(11) NOT NULL,
  `slug_produk` varchar(255) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `status_produk` varchar(20) NOT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `isi` text NOT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_terendah` int(11) DEFAULT NULL,
  `harga_tertinggi` int(11) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `mulai_diskon` date DEFAULT NULL,
  `selesai_diskon` date DEFAULT NULL,
  `besar_diskon` int(12) DEFAULT NULL,
  `jenis_diskon` enum('Potongan','Persentase') DEFAULT NULL,
  `jumlah_order_min` int(11) DEFAULT NULL,
  `jumlah_order_max` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `ukuran` varchar(255) DEFAULT NULL,
  `hits` bigint(20) DEFAULT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.produk: 0 rows
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;

-- Dumping structure for table cms_services.rekening
CREATE TABLE IF NOT EXISTS `rekening` (
  `id_rekening` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_rekening`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.rekening: 4 rows
/*!40000 ALTER TABLE `rekening` DISABLE KEYS */;
INSERT INTO `rekening` (`id_rekening`, `nama_bank`, `nomor_rekening`, `atas_nama`, `gambar`, `urutan`, `tanggal`) VALUES
	(1, 'BCA KCP DEPOK', '4212-5482-04', 'ANDOYO', 'bca.jpg', 1, '2020-06-12 04:36:46'),
	(2, 'BNI SYARIAH DEPOK', '0611-9927-06', 'CV JAVA WEB MEDIA', 'Logo_BNI_Syariah.png', 2, '2019-11-13 06:54:18'),
	(4, 'BANK MANDIRI KCU DEPOK', '157-00-0180776-8', 'EFLITA MEIYETRIANI', 'mandiri.png', 4, '2019-11-13 06:58:42'),
	(5, 'BANK BNI KCU DEPOK', '0105-3010-01', 'EFLITA MEIYETRIANI', 'bni.png', 5, '2019-11-13 07:00:13');
/*!40000 ALTER TABLE `rekening` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_contacts
CREATE TABLE IF NOT EXISTS `t_contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(150) DEFAULT NULL,
  `contact_email` varchar(150) DEFAULT NULL,
  `contact_message` text DEFAULT NULL,
  `contact_date` datetime DEFAULT NULL,
  `read_status` int(1) DEFAULT NULL,
  `text_reply` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contact_subject` text DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_contacts: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_contacts` DISABLE KEYS */;
INSERT INTO `t_contacts` (`contact_id`, `contact_name`, `contact_email`, `contact_message`, `contact_date`, `read_status`, `text_reply`, `user_id`, `contact_subject`) VALUES
	(1, 'taufan', 'taufan_h@hotmail.com', 'asasasasa', '2021-11-18 00:00:00', 0, NULL, NULL, 'Sudah pelunasan invoice Hosting tetapi masih suspended');
/*!40000 ALTER TABLE `t_contacts` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_customers
CREATE TABLE IF NOT EXISTS `t_customers` (
  `customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(35) DEFAULT '',
  `customer_email` varchar(25) DEFAULT '',
  `customer_product_id` varchar(15) DEFAULT '',
  `session_id` varchar(250) DEFAULT NULL,
  `customer_created_dt` datetime NOT NULL,
  `customer_link` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`customer_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_customers: ~6 rows (approximately)
/*!40000 ALTER TABLE `t_customers` DISABLE KEYS */;
INSERT INTO `t_customers` (`customer_id`, `customer_name`, `customer_email`, `customer_product_id`, `session_id`, `customer_created_dt`, `customer_link`) VALUES
	(88, '', 'taufan_h@hotmail.com', '2', 'yPvb72a0M5UbLhE75FzzRWnUQTniyyujOtSSRbdT', '2021-11-24 14:10:00', 'https://www.instagram.com/p/CJc60Z7Je-I'),
	(90, '', 'taufan_h@hotmail.com', '2', 'uyhxwaQcraksYMVbuRX69K19QGIOMJpcECRKnGQ4', '2021-11-25 02:37:33', 'https://www.instagram.com/p/CAJvT3TlL5n'),
	(91, '', 'taufan_h@hotmail.com', '2', 'uyhxwaQcraksYMVbuRX69K19QGIOMJpcECRKnGQ4', '2021-11-25 03:37:50', 'https://www.instagram.com/p/CAH6LJ2FZXu'),
	(94, '', 'taufan_h@hotmail.com', '2', 'uyhxwaQcraksYMVbuRX69K19QGIOMJpcECRKnGQ4', '2021-11-25 06:12:27', 'https://www.instagram.com/p/CK9QWImlQDm'),
	(109, '', 'taufan_h@hotmail.com', '2', 'uyhxwaQcraksYMVbuRX69K19QGIOMJpcECRKnGQ4', '2021-11-25 08:06:30', 'https://www.instagram.com/p/CJc6hr8lSlp'),
	(139, '', 'taufan_h@hotmail.com', '4', '7tXKG5qPaeVWiAHRwgii2uWrzxvN9uuLpEVU2hdU', '2021-11-26 13:25:53', 'poinsukses');
/*!40000 ALTER TABLE `t_customers` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_faq
CREATE TABLE IF NOT EXISTS `t_faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_question` text DEFAULT NULL,
  `active_status` int(1) DEFAULT NULL,
  `faq_answer` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_faq: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_faq` DISABLE KEYS */;
INSERT INTO `t_faq` (`faq_id`, `faq_question`, `active_status`, `faq_answer`, `user_id`) VALUES
	(1, 'apa kabar ?', 1, 'Baik Baik Sajaaaaaaaa', 4);
/*!40000 ALTER TABLE `t_faq` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_log_api
CREATE TABLE IF NOT EXISTS `t_log_api` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `api_name` varchar(100) DEFAULT '',
  `log_date` datetime NOT NULL,
  `log_response_code` varchar(10) DEFAULT '',
  `log_request` text NOT NULL,
  `log_response` text NOT NULL,
  `api_url` varchar(150) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_log_api: ~2 rows (approximately)
/*!40000 ALTER TABLE `t_log_api` DISABLE KEYS */;
INSERT INTO `t_log_api` (`id`, `api_name`, `log_date`, `log_response_code`, `log_request`, `log_response`, `api_url`) VALUES
	(1, 'smmOrder', '2021-11-26 14:06:31', '', '{"service_id":"2295","target":"poinsukses","quantity":500}', '{"result":false,"data":{"msg":"Saldo Anda tidak mencukupi."}}', '0'),
	(2, 'smmOrder', '2021-11-26 14:06:49', '', '{"service_id":"2295","target":"poinsukses","quantity":500}', '{"result":false,"data":{"msg":"Saldo Anda tidak mencukupi."}}', '0');
/*!40000 ALTER TABLE `t_log_api` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_orders
CREATE TABLE IF NOT EXISTS `t_orders` (
  `order_id` int(50) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `services_id` int(2) DEFAULT NULL,
  `product_id` int(2) DEFAULT NULL,
  `no_invoice` varchar(20) DEFAULT '',
  `order_amount` varchar(50) DEFAULT NULL,
  `order_status` varchar(10) DEFAULT '',
  `payment_code` varchar(20) DEFAULT '',
  `payment_channel` varchar(10) DEFAULT '',
  `payment_date_time` datetime NOT NULL,
  `response_service` varchar(50) DEFAULT '',
  `link_1` varchar(150) DEFAULT NULL,
  `link_2` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_orders: ~11 rows (approximately)
/*!40000 ALTER TABLE `t_orders` DISABLE KEYS */;
INSERT INTO `t_orders` (`order_id`, `customer_id`, `order_date`, `services_id`, `product_id`, `no_invoice`, `order_amount`, `order_status`, `payment_code`, `payment_channel`, `payment_date_time`, `response_service`, `link_1`, `link_2`) VALUES
	(1, 0, '2021-11-25 13:49:26', 3, 4, '4U701843NF599305B', '2', 'Pending', '', 'Paypal', '0000-00-00 00:00:00', '', NULL, NULL),
	(2, 112, '2021-11-25 13:50:24', 3, 4, '5TM90375CW553541W', '2', 'Pending', '', 'Paypal', '0000-00-00 00:00:00', '', NULL, NULL),
	(3, 117, '2021-11-25 13:56:26', 3, 4, '6XG70308K57496827', '2.00', 'Pending', '', 'paypal', '0000-00-00 00:00:00', '', NULL, NULL),
	(4, 123, '2021-11-25 14:26:59', 3, 4, '1L861240E2607292S', '2.00', 'Pending', '', 'paypal', '0000-00-00 00:00:00', '', NULL, NULL),
	(5, 125, '2021-11-25 14:31:56', 3, 4, '4F966092YL500702M', '2.00', 'Pending', '', 'paypal', '0000-00-00 00:00:00', '', NULL, NULL),
	(6, 133, '2021-11-25 14:36:29', 3, 4, '20W97397ND219515L', '2.00', 'Pending', '', 'paypal', '0000-00-00 00:00:00', '', NULL, NULL),
	(7, 134, '2021-11-25 14:38:20', 3, 4, '0VN72415P79638609', '2.00', 'Pending', '', 'paypal', '0000-00-00 00:00:00', '', NULL, NULL),
	(8, 137, '2021-11-25 14:45:47', 3, 4, '25K41435RA860783F', '2.00', 'COMPLETED', '', 'paypal', '2021-11-25 14:46:31', '', NULL, NULL),
	(9, 138, '2021-11-25 14:50:15', 3, 4, '93J85380GG038360D', '4.00', 'COMPLETED', '', 'paypal', '2021-11-25 14:50:41', '', NULL, NULL),
	(10, 138, '2021-11-25 14:52:55', 3, 4, '0AY234029H401633M', '4.00', 'COMPLETED', '', 'paypal', '2021-11-25 14:53:37', '', NULL, NULL),
	(11, 138, '2021-11-25 15:04:11', 3, 4, '6FP09178JU3199710', '4.00', 'Pending', '', 'paypal', '0000-00-00 00:00:00', '', NULL, NULL),
	(12, 139, '2021-11-26 13:42:41', 3, 4, '6UW715373L004605P', '4', 'COMPLETED', '', 'paypal', '2021-11-26 14:06:48', 'Saldo Anda tidak mencukupi.', NULL, NULL);
/*!40000 ALTER TABLE `t_orders` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_pages
CREATE TABLE IF NOT EXISTS `t_pages` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `picture` text NOT NULL,
  `active_status` enum('1','0') NOT NULL DEFAULT '1',
  `summary` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_pages: ~3 rows (approximately)
/*!40000 ALTER TABLE `t_pages` DISABLE KEYS */;
INSERT INTO `t_pages` (`id`, `title`, `slug_title`, `content`, `picture`, `active_status`, `summary`, `user_id`, `updated_date`) VALUES
	(10, 'About Us', 'about-us', '<p>&lt;p&gt;<br />Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate<br />velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in<br />culpa qui officia deserunt mollit anim id est laborum<br />&lt;/p&gt;<br />&lt;ul&gt;<br />&lt;li&gt;&lt;i class="ri-check-double-line"&gt;&lt;/i&gt; Ullamco laboris nisi ut aliquip ex ea commodo consequa&lt;/li&gt;<br />&lt;li&gt;&lt;i class="ri-check-double-line"&gt;&lt;/i&gt; Duis aute irure dolor in reprehenderit in voluptate velit&lt;/li&gt;<br />&lt;li&gt;&lt;i class="ri-check-double-line"&gt;&lt;/i&gt; Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in&lt;/li&gt;<br />&lt;/ul&gt;<br />&lt;p class="fst-italic"&gt;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore<br />magna aliqua.<br />&lt;/p&gt;</p>', '', '1', '<h2>Eum ipsam laborum deleniti velitena</h2>\r\n            <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assum perenda sruen jonee trave</h3>', 4, '2021-11-18 03:55:01'),
	(11, 'Terms of service', 'term-of-service', '<p>&lt;p&gt;<br />Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate<br />velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in<br />culpa qui officia deserunt mollit anim id est laborum<br />&lt;/p&gt;<br />&lt;ul&gt;<br />&lt;li&gt;&lt;i class="ri-check-double-line"&gt;&lt;/i&gt; Ullamco laboris nisi ut aliquip ex ea commodo consequa&lt;/li&gt;<br />&lt;li&gt;&lt;i class="ri-check-double-line"&gt;&lt;/i&gt; Duis aute irure dolor in reprehenderit in voluptate velit&lt;/li&gt;<br />&lt;li&gt;&lt;i class="ri-check-double-line"&gt;&lt;/i&gt; Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in&lt;/li&gt;<br />&lt;/ul&gt;<br />&lt;p class="fst-italic"&gt;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore<br />magna aliqua.<br />&lt;/p&gt;</p>', '', '1', 'isi Terms of service', 4, '2021-11-18 04:04:06'),
	(12, 'Privacy policy', 'privacy-policy', '<p>&lt;p&gt;<br />Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate<br />velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in<br />culpa qui officia deserunt mollit anim id est laborum<br />&lt;/p&gt;<br />&lt;ul&gt;<br />&lt;li&gt;&lt;i class="ri-check-double-line"&gt;&lt;/i&gt; Ullamco laboris nisi ut aliquip ex ea commodo consequa&lt;/li&gt;<br />&lt;li&gt;&lt;i class="ri-check-double-line"&gt;&lt;/i&gt; Duis aute irure dolor in reprehenderit in voluptate velit&lt;/li&gt;<br />&lt;li&gt;&lt;i class="ri-check-double-line"&gt;&lt;/i&gt; Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in&lt;/li&gt;<br />&lt;/ul&gt;<br />&lt;p class="fst-italic"&gt;<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore<br />magna aliqua.<br />&lt;/p&gt;</p>', '', '1', 'summary Privacy policyPrivacy policyPrivacy policyPrivacy policy', 4, '2021-11-18 04:04:20');
/*!40000 ALTER TABLE `t_pages` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_payment_notification
CREATE TABLE IF NOT EXISTS `t_payment_notification` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `notification_date` datetime NOT NULL,
  `notification_invoice` varchar(100) DEFAULT '',
  `notification_amount` varchar(10) DEFAULT '',
  `notification_status` varchar(10) DEFAULT '',
  `notification_token` varchar(250) DEFAULT '',
  `notification_channel` varchar(100) DEFAULT '',
  `notification_p_code` varchar(100) DEFAULT '',
  `notification_issuer` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_payment_notification: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_payment_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_payment_notification` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_produk
CREATE TABLE IF NOT EXISTS `t_produk` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `tipe_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` varchar(20) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `product_id_smm` varchar(25) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `active_status` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `selected_product` int(11) DEFAULT NULL,
  `featured_product` int(11) DEFAULT NULL,
  `placeholder` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_produk: ~4 rows (approximately)
/*!40000 ALTER TABLE `t_produk` DISABLE KEYS */;
INSERT INTO `t_produk` (`product_id`, `service_id`, `tipe_id`, `product_name`, `product_price`, `product_qty`, `product_id_smm`, `product_description`, `active_status`, `user_id`, `inserted_date`, `selected_product`, `featured_product`, `placeholder`) VALUES
	(1, 1, 1, 'Instagram Follower 100 Real Indo', '1', 100, '1232', '<p>Test 1234</p>', 1, 4, '2021-11-16 14:09:05', 1, 0, NULL),
	(2, 1, 2, 'Instagram Likes 1000 Real Indo', '10', 1000, '1233', '<ul>\r\n<li>Fast Response</li>\r\n<li>Real Indo</li>\r\n<li>Acitve User</li>\r\n</ul>', 1, 4, '2021-11-16 14:34:21', 1, 1, NULL),
	(3, 2, 2, 'Youtube Likes speed 20K', '5', 3000, '12321', '<p>- Instant Start<br />- Speed 20k+/D<br />- No Refill /No refund With any reason .</p>', 1, 4, '2021-11-18 13:59:39', 1, 0, NULL),
	(4, 3, 1, 'TikTok 500 Followers Real Indo Aktif', '4', 500, '2295', '<p>bla bla bla</p>', 1, 4, '2021-11-21 03:04:02', 0, 0, NULL);
/*!40000 ALTER TABLE `t_produk` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_services
CREATE TABLE IF NOT EXISTS `t_services` (
  `services_id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(50) NOT NULL DEFAULT '0',
  `description` varchar(250) NOT NULL DEFAULT '0',
  `services_name` varchar(100) NOT NULL,
  `active_status` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`services_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_services: ~3 rows (approximately)
/*!40000 ALTER TABLE `t_services` DISABLE KEYS */;
INSERT INTO `t_services` (`services_id`, `icon`, `description`, `services_name`, `active_status`, `user_id`, `inserted_date`) VALUES
	(1, 'icon-ig-3-1637899900.png', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia', 'Instagram', 1, 4, '2021-11-16 06:19:43'),
	(2, 'icon-yutub-1637899771.png', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia', 'Youtube', 1, 4, '2021-11-16 06:20:05'),
	(3, 'icon-tiktok-1637899777.png', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia', 'TikTok', 1, 4, '2021-11-16 06:21:15');
/*!40000 ALTER TABLE `t_services` ENABLE KEYS */;

-- Dumping structure for table cms_services.t_tipe_produk
CREATE TABLE IF NOT EXISTS `t_tipe_produk` (
  `tipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tipe` varchar(50) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `placeholder` int(11) DEFAULT NULL,
  PRIMARY KEY (`tipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table cms_services.t_tipe_produk: ~4 rows (approximately)
/*!40000 ALTER TABLE `t_tipe_produk` DISABLE KEYS */;
INSERT INTO `t_tipe_produk` (`tipe_id`, `nama_tipe`, `active_status`, `placeholder`) VALUES
	(1, 'Followers', 1, NULL),
	(2, 'Likes', 1, NULL),
	(3, 'Views', 1, NULL),
	(4, 'Subscribers', 1, NULL);
/*!40000 ALTER TABLE `t_tipe_produk` ENABLE KEYS */;

-- Dumping structure for table cms_services.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `akses_level` varchar(20) NOT NULL,
  `kode_rahasia` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.users: 2 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `akses_level`, `kode_rahasia`, `gambar`, `tanggal`) VALUES
	(4, 'Andoyo Cakep', 'javawebmedia@gmail.com', 'javawebmedia', 'dc28d4424ece38803650f440d7eb1cb2b3fb6651', 'Admin', NULL, 'testimonials-1.jpg', '2020-06-20 13:51:42'),
	(14, 'Eflita Meiyetriani', 'eflita@gmail.com', 'eflita', '4228f9df60d56e866971c15271382b9f10251ce0', 'Admin', NULL, NULL, '2020-06-12 06:17:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table cms_services.video
CREATE TABLE IF NOT EXISTS `video` (
  `id_video` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `posisi` varchar(20) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `video` text NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `bahasa` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_video`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- Dumping data for table cms_services.video: 64 rows
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` (`id_video`, `judul`, `posisi`, `keterangan`, `video`, `urutan`, `bahasa`, `id_user`, `tanggal`) VALUES
	(1, 'BAGIAN 1 DASAR-DASAR CSS KURSUS JAVA WEB MEDIA ', 'Homepage', 'BAGIAN 1 DASAR-DASAR CSS KURSUS JAVA WEB MEDIA ', 'kOEbjxl42hQ', 1, 'Indonesia', 4, '2020-01-22 06:47:59'),
	(2, 'BAGIAN 2 PERENCANAAN DATABASE, PHPMYADMIN, EXPORT DAN IMPORT ', 'Homepage', 'BAGIAN 2 PERENCANAAN DATABASE, PHPMYADMIN, EXPORT DAN IMPORT ', '3Tn79YuiWX8', 2, 'Indonesia', 4, '2020-01-22 06:48:16'),
	(3, 'BAGIAN 3 - CODEIGNITER DAN CRUD DASAR ', 'Homepage', 'BAGIAN 3 - CODEIGNITER DAN CRUD DASAR ', '-X0Jwf3V8SY', 3, 'Indonesia', 4, '2020-01-22 06:50:25'),
	(4, 'BAGIAN 4 - MODUL USER/ADMINISTRATOR', 'Homepage', 'BAGIAN 4 - MODUL USER/ADMINISTRATOR', 'K9RoEV1U3YQ', 4, 'Indonesia', 4, '2020-01-22 06:50:21'),
	(5, 'BAGIAN 5 - AUTHENTICATION LOGIN, LOGOUT DAN PROTEKSI HALAMAN', 'Homepage', 'BAGIAN 5 - AUTHENTICATION LOGIN, LOGOUT DAN PROTEKSI HALAMAN', 'pweuSiKKCcs', 5, 'Indonesia', 4, '2020-01-22 06:50:17'),
	(6, 'BAGIAN 6 - MODUL BERITA, KATEGORI BERITA DAN TINYMCE ', 'Homepage', 'BAGIAN 6 - MODUL BERITA, KATEGORI BERITA DAN TINYMCE ', 'Lmxkm0C8ZlY', 6, 'Indonesia', 4, '2020-01-22 06:50:14'),
	(7, 'BAGIAN 7 TEMPLATE DAN LAYOUT FRONT END', 'Homepage', 'BAGIAN 7 TEMPLATE DAN LAYOUT FRONT END', 'Lb8NTMZrFaE', 7, 'Indonesia', 4, '2020-01-22 06:50:10'),
	(8, 'BAGIAN 8 MENAMPILKAN LISTING DAN DETAIL BERITA (TUTORIAL CODEIGNITER)', 'Homepage', 'BAGIAN 8 MENAMPILKAN LISTING DAN DETAIL BERITA (TUTORIAL CODEIGNITER)', 'uNdvaTZiOHo', 8, 'Indonesia', 4, '2020-01-22 06:50:06'),
	(9, 'BAGIAN 9 MODUL DOKUMEN DAN UPLOAD FILE ', 'Homepage', 'BAGIAN 9 MODUL DOKUMEN DAN UPLOAD FILE ', 'IKAQLcQEJx0', 9, 'Indonesia', 4, '2020-01-22 06:50:03'),
	(10, 'BAGIAN 10 MODUL GALERI DAN VIDEO SERTA MODUL KONFIGURASI', 'Homepage', 'BAGIAN 10 MODUL GALERI DAN VIDEO SERTA MODUL KONFIGURASI', 'h2YDawzGTTQ', 10, 'Indonesia', 4, '2020-01-22 06:49:59'),
	(11, 'BAGIAN 11 HOMEPAGE SLIDER, GALERI, VIDEO DAN KONTAK CODEIGNITER TUTORIAL ', 'Homepage', 'BAGIAN 11 HOMEPAGE SLIDER, GALERI, VIDEO DAN KONTAK CODEIGNITER TUTORIAL ', 'dTA3-GxQyks', 11, 'Indonesia', 4, '2020-01-22 06:49:55'),
	(12, 'BAGIAN 12 INSPECT ELEMENT, MENGUBAH CSS, PEMESANAN DOMAIN DAN UPLOAD WEB ONLINE', 'Homepage', 'BAGIAN 12 INSPECT ELEMENT, MENGUBAH CSS, PEMESANAN DOMAIN DAN UPLOAD WEB ONLINE', '58xSNF_kxno', 12, 'Indonesia', 4, '2020-01-22 06:49:52'),
	(13, 'TUTORIAL JAVA WEB MEDIA - INSTALASI WEB SERVER DAN CODE EDITOR SUBLIME TEXT 3', 'Homepage', 'TUTORIAL JAVA WEB MEDIA - INSTALASI WEB SERVER DAN CODE EDITOR SUBLIME TEXT 3', 'pOZE0bb7iLc', 13, 'Indonesia', 4, '2020-01-22 06:49:49'),
	(14, 'SESI 1 DASAR DASAR HTML DAN CSS (COMPANY PROFILE WEB)', 'Homepage', 'SESI 1 DASAR DASAR HTML DAN CSS (COMPANY PROFILE WEB)', 'iiXpy9au9rI', 14, 'Indonesia', 4, '2020-01-22 06:49:45'),
	(15, 'SESI 2 CSS, SELECTOR CSS DAN PENERAPANNYA DI HTML5 (WEB DEVELOPMENT) ', 'Homepage', 'SESI 2 CSS, SELECTOR CSS DAN PENERAPANNYA DI HTML5 (WEB DEVELOPMENT) ', 'IvjxrQ8c4-w', 15, 'Indonesia', 4, '2020-01-22 06:49:40'),
	(16, 'SESI 3 MEMBUAT TEMPLATE SEDERHANA DENGAN HTML5 DAN CSS3 ', 'Homepage', 'SESI 3 MEMBUAT TEMPLATE SEDERHANA DENGAN HTML5 DAN CSS3 ', 's3hP3OJ9xE4', 16, 'Indonesia', 4, '2020-01-22 06:49:34'),
	(17, 'SESI 6 MEMBUAT TEMPLATE DENGAN BOOTSTRAP 4 DAN JQUERY (COMPANY PROFILE WEB)', 'Homepage', 'SESI 6 MEMBUAT TEMPLATE DENGAN BOOTSTRAP 4 DAN JQUERY (COMPANY PROFILE WEB)', 'SpP_OdIlGHs', 17, 'Indonesia', 4, '2020-01-22 06:49:30'),
	(18, 'SESI 7 MEMBUAT TEMPLATE DENGAN BOOTSTRAP 4, JQUERY DAN FONT AWESOME (WEBSITE PROFIL PERUSAHAN)', 'Homepage', 'SESI 7 MEMBUAT TEMPLATE DENGAN BOOTSTRAP 4, JQUERY DAN FONT AWESOME (WEBSITE PROFIL PERUSAHAN)', 'YeoB2qlBwJo', 18, 'Indonesia', 4, '2020-01-22 06:49:26'),
	(19, 'SESI 8 PERENCANAAN DATABASE WEBSITE COMPANY PROFILE MYSQL', 'Homepage', 'SESI 8 PERENCANAAN DATABASE WEBSITE COMPANY PROFILE MYSQL', 'LLNPd9EZMxA', 19, 'Indonesia', 4, '2020-01-22 06:49:22'),
	(20, 'SESI 9 INSTALASI DAN KONFIGURASI CODEIGNITER DAN INTEGRASI TEMPLATE', 'Homepage', 'SESI 9 INSTALASI DAN KONFIGURASI CODEIGNITER DAN INTEGRASI TEMPLATE', 'aEZYJG56pAU', 20, 'Indonesia', 4, '2020-01-22 06:49:18'),
	(21, 'SESI 10 INTEGRASI TEMPLATE BOOTSTRAP 4 DENGAN CODEIGNITER ', 'Homepage', 'SESI 10 INTEGRASI TEMPLATE BOOTSTRAP 4 DENGAN CODEIGNITER ', '7tzS8cz2llg', 21, 'Indonesia', 4, '2020-01-22 06:49:13'),
	(22, 'SESI 11 INTEGRASI TEMPLATE ADMIN LTE DENGAN CODEIGNITER', 'Homepage', 'SESI 11 INTEGRASI TEMPLATE ADMIN LTE DENGAN CODEIGNITER', 'eklNEGqM8cw', 22, 'Indonesia', 4, '2020-01-22 06:49:08'),
	(23, 'SESI 12 CRUD TABEL USER DENGAN CODEIGNITER (WEBSITE PROFIL PERUSAHAAN)', 'Homepage', 'SESI 12 CRUD TABEL USER DENGAN CODEIGNITER (WEBSITE PROFIL PERUSAHAAN)', 'dzlU98D7JaA', 23, 'Indonesia', 4, '2020-01-22 06:49:03'),
	(24, 'SESI 13 LOGIN, LOGOUT, PROTEKSI HALAMAN, UPDATE PROFILE DAN MEMBUAT LIBRARY SENDIRI DENGAN CODEIGNIT', 'Homepage', 'SESI 13 LOGIN, LOGOUT, PROTEKSI HALAMAN, UPDATE PROFILE DAN MEMBUAT LIBRARY SENDIRI DENGAN CODEIGNIT', 'iE6MdliJtyY', 24, 'Indonesia', 4, '2020-01-22 06:48:58'),
	(25, 'SESI 14 CRUD KATEGORI BERITA', 'Homepage', 'SESI 14 CRUD KATEGORI BERITA', '2-HkYTSCTnI', 25, 'Indonesia', 4, '2020-01-22 06:48:26'),
	(26, 'SESI 15 CRUD TABEL BERITA DAN INSTALASI TINYMCE (WEBSITE PERUSAHAAN) ', 'Homepage', 'SESI 15 CRUD TABEL BERITA DAN INSTALASI TINYMCE (WEBSITE PERUSAHAAN) ', 'fAuGTEvmf1E', 26, 'Indonesia', 4, '2020-01-22 06:50:45'),
	(27, 'SESI 16 CRUD TABEL LAYANAN DENGAN CODEIGNITER (WEBSITE PERUSAHAAN)', 'Homepage', 'SESI 16 CRUD TABEL LAYANAN DENGAN CODEIGNITER (WEBSITE PERUSAHAAN)', 'AB9G5lg8k1w', 27, 'Indonesia', 4, '2020-01-22 06:50:51'),
	(28, 'SESI 17 CRUD TABEL GALERI DENGAN CODEIGNITER (WEBSITE PERUSAHAAN) ', 'Homepage', 'SESI 17 CRUD TABEL GALERI DENGAN CODEIGNITER (WEBSITE PERUSAHAAN) ', 'jZgdAR4OOsc', 28, 'Indonesia', 4, '2020-01-22 06:50:55'),
	(29, 'SESI 18 MEMBUAT KONFIGURASI WEBSITE DENGAN CODEIGNITER (WEBSITE PERUSAHAAN) ', 'Homepage', 'SESI 18 MEMBUAT KONFIGURASI WEBSITE DENGAN CODEIGNITER (WEBSITE PERUSAHAAN) ', '5NbLSXUVrQM', 29, 'Indonesia', 4, '2020-01-22 06:50:58'),
	(30, 'SESI 19 MENGELOLA HOMEPAGE, GAMBAR SLIDER, LAYANAN DAN BERITA DENGAN CODEIGNITER ', 'Homepage', 'SESI 19 MENGELOLA HOMEPAGE, GAMBAR SLIDER, LAYANAN DAN BERITA DENGAN CODEIGNITER ', 'sP9KVfvZJBM', 30, 'Indonesia', 4, '2020-01-22 06:51:02'),
	(31, 'SESI 20 HALAMAN DETAIL BERITA DAN BELAJAR PAGINATION DI HALAMAN BERITA DENGAN CODEIGNITER', 'Homepage', 'SESI 20 HALAMAN DETAIL BERITA DAN BELAJAR PAGINATION DI HALAMAN BERITA DENGAN CODEIGNITER', 'NN_A7N6l9zM', 31, 'Indonesia', 4, '2020-01-22 06:51:07'),
	(32, 'SESI 21 HALAMAN LAYANAN DAN DETAILNYA DENGAN CODEIGNITER ', 'Homepage', 'SESI 21 HALAMAN LAYANAN DAN DETAILNYA DENGAN CODEIGNITER ', 'JdMErkxzdB0', 32, 'Indonesia', 4, '2020-01-22 06:51:10'),
	(33, 'SESI 22 HALAMAN KONTAK DAN DASBOR ADMINISTRATOR DENGAN CODEIGNITER', 'Homepage', 'SESI 22 HALAMAN KONTAK DAN DASBOR ADMINISTRATOR DENGAN CODEIGNITER', 'it97Ls9n-BA', 33, 'Indonesia', 4, '2020-01-22 06:51:14'),
	(34, 'SESI 23 MEMBELI DOMAIN DAN HOSTING, LALU UPLOAD WEBSITE KE SERVER DAN KONFIGURASINYA ', 'Homepage', 'SESI 23 MEMBELI DOMAIN DAN HOSTING, LALU UPLOAD WEBSITE KE SERVER DAN KONFIGURASINYA ', 'fTbkiEmCEXk', 34, 'Indonesia', 4, '2020-01-22 06:51:18'),
	(35, 'BAGIAN 1 DASAR DASAR CSS', 'Homepage', 'BAGIAN 1 DASAR DASAR CSS', 'kOEbjxl42hQ', 35, 'Indonesia', 4, '2020-01-22 06:51:21'),
	(36, 'BAGIAN 2 PERENCANAAN DATABASE, PHPMYADMIN, EXPORT DAN IMPORT', 'Homepage', 'BAGIAN 2 PERENCANAAN DATABASE, PHPMYADMIN, EXPORT DAN IMPORT', '3Tn79YuiWX8', 36, 'Indonesia', 4, '2020-01-22 06:51:26'),
	(37, 'BAGIAN 3 - CODEIGNITER DAN CRUD DASAR ', 'Homepage', 'BAGIAN 3 - CODEIGNITER DAN CRUD DASAR ', '-X0Jwf3V8SY', 37, 'Indonesia', 4, '2020-01-22 06:51:29'),
	(38, 'BAGIAN 4 - MODUL USER/ADMINISTRATOR ', 'Homepage', 'BAGIAN 4 - MODUL USER/ADMINISTRATOR ', 'K9RoEV1U3YQ', 38, 'Indonesia', 4, '2020-01-22 06:51:33'),
	(39, 'BAGIAN 5 - AUTHENTICATION LOGIN, LOGOUT DAN PROTEKSI HALAMAN ', 'Homepage', 'BAGIAN 5 - AUTHENTICATION LOGIN, LOGOUT DAN PROTEKSI HALAMAN ', 'pweuSiKKCcs', 39, 'Indonesia', 4, '2020-01-22 06:51:37'),
	(40, 'BAGIAN 6 - MODUL BERITA, KATEGORI BERITA DAN TINYMCE ', 'Homepage', 'BAGIAN 6 - MODUL BERITA, KATEGORI BERITA DAN TINYMCE ', 'Lmxkm0C8ZlY', 40, 'Indonesia', 4, '2020-01-22 06:51:41'),
	(41, 'BAGIAN 7 TEMPLATE DAN LAYOUT FRONT END ', 'Homepage', 'BAGIAN 7 TEMPLATE DAN LAYOUT FRONT END ', 'Lb8NTMZrFaE', 41, 'Indonesia', 4, '2020-01-22 06:51:44'),
	(42, '  BAGIAN 8 MENAMPILKAN LISTING DAN DETAIL BERITA (TUTORIAL CODEIGNITER)', 'Homepage', '\r\n\r\nBAGIAN 8 MENAMPILKAN LISTING DAN DETAIL BERITA (TUTORIAL CODEIGNITER)', 'uNdvaTZiOHo', 42, 'Indonesia', 4, '2020-01-22 06:51:48'),
	(43, 'BAGIAN 9 MODUL DOKUMEN ', 'Homepage', 'BAGIAN 9 MODUL DOKUMEN ', 'IKAQLcQEJx0', 43, 'Indonesia', 4, '2020-01-22 06:51:51'),
	(44, 'BAGIAN 10 MODUL GALERI DAN VIDEO SERTA MODUL KONFIGURASI', 'Homepage', 'BAGIAN 10 MODUL GALERI DAN VIDEO SERTA MODUL KONFIGURASI', 'h2YDawzGTTQ', 44, 'Indonesia', 4, '2020-01-22 06:51:55'),
	(45, 'BAGIAN 11 HOMEPAGE SLIDER, GALERI, VIDEO DAN KONTAK CODEIGNITER TUTORIAL', 'Homepage', 'BAGIAN 11 HOMEPAGE SLIDER, GALERI, VIDEO DAN KONTAK CODEIGNITER TUTORIAL', 'dTA3-GxQyks', 45, 'Indonesia', 4, '2020-01-22 06:51:58'),
	(46, 'TUTORIAL JAVA WEB MEDIA - INSTALASI WEB SERVER DAN CODE EDITOR SUBLIME TEXT 3', 'Homepage', 'TUTORIAL JAVA WEB MEDIA - INSTALASI WEB SERVER DAN CODE EDITOR SUBLIME TEXT 3', 'pOZE0bb7iLc', 46, 'Indonesia', 4, '2020-01-22 06:52:02'),
	(47, 'KURSUS CODEIGNITER JAVA WEB MEDIA 1 - PERENCANAAN DATABASE SISTEM INFORMASI PERPUSTAKAAN ', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 1 - PERENCANAAN DATABASE SISTEM INFORMASI PERPUSTAKAAN ', 'Zhb_7mo8iAU', 47, 'Indonesia', 4, '2020-01-22 06:52:05'),
	(48, 'KURSUS CODEIGNITER JAVA WEB MEDIA 2 - INSTALLASI CODEIGNITER DAN KONFIGURASINYA (SI PERPUSTAKAAN) ', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 2 - INSTALLASI CODEIGNITER DAN KONFIGURASINYA (SI PERPUSTAKAAN) ', 'fpRh51vnuII', 48, 'Indonesia', 4, '2020-01-22 06:52:08'),
	(49, 'KURSUS CODEIGNITER JAVA WEB MEDIA 3 - TEMPLATING DAN LAYOUTING BACK END (SI PERPUSTAKAAN)', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 3 - TEMPLATING DAN LAYOUTING BACK END (SI PERPUSTAKAAN)', 'r564woEZ3VA', 49, 'Indonesia', 4, '2020-01-22 06:52:12'),
	(50, 'KURSUS CODEIGNITER 4 - CRUD MODUL USER (SI PERPUSTAKAAN)', 'Homepage', 'KURSUS CODEIGNITER 4 - CRUD MODUL USER (SI PERPUSTAKAAN)', '2yWPXLA7DZA', 50, 'Indonesia', 4, '2020-01-22 06:52:17'),
	(51, 'KURSUS CODEIGNITER JAVA WEB MEDIA 5 - LOGIN, LOGOUT DAN PROTEKSI HALAMAN (SI PERPUSTAKAAN)', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 5 - LOGIN, LOGOUT DAN PROTEKSI HALAMAN (SI PERPUSTAKAAN)', 'fAYnWt4EuYU', 51, 'Indonesia', 4, '2020-01-22 06:52:31'),
	(52, 'KURSUS CODEIGNITER JAVA WEB MEDIA 6 - CRUD MODUL ANGGOTA (SI PERPUSTAKAAN) ', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 6 - CRUD MODUL ANGGOTA (SI PERPUSTAKAAN) ', 'er8PYRvtJmE', 52, 'Indonesia', 4, '2020-01-22 06:52:35'),
	(53, 'KURSUS CODEIGNITER JAVA WEB MEDIA 7 - CRUD TABEL TABEL REFERENSI, PERBAIKAN DELETE USER DAN ANGGOTA ', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 7 - CRUD TABEL TABEL REFERENSI, PERBAIKAN DELETE USER DAN ANGGOTA ', 'y-p_A9nMcfI', 53, 'Indonesia', 4, '2020-01-22 06:52:39'),
	(54, 'KURSUS CODEIGNITER JAVA WEB MEDIA 8 - MEMBUAT HALAMAN BERANDA HOMEPAGE (SI PERPUSTAKAAN) ', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 8 - MEMBUAT HALAMAN BERANDA HOMEPAGE (SI PERPUSTAKAAN) ', 'avJElC1KbAQ', 54, 'Indonesia', 4, '2020-01-22 06:52:42'),
	(55, 'KURSUS CODEIGNITER JAVA WEB MEDIA 9 - MODUL BUKU TAMBAH DAN LISTING (SI PERPUSTAKAAN) ', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 9 - MODUL BUKU TAMBAH DAN LISTING (SI PERPUSTAKAAN) ', 'KMt3po80qls', 55, 'Indonesia', 4, '2020-01-22 06:52:46'),
	(56, 'KURSUS CODEIGNITER JAVA WEB MEDIA 10 - MODUL BUKU EDIT DAN DETAIL BUKU (SI PERPUSTAKAAN)', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 10 - MODUL BUKU EDIT DAN DETAIL BUKU (SI PERPUSTAKAAN)', 'qpoIlWpmFHk', 56, 'Indonesia', 4, '2020-01-22 06:52:49'),
	(57, 'KURSUS CODEIGNITER JAVA WEB MEDIA 11 - MODUL FILE BUKU ATAU EBOOK (SI PERPUTAKAAN) ', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 11 - MODUL FILE BUKU ATAU EBOOK (SI PERPUTAKAAN) ', 'GVfChqD1Ev0', 57, 'Indonesia', 4, '2020-01-22 06:52:53'),
	(58, 'KURSUS CODEIGNITER JAVA WEB MEDIA 12 - CRUD MODUL BERITA ( (SI PERPUTAKAAN)', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 12 - CRUD MODUL BERITA ( (SI PERPUTAKAAN)', 'Uh5tC_LnvvI', 58, 'Indonesia', 4, '2020-01-22 06:52:57'),
	(59, 'KURSUS CODEIGNITER JAVA WEB MEDIA 13 - MENGELOLA HALAMAN BERANDA (SI PERPUSTAKAAN)', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 13 - MENGELOLA HALAMAN BERANDA (SI PERPUSTAKAAN)', 'UmsNC7RMWeg', 59, 'Indonesia', 4, '2020-01-22 06:53:01'),
	(60, 'KURSUS CODEIGNITER JAVA WEB MEDIA 14 - MENGELOLA HALAMAN BERANDA DAN KATALOG BUKU (SI PERPUSTAKAAN)', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 14 - MENGELOLA HALAMAN BERANDA DAN KATALOG BUKU (SI PERPUSTAKAAN)', 'MB3YD8IorjE', 60, 'Indonesia', 4, '2020-01-22 06:53:04'),
	(61, 'KURSUS CODEIGNITER JAVA WEB MEDIA 15 - MEMBACA BUKU PDF, HALAMAN BUKU BARU, USULAN DAN KONTAK', 'Homepage', 'KURSUS CODEIGNITER JAVA WEB MEDIA 15 - MEMBACA BUKU PDF, HALAMAN BUKU BARU, USULAN DAN KONTAK', '4FfkwHRuQ8M', 61, 'Indonesia', 4, '2020-01-22 06:53:08'),
	(62, 'TUTORIAL CODEIGNITER JAVA WEB MEDIA 16 - MEMBUAT KONFIGURASI WEBSITE YANG MUDAH DI UPDATE', 'Homepage', 'TUTORIAL CODEIGNITER JAVA WEB MEDIA 16 - MEMBUAT KONFIGURASI WEBSITE YANG MUDAH DI UPDATE', 'FBGdNKLeArM', 62, 'Indonesia', 4, '2020-01-22 06:53:12'),
	(63, 'SESI 17 PEMINJAMAN BUKU SI PERPUSTAKAAN DENGAN CODEGNITER', 'Homepage', 'SESI 17 PEMINJAMAN BUKU SI PERPUSTAKAAN DENGAN CODEGNITER', '1BRG8HzghuE', 63, 'Indonesia', 4, '2020-01-22 06:53:15'),
	(64, 'SESI 18 CRUD LINK DAN MENAMPILKAN DI HOMEPAGE (SI PERPUSTAKAAN) ', 'Homepage', 'SESI 18 CRUD LINK DAN MENAMPILKAN DI HOMEPAGE (SI PERPUSTAKAAN) ', 'aTRXIePwiOU', 64, 'Indonesia', 4, '2020-01-22 06:53:19');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
