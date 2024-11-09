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
    let editor;

    function updateUploadUrl() {
        const title = document.getElementById('title').value.trim().replace(/\s+/g, '_');
        if (editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return {
                    upload: () => {
                        return loader.file
                            .then((file) => new Promise((resolve, reject) => {
                                const data = new FormData();
                                data.append('upload', file);

                                fetch(`./config/upload_config.php?title=${title}`, {
                                    method: 'POST',
                                    body: data,
                                })
                                    .then(response => response.json())
                                    .then(result => {
                                        if (result.uploaded) {
                                            resolve({default: result.url});
                                        } else {
                                            reject(result.error ? result.error.message : 'Upload failed');
                                        }
                                    })
                                    .catch(reject);
                            }));
                    },
                };
            };
        }
    }

    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(newEditor => {
            editor = newEditor;
            updateUploadUrl();
        })
        .catch(error => console.error(error));

    document.getElementById('title').addEventListener('input', updateUploadUrl);
</script>
</body>
</html>
