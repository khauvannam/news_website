<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="flex flex-col md:flex-row">
    <!-- Sidebar -->
    <nav class="bg-gray-800 w-full md:w-64 md:min-h-screen p-4 text-white">
        <div class="flex items-center mb-8">
            <span class="text-2xl font-bold">Admin Panel</span>
        </div>
        <ul>
            <li class="mb-2">
                <a href="<?= "admin" ?>" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                    <i class="fas fa-tachometer-alt mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="mb-2">
                <a href="<?= "category" ?>" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-layer-group"></i>
                    Categories
                </a>
            </li>
            <li class="mb-2">
                <a href="<?= "article" ?>" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                    <i class="fa-regular fa-newspaper"></i>
                    Articles
                </a>
            </li>
            <li class="mb-2">
                <a href="<?= "logout" ?>" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Content Area -->
    <div class="flex-1 min-h-screen bg-gray-100 p-6">
        <header class="bg-white shadow p-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold"><?php echo $title; ?></h1>
            <div class="flex items-center">
                <!-- Place for user info or additional options -->
            </div>
        </header>

        <main class="mt-6">
            <article>
                <?php include $view; ?>
            </article>
        </main>
    </div>
</div>


<!-- CKEditor Script -->
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
