<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $titlePage; ?></title>
    <link
            href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
            rel="stylesheet"
    />
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
</head>
<body>
<div>
    <header><?php include "header.php"; ?></header>
    <main>
        <article><?php include $view ?></article>
    </main>
    <footer><?php include "footer.php"; ?></footer>
</div>

<!-- Place CKEditor script here, before the closing </body> tag -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '/upload.php'
            },
            toolbar: [
                'heading', '|', 'bold', 'italic', 'underline', 'fontColor', 'fontBackgroundColor', 'fontSize', '|',
                'link', 'bulletedList', 'numberedList', '|',
                'insertTable', 'blockQuote', '|',
                'imageUpload', 'mediaEmbed', '|',
                'undo', 'redo'
            ],
            image: {
                toolbar: [
                    'imageStyle:full', 'imageStyle:side', '|',
                    'imageTextAlternative'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells'
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>
