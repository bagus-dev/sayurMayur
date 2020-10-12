window.addEventListener("load",function(){
	tanggalNode = document.getElementById("tanggal");
	
	function cekTanggal(){
		var myDate = new Date();
		
		var tahun = myDate.getFullYear();
		var bulan = myDate.getMonth();
		var tanggal = myDate.getDate();
		var hari = myDate.getDay();
		
		var namaHari;
		var namaBulan;
		
		switch(hari){
			case 0: var namaHari = "Minggu"; break;
			case 1: var namaHari = "Senin"; break;
			case 2: var namaHari = "Selasa"; break;
			case 3: var namaHari = "Rabu"; break;
			case 4: var namaHari = "Kamis"; break;
			case 5: var namaHari = "Jumat"; break;
			case 6: var namaHari = "Sabtu"; break;
		}
		switch(bulan){
			case 0: var namaBulan = "Januari"; break;
			case 1: var namaBulan = "Februari"; break;
			case 2: var namaBulan = "Maret"; break;
			case 3: var namaBulan = "April"; break;
			case 4: var namaBulan = "Mei"; break;
			case 5: var namaBulan = "Juni"; break;
			case 6: var namaBulan = "Juli"; break;
			case 7: var namaBulan = "Agustus"; break;
			case 8: var namaBulan = "September"; break;
			case 9: var namaBulan = "Oktober"; break;
			case 10: var namaBulan = "November"; break;
			case 11: var namaBulan = "Desember"; break;
		}
		
		tanggalNode.innerHTML = namaHari+", "+tanggal+" "+namaBulan+" "+tahun;
	}
	
	cekTanggal();
});