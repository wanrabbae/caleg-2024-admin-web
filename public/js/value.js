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
        document.getElementById("update_gambar").value = response.gambar
        document.getElementById("update_aktif").value = response.aktif
    })
}

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


