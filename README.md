# Pengembangan Gateway Berbasis Embedded Device untuk Interoperabilitas Jaringan Sensor Nirkabel dan Protokol Internet

## Aplikasi
* Arduino for Mac -> coding arduino
* CoolTerm -> untuk melihat port serial + konfigurasi zig bee
* Driver FTDI for Mac
* LAMP
* Python + PySerial
* IQRF IDE v 2.08 for TR-5B

## Source Code di GitHub
* TODO: bikin source di github

---
## How-To
### Sensor XBee
* Install driver FTDI, arduino, coolterm
* konfigurasi xbee agar bisa saling berkomunikasi
	* Format:
	
				ATID <id jaringan>
				ATMY <alamat dari zigbee>
				ATDH <destination high>
				ATDL <destination low>
				ATWR <tulis ke non volatile memory>
	* Contoh
	
				ATID 1234
				ATMY 1
				ATDH 0
				ATDL 2
				ATWR

* masing2 zigbee harus memiliki alamat yang berbeda.
* kemudian buat program di arduino untuk menyalakan dan mematikan relay sesuai input yang masuk ('y', 'n').
* Untuk konfigurasi pin, bisa dilihat di skematik elecfreaks relay shield dan arduino schematic.
* Upload source ke arduino.

### TP-Link MR3020 (OpenWRT)
* Flash MR3020 dengan OpenWRT -> Tutorial lihat di website openwrt
	* Pastikan sudah terinstall dengan kernel 3.10
	* Karena kmod-usb-serial membutuhkan versi kernel 3.10
* Expand disk ke external memory menggunakan overlay fs, tuorial bisa dilihat di: 
	* http://wolfgang.reutz.at/2012/04/12/openwrt-on-tp-link-mr3020-as-infopoint-with-local-webserver/
* Rootfs pada External Storage untuk versi terbaru
	* http://wiki.openwrt.org/doc/howto/extroot
* Pada pengerjaan, openwrt sudah terinstall dengan versi aptitude adjustment(kernel 3.3) sehingga harus diupgrade dengan petunjuk di
	* http://wiki.openwrt.org/doc/howto/generic.sysupgrade
* Versi paling baru bermasalah pada overlayfs, mencoba kembali ke versi sebelumnya (attitude adjustment).
* Kalau sudah terlanjur ke Barrier Breaker, bisa downgrade ke Attitude dengan cara install default ROM dulu baru flash ulang seperti biasa.
* Saat install Aptitude versi terbaru (12.09) akan terjadi masalah saat mount usb drive, solusinya hapus mounting tools yang dulu dan ganti yg baru, kemudian install driver untuk ext4:
			
			# rm /bin/mount /bin/umount
			# opkg install mount-utils kmod-ext4
* Package yang diperlukan untuk membaca serial:
			
			# opkg install kmod-usb-serial kmod-usb-serial-ftdi microcom

* Install package 'at' untuk menjalankan perintah pada suatu waktu:
		
			# opkg update && opkg install at
			
* Agar time-zone sesuai dengan Indonesia, maka ganti timezone dengan cara:
	* Buka file **/etc/config/system**
	* Cari bagian timezone, dan ganti dari **UTC** ke **WIT-7**
* Agar 'at' command bisa berjalan, maka buat file **/var/spool/cron/atjobs/.SEQ** dan ganti ownernya ke **daemon.daemon**, kemudian jalankan **atd**.


### PySerial (For reading serial port)
* Pastikan python sudah terinstall terlebih dahulu

			# opkg install python
			
* Install PySerial pada openwrt sangat mudah, jalankan perintah:

			# opkg install pyserial

### Web Server (Apache+PHP+MySQL)
* Pada Attitude yg terbaru, web server uHTTPd sudah terinstall, kita hanya memerlukan PHP:

			# opkg install php5 php5-cgi
			
* Kemudian pastikan konfigurasi pada /etc/config/uhttpd sudah mengarah ke PHP. Uncomment pada baris:

			list interpreter ".php=/usr/bin/php-cgi"
* Secara default, home directory ada pada directory:

			/www/
			
* Tutorial cara menginstall MySQL pada openwrt device bisa diakses pada:

			https://wiki.xkyle.com/Full_LAMP_Stack_on_OpenWrt
			
* Karena aplikasi nanti menggunakan htaccess, maka ganti uhttpd yang sudah terinstall menjadi apache.

### Web Application / Interface
* Template admin page download di

			https://github.com/VinceG/Bootstrap-Admin-Theme

### IQRF
* Aplikasi yang digunakan harus versi 2.08 karena hardware yg dimiliki adalah TR-5B.
* Komunikasi ke router dengan serial/UART.
* Komunikasi antar node, harus didahului oleh bonding.
* Source code bisa mengedit dari iHome yang sudah cukup lengkap.

---

### Issue
* Komunikasi dengan IQRF ke usbserial menggunakan kabel usb to serial prolific, bukan menggunakan kabel microUSB.
* Jangan pakai development board, tapi pakai evaluation board. Karena development board bermasalah saat komunikasi UART.