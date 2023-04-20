<!DOCTYPE html>
<html lang="es" class="">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>Encriptar contrase&ntilde;as</title>
</head>

<body class="bg-gray-200 h-full">
    <div class="w-full max-w-7xl mx-auto my-6 p-4">
        <?php if (isset($_GET['success'])) : ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                <strong class="font-bold">Correcto!</strong>
                <?php if (intval($_GET['success']) === 1) : ?>
                    <span class="block sm:inline">Usuario creado.</span>
                <?php elseif (intval($_GET['success']) === 2) : ?>
                    <span class="block sm:inline">Usuario actualizado.</span>
                <?php elseif (intval($_GET['success']) === 3) : ?>
                    <span class="block sm:inline">Login correcto.</span>
                <?php endif; ?>
            </div>
        <?php elseif (isset($_GET['error'])) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert">
                <strong class="font-bold">Error!</strong>
                <?php if (intval($_GET['error']) === 1) : ?>
                    <span class="block sm:inline">Login incorrecto.</span>
                <?php elseif (intval($_GET['error']) === 2) : ?>
                    <span class="block sm:inline">El usuario no existe.</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="my-4">
            <h2 class="text-xl text-right font-semibold mb-2">Registro/Actualizaci&oacute;n</h2>
            <form method="POST" action="./hash.php">
                <div class="grid grid-cols-1 gap-4">
                    <input type="email" name="email" value="danidoble@example.com" class="w-full rounded py-2 px-4">
                    <input type="password" name="password" placeholder="**********" minlength="4" maxlength="60" class="w-full rounded py-2 px-4">
                    <button type="submit" class="px-3 py-4 rounded bg-gray-800 hover:bg-gray-950 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-white">Enviar</button>
                </div>
            </form>
        </div>

        <div class="my-4">
            <h2 class="text-xl text-right font-semibold mb-2">Inicio de sesi&oacute;n</h2>
            <form method="POST" action="./login.php">
                <div class="grid grid-cols-1 gap-4">
                    <input type="email" name="email" value="danidoble@example.com" class="w-full rounded py-2 px-4">
                    <input type="password" name="password" placeholder="**********" minlength="4" maxlength="60" class="w-full rounded py-2 px-4">
                    <button type="submit" class="px-3 py-4 rounded bg-gray-800 hover:bg-gray-950 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-white">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>