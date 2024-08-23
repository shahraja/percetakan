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

// const ukuranData = {
//     plano1: {
//         width: 30.5,
//         height: 46,
//         hp: 3200,
//         plano: [61, 92],
//         prices: {
//             '120': 2000,
//             '150': 2300,
//             '190': 2950,
//             '210': 3200,
//             '230': 3500,
//         }
//     },
//     plano2: {
//         width: 32.5,
//         height: 45,
//         hp: 3400,
//         plano: [65, 90],
//         prices: {
//             '120': 2100,
//             '150': 2450,
//             '190': 3050,
//             '210': 3400,
//             '230': 3600,
//             '260': 4050,
//             '310': 4800,
//         }
//     },
//     plano3: {
//         width: 32.5,
//         height: 50,
//         hp: 3700,
//         plano: [65, 100],
//         prices: {
//             '120': 2250,
//             '150': 2700,
//             '190': 3400,
//             '210': 3700,
//             '230': 4000,
//             '260': 4500,
//             '310': 5200,
//         }
//     },
//     plano4: {
//         width: 39.5,
//         height: 54.5,
//         hp: 4800,
//         plano: [79, 109],
//         prices: {
//             '120': 2900,
//             '150': 3500,
//             '190': 4400,
//             '210': 4800,
//             '230': 5200,
//             '260': 5800,
//             '310': 7000,
//             '400': 8800,
//         }
//     },
//     plano5: {
//         width: 36,
//         height: 39,
//         hp: 4800,
//         plano: [79, 109],
//         prices: {
//             '120': 2900,
//             '150': 3500,
//             '190': 4400,
//             '210': 4800,
//             '230': 5200,
//             '260': 5800,
//             '310': 7000,
//             '400': 8800,
//         }
//     },
//     plano6: {
//         width: 35,
//         height: 44,
//         hp: 4800,
//         plano: [79, 109],
//         prices: {
//             '120': 2900,
//             '150': 3500,
//             '190': 4400,
//             '210': 4800,
//             '230': 5200,
//             '260': 5800,
//             '310': 7000,
//             '400': 8800,
//         }
//     }
// };
const ukuranDataElement = document.getElementById('ukuranData');
const ukuranData = JSON.parse(ukuranDataElement.getAttribute('data-ukuran'));

console.log(ukuranData);

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
    updateUkuranInputs(); // Update the input fields
}

// function updateUkuranInputs() {
//     const selectedOption = document.getElementById('ukuran').value;
//     const ukAsli = ukuranData[selectedOption].plano;
//     const ukWidth = ukuranData[selectedOption].width;
//     const ukHeight = ukuranData[selectedOption].height;

//     document.getElementById('uk_asli').value = `${ukAsli[0]} x ${ukAsli[1]}`;
//     document.getElementById('uk_width').value = ukWidth;
//     document.getElementById('uk_height').value = ukHeight;
// }
function updateUkuranInputs() {
    const selectedOption = document.getElementById('ukuran').value;
    
    if (selectedOption && ukuranData[selectedOption]) {
        const ukAsli = ukuranData[selectedOption].plano || [];
        const ukWidth = ukuranData[selectedOption].width;
        const ukHeight = ukuranData[selectedOption].height;

        // Pastikan ukAsli memiliki setidaknya 2 elemen sebelum diakses
        document.getElementById('uk_asli').value = ukAsli.length >= 2 ? `${ukAsli[0]} x ${ukAsli[1]}` : 'Ukuran tidak tersedia';
        document.getElementById('uk_width').value = ukWidth;
        document.getElementById('uk_height').value = ukHeight;
    } else {
        // Handle kasus di mana selectedOption tidak valid
        console.error('Ukuran tidak valid atau tidak ditemukan.');
    }
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

    if (!selectedUkuran || isNaN(jc)) {
        alert('Please select a valid ukuran and enter a valid jumlah cetak.');
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
    const jumlahPlano = Math.ceil(jc / jumlahPagePerPlano);

    let jsc = calculateJSC(width, height, jc);
    let harga = (jumlahPlano * hp) + jsc;
    let hargaLaminasi = calculateLaminasiCost(width, height, jc, laminasi);

    harga += hargaLaminasi;

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