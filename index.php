<?php
$bangun = $_POST['bangun'] ?? '';
$val1 = $_POST['val1'] ?? '';
$val2 = $_POST['val2'] ?? '';
$hasil = '';
$langkah = '';

if (isset($_POST['hitung']) && !empty($bangun)) {
    $v1 = floatval($val1);
    $v2 = floatval($val2);

    switch ($bangun) {
        case 'segitiga':
            $luas = 0.5 * $v1 * $v2;
            $langkah = "0.5 × $v1 × $v2";
            $hasil = $luas;
            break;

        case 'layang':
            $luas = 0.5 * $v1 * $v2;
            $langkah = "0.5 × $v1 × $v2";
            $hasil = $luas;
            break;

        case 'jajargenjang':
            $luas = $v1 * $v2;
            $langkah = "$v1 × $v2";
            $hasil = $luas;
            break;

        case 'lingkaran':
            $r = ($v1 > 0) ? $v1 : $v2;
            $isKelipatan7 = (($v1 > 0 && fmod($v1, 7) == 0) || ($v2 > 0 && fmod($v2, 7) == 0));

            if ($isKelipatan7) {
                $pi = 22 / 7;
                $luas = $pi * $r * $r;
                $langkah = "22/7 × " . $r . "²";
            } else {
                $pi = 3.14;
                $luas = $pi * pow($r, 2);
                $langkah = "3.14 × " . $r . "²";
            }
            $hasil = $luas;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Luas Bangun Datar</title>
    <style>
        body {
            background: url('Images/meja kerja.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding-left: 12%;
        }

        .calculator {
            width: 360px;
            background: linear-gradient(170deg, #424242 0%, #2a2a2a 40%, #1f1f1f 100%);
            border-radius: 28px;
            padding: 24px;
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.8),
                0 10px 20px rgba(0, 0, 0, 0.4),
                inset 0 4px 6px rgba(255, 255, 255, 0.25),
                inset 0 -4px 6px rgba(0, 0, 0, 0.6);
            border-top: 2px solid #555;
            border-bottom: 2px solid #111;
            position: relative;
        }

        .title {
            color: #ffffff;
            text-align: center;
            margin-top: 0;
            margin-bottom: 18px;
            font-size: 18px;
            letter-spacing: 0.5px;
            text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .screen {
            background-color: #b5bead;
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 18px;
            text-align: right;
            min-height: 60px;
            box-sizing: border-box;
            box-shadow: 
                inset 3px 3px 8px rgba(0, 0, 0, 0.5),
                inset -2px -2px 5px rgba(255, 255, 255, 0.6);
            border: 2px solid #7d8675;
        }

        .screen .process {
            font-size: 13px;
            color: #3f4738;
            min-height: 16px;
            font-weight: bold;
        }

        .screen .result {
            font-size: 28px;
            font-weight: bold;
            color: #111;
            font-family: 'Courier New', Courier, monospace;
        }

        .inputs-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 15px;
        }

        .inputs-group input {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: none;
            box-sizing: border-box;
            font-size: 14px;
            text-align: center;
            background: #e6e6e6;
            box-shadow: inset 2px 2px 5px rgba(0,0,0,0.2);
            outline: none;
        }

        .inputs-group input[type=number]::-webkit-outer-spin-button,
        .inputs-group input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .inputs-group input[type=number] {
            -moz-appearance: textfield;
        }

        .inputs-group input:focus {
            background: #ffffff;
            box-shadow: 0 0 0 2px #f7941d;
        }

        .keypad {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .btn {
            padding: 14px 0;
            font-size: 15px;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.1s ease;
            color: #222;
            text-align: center;
            box-shadow: 
                0px 5px 0px #b0b0b0, 
                0px 7px 10px rgba(0, 0, 0, 0.3);
            background: linear-gradient(to bottom, #ffffff, #e0e0e0);
        }

        .btn:active {
            transform: translateY(3px);
            box-shadow: 
                0px 2px 0px #b0b0b0, 
                0px 3px 5px rgba(0, 0, 0, 0.3);
        }

        .btn-num {
            background: linear-gradient(to bottom, #ffffff, #e6e6e6);
        }

        .btn-op {
            background: linear-gradient(to bottom, #dedede, #bfbfbf);
            font-size: 11px;
            box-shadow: 0px 5px 0px #9e9e9e, 0px 7px 10px rgba(0,0,0,0.3);
        }

        .btn-equal {
            grid-column: span 3;
            background: linear-gradient(to bottom, #ffaa3b, #f7941d);
            color: white;
            font-size: 20px;
            box-shadow: 0px 5px 0px #c46f08, 0px 7px 10px rgba(0,0,0,0.3);
            text-shadow: 0px 1px 2px rgba(0,0,0,0.3);
        }

        .btn-equal:active {
            box-shadow: 0px 2px 0px #c46f08, 0px 3px 5px rgba(0,0,0,0.3);
        }

        .btn-reset {
            grid-column: span 1;
            background: linear-gradient(to bottom, #ff5c4d, #e74c3c);
            color: white;
            font-size: 15px;
            box-shadow: 0px 5px 0px #a9291b, 0px 7px 10px rgba(0,0,0,0.3);
            text-shadow: 0px 1px 2px rgba(0,0,0,0.3);
        }

        .btn-reset:active {
            box-shadow: 0px 2px 0px #a9291b, 0px 3px 5px rgba(0,0,0,0.3);
        }

        .active {
            outline: 2px solid #f7941d;
            background: #ffffff !important;
        }
    </style>
</head>
<body>

<div class="calculator">
    <h3 class="title">Perhitungan Luas Bangun Datar</h3>

    <form method="POST" action="" id="calcForm">
        <div class="screen">
            <div class="process"><?php echo $langkah; ?></div>
            <div class="result"><?php echo $hasil !== '' ? $hasil : '0'; ?></div>
        </div>

        <div class="inputs-group">
            <input type="number" step="any" name="val1" id="val1" value="<?php echo htmlspecialchars($val1); ?>" required>
            <input type="number" step="any" name="val2" id="val2" value="<?php echo htmlspecialchars($val2); ?>">
        </div>

        <input type="hidden" name="bangun" id="selected_bangun" value="<?php echo htmlspecialchars($bangun); ?>">

        <div class="keypad">
            <button type="button" class="btn btn-num" onclick="inputAngka('7')">7</button>
            <button type="button" class="btn btn-num" onclick="inputAngka('8')">8</button>
            <button type="button" class="btn btn-num" onclick="inputAngka('9')">9</button>
            <button type="button" class="btn btn-op <?php echo $bangun=='segitiga'?'active':''; ?>" onclick="selectBangun('segitiga', this)">L. Segitiga</button>

            <button type="button" class="btn btn-num" onclick="inputAngka('4')">4</button>
            <button type="button" class="btn btn-num" onclick="inputAngka('5')">5</button>
            <button type="button" class="btn btn-num" onclick="inputAngka('6')">6</button>
            <button type="button" class="btn btn-op <?php echo $bangun=='lingkaran'?'active':''; ?>" onclick="selectBangun('lingkaran', this)">L. Lingkaran</button>

            <button type="button" class="btn btn-num" onclick="inputAngka('1')">1</button>
            <button type="button" class="btn btn-num" onclick="inputAngka('2')">2</button>
            <button type="button" class="btn btn-num" onclick="inputAngka('3')">3</button>
            <button type="button" class="btn btn-op <?php echo $bangun=='jajargenjang'?'active':''; ?>" onclick="selectBangun('jajargenjang', this)">L. J.Genjang</button>

            <button type="button" class="btn btn-num" onclick="inputAngka('0')">0</button>
            <button type="button" class="btn btn-num" onclick="inputAngka('00')">00</button>
            <button type="button" class="btn btn-num" onclick="inputAngka('.')">.</button>
            <button type="button" class="btn btn-op <?php echo $bangun=='layang'?'active':''; ?>" onclick="selectBangun('layang', this)">L. Layang2</button>

            <button type="button" class="btn btn-reset" onclick="resetCalculator()">C</button>
            <button type="submit" name="hitung" class="btn btn-equal">=</button>
        </div>
    </form>
</div>

<script>
let activeInput = 'val1';

document.getElementById('val1').addEventListener('focus', () => activeInput = 'val1');
document.getElementById('val2').addEventListener('focus', () => activeInput = 'val2');

function inputAngka(nilai) {
    const inputTarget = document.getElementById(activeInput);
    inputTarget.value += nilai;
}

function selectBangun(nama, el) {
    document.getElementById('selected_bangun').value = nama;
    document.querySelectorAll('.btn-op').forEach(btn => btn.classList.remove('active'));
    el.classList.add('active');
}

function resetCalculator() {
    document.getElementById('val1').value = '';
    document.getElementById('val2').value = '';
    document.getElementById('selected_bangun').value = '';
    document.querySelector('.process').innerText = '';
    document.querySelector('.result').innerText = '0';
    document.querySelectorAll('.btn-op').forEach(btn => btn.classList.remove('active'));
}
</script>

</body>
</html>