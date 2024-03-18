<?php
$todo = [];
if (file_exists('todo.txt')) {
    $file = file_get_contents('todo.txt');
    $todos = unserialize($file);
}

if (isset($_POST['todo'])) {
    $data =  $_POST['todo'];
    $todos[] = [
        'todo'    => $data,
        'status' => 0
    ];
    file_put_contents('todo.txt', serialize($todos));
    header('location:index.php');
}

if (isset($_GET['status'])) {
    $todos[$_GET['key']]['status'] = $_GET['status'];
    file_put_contents('todo.txt', serialize($todos));
    header('location:index.php');
}

if (isset($_GET['hapus'])) {
    unset($todos[$_GET['key']]);
    file_put_contents('todo.txt', serialize($todos));
    header('location:index.php');
}

print_r($todos);
?>


<h1>Todo App</h1>
<form method="post">
    <label>Kegiatan Hari ini</label><br>
    <input type="text" name="todo">
    <button type="submit">Simpan</button>
</form>
<ul>
    <?php foreach ($todos as $key => $value) : ?>
        <li>
            <input type="checkbox" name="todo" onclick="window.location.href='index.php?status=<?php echo ($value['status'] == 1) ? '0' : '1'; ?>&key=<?php echo $key; ?>'" ; <?php if ($value['status'] == 1) echo 'checked' ?>>
            <label>
                <?php
                if ($value['status'] == 1) {
                    echo '<del>' . $value['todo'] . '</del>';
                } else {
                    echo $value['todo'];
                }
                ?>
            </label>
            <a href="index.php?hapus=1&key=<?php echo $key; ?>" onclick="return confirm('Apakah Anda Yakin akan menghapus data ini?')">hapus</a>
        </li>
    <?php endforeach; ?>
</ul>