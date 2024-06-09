@extends('layouts.client.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="container">
        <h1 class="my-5">{{ $product->judul }}</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="container d-flex justify-content-end">
                    <img src="{{ asset('assets/img/' . $product->gambar) }}" class="img img-fluid rounded"
                        style="object-fit: cover" width="500" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <p>{{ $product->deskripsi }}</p>
            </div>
            <form class="row pb-3">
                <h4 class="py-2">Hitung Harga Cetak Online</h4>
                <div class="col border rounded shadow p-4 mx-2">
                    <div class="form-group row pe-2">
                        <label class="form-label col-md-3" for="jc">Jumlah</label>
                        <input class="form-control col-md-9" name="jc" id="jc" type="text" required>
                    </div>
                    <div class="form-group row pe-2">
                        <label class="form-label col-md-3" for="ukuran">Ukuran</label>
                        <select name="ukuran" id="ukuran" class="form-select col-md-9">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group row pe-2">
                        <label class="form-label col-md-3" for="kertas">Kertas</label>
                        <select name="kertas" id="kertas" class="form-select col-md-9">
                            <!-- Options will be populated by JavaScript -->
                        </select>
                    </div>
                    <div class="form-group row pe-2">
                        <label class="form-label col-md-3" for="laminasi">Laminasi</label>
                        <select name="laminasi" id="laminasi" class="form-select col-md-9">
                            <option value=""></option>
                            <option value="glossy1">Glossy</option>
                            <option value="glossy2">Glossy Bolak-Balik</option>
                            <option value="doff1">Doff</option>
                            <option value="doff2">Doff Bolak-Balik</option>
                        </select>
                    </div>
                    <div class="text-center my-3">
                        <button class="btn btn-primary bg-utama col-md-6" type="button" onclick="calculatePrice()">Cek
                            Harga</button>
                    </div>
                </div>
                <div class="col border rounded shadow p-4 mx-2">
                    <table class="table">

                        <tbody>
                            <tr>
                                <td><strong>Harga Per buah</strong></td>
                                <td>: </td>
                                <td align="right" id="hp">

                                </td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah Pesan</strong></td>
                                <td>: </td>
                                <td align="right" id="jc-hasil">

                                </td>
                            </tr>
                            <tr>
                                <td><strong>Harga Total</strong></td>
                                <td>: </td>
                                <td align="right" id="result">

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const input1 = document.getElementById('jc');
            const input2 = document.getElementById('jc-hasil');
            const ukuran = document.getElementById('ukuran');
            const hp = document.getElementById('hp');

            input1.addEventListener('input', () => {
                input2.innerHTML = input1.value;
            });
            ukuran.addEventListener('input', () => {
                hp.innerHTML = ukuranData[ukuran.value].hp;
            })
        });


        const ukuranData = {
            plano1: {
                width: 30.5,
                height: 46,
                hp: 3200,
                plano: [61, 92]
            },
            plano2: {
                width: 32.5,
                height: 45,
                hp: 3400,
                plano: [65, 90]
            },
            plano3: {
                width: 32.5,
                height: 50,
                hp: 3700,
                plano: [65, 100]
            },
            plano4: {
                width: 39.5,
                height: 54.5,
                hp: 4800,
                plano: [79, 109]
            },
            plano5: {
                width: 36,
                height: 39,
                hp: 4800,
                plano: [79, 109]
            },
            plano6: {
                width: 35,
                height: 44,
                hp: 4800,
                plano: [79, 109]
            }
        };

        const kertasData = [{
                value: '120',
                text: '120 gr'
            },
            {
                value: '150',
                text: '150 gr'
            },
            {
                value: '190',
                text: '190 gr'
            },
            {
                value: '210',
                text: '210 gr'
            },
            {
                value: '230',
                text: '230 gr'
            },
            {
                value: '260',
                text: '260 gr'
            },
            {
                value: '310',
                text: '310 gr'
            },
            {
                value: '400',
                text: '400 gr'
            }
        ];

        const ukuranRestrictions = {
            plano1: ['260', '310', '400'],
            plano2: ['400'],
            plano3: ['400'],
            plano4: [],
            plano5: [],
            plano6: []
        };

        document.addEventListener('DOMContentLoaded', () => {
            populateUkuranOptions();
            document.getElementById('ukuran').addEventListener('change', handleUkuranChange);
        });

        function populateUkuranOptions() {
            const ukuranSelect = document.getElementById('ukuran');
            for (const key in ukuranData) {
                const option = document.createElement('option');
                option.value = key;
                option.text = `${ukuranData[key].width} x ${ukuranData[key].height}`;
                ukuranSelect.appendChild(option);
            }
        }

        function populateKertasOptions(restrictedValues = []) {
            const kertasSelect = document.getElementById('kertas');
            kertasSelect.innerHTML = ''; // Clear current options

            kertasData.forEach(item => {
                if (!restrictedValues.includes(item.value)) {
                    const option = document.createElement('option');
                    option.value = item.value;
                    option.text = item.text;
                    kertasSelect.appendChild(option);
                }
            });
        }

        function handleUkuranChange() {
            const selectedOption = document.getElementById('ukuran').value;
            const restrictedValues = ukuranRestrictions[selectedOption] || [];
            populateKertasOptions(restrictedValues);
        }

        function calculatePrice() {
            const jc = parseFloat(document.getElementById('jc').value);
            const selectedUkuran = document.getElementById('ukuran').value;
            const laminasi = document.getElementById('laminasi').value;

            if (!selectedUkuran || isNaN(jc)) {
                alert('Please select a valid ukuran and enter a valid jumlah cetak.');
                return;
            }

            const {
                width,
                height,
                hp,
                plano
            } = ukuranData[selectedUkuran];

            const jumlahPagePerPlano = Math.floor(plano[0] / width) * Math.floor(plano[1] / height);
            const jumlahPlano = Math.ceil(jc / jumlahPagePerPlano);

            let jsc = calculateJSC(width, height, jc);
            let harga = (jumlahPlano * hp) + jsc;
            let hargaLaminasi = calculateLaminasiCost(width, height, jc, laminasi);

            harga += hargaLaminasi;

            document.getElementById('result').innerText = 'Rp ' + formatCurrency(harga.toFixed(2));

            function formatCurrency(amount) {
                return parseFloat(amount).toLocaleString('id-ID');
            }
        }

        function calculateJSC(width, height, jc) {
            if (width <= 37 && height <= 52 && jc <= 2500) {
                return 360000;
            } else if ((width > 37 || height > 52) && jc <= 2500) {
                return 440000;
            } else {
                return 0;
            }
        }

        function calculateLaminasiCost(width, height, jc, laminasi) {
            const area = width * height;
            switch (laminasi) {
                case 'glossy1':
                    return area * 0.19 * jc;
                case 'glossy2':
                    return area * 0.19 * jc * 2;
                case 'doff1':
                    return area * 0.20 * jc;
                case 'doff2':
                    return area * 0.20 * jc * 2;
                default:
                    return 0;
            }
        }
    </script>
@endsection
