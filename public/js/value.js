//UPDATE INFO POLITIK
function getData(data) {
    fetch(`/infoPolitik/daftarIsu/${data}`).then(response => response.json()).then(response =>{
        document.getElementById("edit_form").action = `/infoPolitik/daftarIsu/${data}`
        document.getElementById("edit_kecamatan").value = response.nama_kecamatan
        document.getElementById("edit_wilayah").value = response.wilayah
        document.getElementById("edit_kabupaten").value = response.id_kabupaten
    });
}

function getValue(value){
    fetch(`/infoPolitik/rekapitulasi/${value}`).then(resp => resp.json()).then(resp =>{
        document.getElementById("update_rekapitulasi").action = `/infoPolitik/rekapitulasi/${value}`
        document.getElementById("update_desa").value = resp.nama_desa
        document.getElementById("update_type").value = resp.type
        document.getElementById("update_dpt").value = resp.dpt
        document.getElementById("update_tps").value = resp.tps
        document.getElementById("update_suara").value = resp.suara
        document.getElementById("update_kecamatan").value = resp.id_kecamatan
    });
}

function getBerita(data) {
    fetch(`/infoPolitik/berita/${data}`).then(response => response.json()).then(response => {
        document.getElementById("update_berita").action = `/infoPolitik/berita/${data}`
        document.getElementById("update_judul").value = response.judul
        document.getElementById("update_isi_berita").value = response.isi_berita
        document.getElementById("update_tgl_publish").value = response.tgl_publish
        document.getElementById("update_id_caleg").value = response.id_caleg
        document.getElementById("update_aktif").value = response.aktif
        document.getElementById("update_gambar").value = response.gambar
    })
}
//UPDATE DATA SURVEY
function getVariable(Var){
    fetch(`/survey/HasilSurvey/${Var}`).then(response => response.json()).then(response => {
        document.getElementById("update_variabel").action = `/survey/HasilSurvey/${Var}`
        document.getElementById("edit_variabel").value = response.nama_variabel
    });
}

function DataSurvey(survey) {
    fetch(`/survey/inputSurvey/${survey}`).then(resp => resp.json()).then(resp =>{
        document.getElementById("edit_form").action = `/survey/inputSurvey/${survey}`
        document.getElementById("edit_survey").value = resp.nama_survey
        document.getElementById("edit_mulai").value = resp.mulai_tanggal
        document.getElementById("edit_sampai").value = resp.sampai_tanggal
        document.getElementById("edit_caleg").value = resp.id_caleg
        document.getElementById("edit_variabel").value = resp.id_variabel
    });
}

//UPDATE REKAP DATA
function getData(params) {
    fetch(`/dpt/${params}`).then(response => response.json()).then(response => {
        document.getElementById("edit_form").action = `/dpt/${params}`
        document.getElementById("edit_nik").value = response.nik
        document.getElementById("edit_nama").value = response.nama
        document.getElementById("edit_tempat_lahir").value = response.tempat_lahir
        document.getElementById("edit_tgl_lahir").value = response.tgl_lahir
        document.getElementById("edit_tgl_data").value = response.tgl_data
        document.getElementById("edit_jk").value = response.jk
        document.getElementById("edit_tps").value = response.tps
        document.getElementById("edit_id_desa").value = response.id_desa
        document.getElementById("edit_relawan").value = response.relawan
        document.getElementById("edit_saksi").value = response.saksi
        document.getElementById("edit_id_users").value = response.id_users
    })
}
