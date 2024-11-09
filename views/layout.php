<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div>
    <header><?php include "header.php"; ?></header>
    <main>
        <article><?php include $view ?></article>
    </main>
    <footer><?php include "footer.php"; ?></footer>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script>
   ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: './config/upload_config.php'
            },
        }).then(e => {
            window.editor = e
        }
    )
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>
