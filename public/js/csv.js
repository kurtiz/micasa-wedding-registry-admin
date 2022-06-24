//initiating FILEREADER Object
const reader = new FileReader()

function read(input) {
    //Find whether file ends with .csv or .txt
    if (document.getElementById("xcsv").value.toLowerCase().lastIndexOf(".txt") === -1 &&
        document.getElementById("xcsv").value.toLowerCase().lastIndexOf(".csv") === -1 ) {
        alert("Please upload a file with .csv or .txt extension.");
        $('#xcsv').val('');
        $('#xrecipient-name').val('');
        return false;
    }
    const csv = input.prop("files")
    reader.readAsText(csv[0]);

}
//After reading file successfully
reader.onload = function (e) {
    var heu = e.target.result.split(/\r?\n|\r/);
    //Add new line at the end of every array(Row)
    $('#xrecipient-name').text(heu.join("\n"));
  
}