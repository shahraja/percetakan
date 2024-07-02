document.addEventListener('DOMContentLoaded', (event) => {
    const input1 = document.getElementById('jc');
    const input2 = document.getElementById('jc-hasil');
    const ukuran = document.getElementById('ukuran');
    const kertas = document.getElementById('kertas');
    const hp = document.getElementById('hp');

    input1.addEventListener('input', () => {
        input2.innerHTML = input1.value;
    });

    ukuran.addEventListener('input', () => {
        populateKertasOptions();
        updateHargaPerBuah();
        updateUkuranInputs();
    });
    kertas.addEventListener('input', () => {
        updateHargaPerBuah();
    });
});

const ukuranData = {
    A4: {
        width: 21,
        height: 28,
        hp: 4400,
        plano: [61, 92],
        prices: {
            '120': 2000,
            '150': 2300
        }
    },
    A5: {
        width: 14.8,
        height: 21,
        hp: 3600,
        plano: [65, 90],
        prices: {
            '120': 2100,
            '150': 2450
        }
    }
};

const kertasData = [{
        value: '120',
        text: '120 gr'
    },
    {
        value: '150',
        text: '150 gr'
    }
];

document.addEventListener('DOMContentLoaded', () => {
    populateUkuranOptions();
    document.getElementById('ukuran').addEventListener('change', handleUkuranChange);
});

function populateUkuranOptions() {
    const ukuranSelect = document.getElementById('ukuran');
    for (const key in ukuranData) {
        const option = document.createElement('option');
        option.value = key;
        option.text = `${key} (${ukuranData[key].width} x ${ukuranData[key].height} cm)`;
        ukuranSelect.appendChild(option);
    }
}

function populateKertasOptions() {
    const kertasSelect = document.getElementById('kertas');
    kertasSelect.innerHTML = ''; // Clear current options

    kertasData.forEach(item => {
        const option = document.createElement('option');
        option.value = item.value;
        option.text = item.text;
        kertasSelect.appendChild(option);
    });
}

function handleUkuranChange() {
    populateKertasOptions();
}

function updateUkuranInputs() {
    const selectedOption = document.getElementById('ukuran').value;
    const ukAsli = ukuranData[selectedOption].plano;
    const ukWidth = ukuranData[selectedOption].width;
    const ukHeight = ukuranData[selectedOption].height;

    document.getElementById('uk_asli').value = `${ukAsli[0]} x ${ukAsli[1]}`;
    document.getElementById('uk_width').value = ukWidth;
    document.getElementById('uk_height').value = ukHeight;
}

function updateHargaPerBuah() {
    const selectedUkuran = document.getElementById('ukuran').value;
    const selectedKertas = document.getElementById('kertas').value;
    const hp = document.getElementById('hp');

    if (selectedUkuran && selectedKertas) {
        hp.innerHTML = ukuranData[selectedUkuran].prices[selectedKertas];
    } else {
        hp.innerHTML = '';
    }
}

function calculatePrice() {
    const jc = parseFloat(document.getElementById('jc').value);
    const halaman = parseFloat(document.getElementById('halaman').value);
    const selectedUkuran = document.getElementById('ukuran').value;
    const selectedKertas = document.getElementById('kertas').value;
    const laminasi = document.getElementById('laminasi').value;
    const finishing = document.getElementById('finishing').value;

    if (!selectedUkuran || isNaN(jc) || isNaN(halaman)) {
        alert('Please select a valid ukuran and enter a valid jumlah cetak and jumlah halaman.');
        return;
    }

    const {
        width,
        height,
        prices,
        plano,
        hp
    } = ukuranData[selectedUkuran];
    const hargaKertas = prices[selectedKertas];

    const keteren = Math.ceil(halaman / 8);
    const jumlahPagePerPlano = Math.ceil(jc / 2); // Modified calculation
    const jumlahPlano =  jumlahPagePerPlano * keteren;

    let jsc = calculateJSC(width, height, jc);
    let harga = (jumlahPlano * hargaKertas) + jsc * 2;
    let hargaLaminasi = calculateLaminasiCost(width, height, jc, laminasi);
    harga += hargaLaminasi;

    if (finishing === 'steples') {
        harga += jc * 1000;
    } else if (finishing === 'binding') {
        harga += jc * 2000;
    }

    document.getElementById('result').innerText = 'Rp ' + formatCurrency(harga.toFixed(0));

    function formatCurrency(amount) {
        return parseFloat(amount).toLocaleString('id-ID');
    }
}

function calculateJSC(width, height, jc) {
    if (width <= 21 && height <= 28) {
        return 440000;
    } else if (width <= 14.8 && height <= 21) {
        return 360000;
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