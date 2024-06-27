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
    // Existing sizes...
    plano4: {
        width: 39.5,
        height: 54.5,
        hp: 4800,
        plano: [79, 109],
        prices: {
            '120': 2900,
            '150': 3500,
        }
    },
    plano7: {
        width: 36,
        height: 52,
        hp: 3500,
        plano: [72, 104],
        prices: {
            '120': 2500,
            '150': 3000,
        }
    },
    // Add more sizes as necessary
};

const kertasData = [
    { value: '120', text: '120 gr' },
    { value: '150', text: '150 gr' },
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
    updateUkuranInputs(); // Update the input fields
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
    const selectedUkuran = document.getElementById('ukuran').value;
    const selectedKertas = document.getElementById('kertas').value;
    const laminasi = document.getElementById('laminasi').value;
    const jilid = document.getElementById('jilid').value;
    const lembar = parseFloat(document.getElementById('lembar').value);

    if (!selectedUkuran || isNaN(jc) || isNaN(lembar)) {
        alert('Please select a valid ukuran, enter a valid jumlah cetak, and provide jumlah lembar.');
        return;
    }

    const {
        width,
        height,
        prices,
        plano
    } = ukuranData[selectedUkuran];
    const hp = prices[selectedKertas];

    const jumlahPagePerPlano = Math.floor(plano[0] / width) * Math.floor(plano[1] / height);
    let jumlahPlano = Math.ceil(jc / jumlahPagePerPlano);

    // Adjust jumlahPlano based on lembar
    jumlahPlano *= lembar;

    let jsc = calculateJSC(width, height, jc);
    let harga = (jumlahPlano * hp) + jsc;
    let hargaLaminasi = calculateLaminasiCost(width, height, jc, laminasi);

    // Calculate harga jilid
    let hargaJilid = 0;
    if (jilid === 'kaleng') {
        hargaJilid = 1000 * jc;
    } else if (jilid === 'spiral') {
        hargaJilid = 3500 * jc;
    }

    harga += hargaLaminasi + hargaJilid;

    document.getElementById('result').innerText = 'Rp ' + formatCurrency(harga.toFixed(0));

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