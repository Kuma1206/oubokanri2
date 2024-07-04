<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rirelisho</title>
    <link rel="stylesheet" type="text/css" href="css/rirekisho_data.css" />
</head>
<body>

<div id="area1"> 
    <p>履歴書File</p>
    </tbody>
    <div id="text-area">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" id="rirekisho" name="rirekisho" accept=".pdf,.doc,.docx,.txt,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
            <br><br>
            <input type="submit" class="button" value="アップロード">
        </form>
        <button id="modoru" class="button">Mainに戻る</button>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.6/xlsx.full.min.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    $('#excelFile').change(function(e) {
        var files = e.target.files;
        var f = files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = new Uint8Array(e.target.result);
            var workbook = XLSX.read(data, {type: 'array'});

            var firstSheet = workbook.SheetNames[0];
            var worksheet = workbook.Sheets[firstSheet];

            var html = XLSX.utils.sheet_to_html(worksheet, { editable: true });

            $('#excelData').html(html).find('table').css({
                'border-collapse': 'collapse',
                'width': '100%'
            }).find('th, td').css({
                'border': '1px solid #000',
                'padding': '8px',
                'text-align': 'left'
            });
        };
        reader.readAsArrayBuffer(f);
    });

    $("#modoru").click(function() {
        window.location.href = "mypage.php";
    });

</script>

</body>
</html>