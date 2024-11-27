// Função de pesquisa
document.getElementById('searchInput').addEventListener('keyup', function () {
    let input = document.getElementById('searchInput').value.toLowerCase();
    let ul = document.getElementById('fileList');
    let li = ul.getElementsByTagName('li');

    for (let i = 0; i < li.length; i++) {
        let a = li[i].getElementsByTagName('a')[0];
        let txtValue = a.textContent || a.innerText;

        if (txtValue.toLowerCase().indexOf(input) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
});

// Função para exibir o PDF no iframe
function showPDF(pdfPath) {
    let pdfViewer = document.getElementById('pdfViewer');
    pdfViewer.src = pdfPath;
    pdfViewer.style.display = 'block'; // Exibe o iframe
}
