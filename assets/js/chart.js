const ctx = document.getElementById('dashboardChart');

if(ctx){

new Chart(ctx,{

type:'bar',

data:{

labels:[
'Pasien',
'Dokter',
'Obat',
'Pembayaran'
],

datasets:[{

label:'Jumlah Data',

data:[

pasien,

dokter,

obat,

pembayaran

],

borderRadius:12,

backgroundColor:[

'#2563eb',

'#16a34a',

'#f59e0b',

'#dc2626'

]

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:false

}

},

scales:{

y:{

beginAtZero:true

}

}

}

});

}