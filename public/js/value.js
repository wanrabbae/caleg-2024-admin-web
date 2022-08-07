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

function getVariable(Var){
    fetch(`/survey/HasilSurvey/${Var}`).then(response => response.json()).then(response => {
        document.getElementById("update_variabel").action = `/survey/HasilSurvey/${Var}`
        document.getElementById("edit_variabel").value = response.nama_variabel
    })
}
