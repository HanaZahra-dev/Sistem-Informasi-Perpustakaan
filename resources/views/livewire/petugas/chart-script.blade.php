<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            @foreach ($tanggal_pengembalian as $item)
                "{{$item}}",
            @endforeach
        ],
        datasets: [{
            label: 'Peminjaman Selesai',
            data: [
                @foreach ($count as $item)
                    {{$item}},
                @endforeach
            ],
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            borderColor: '#3b82f6',
            borderWidth: 2.5,
            pointBackgroundColor: '#1d4ed8',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 7,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: '#1e293b',
                titleColor: '#ffffff',
                bodyColor: '#94a3b8',
                padding: 12,
                cornerRadius: 10,
                callbacks: {
                    label: function(context) {
                        return ' ' + context.parsed.y + ' peminjaman';
                    }
                }
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: { family: 'Poppins', size: 11 },
                    color: '#94a3b8'
                },
                border: { display: false }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: '#f1f5f9',
                    drawBorder: false
                },
                ticks: {
                    font: { family: 'Poppins', size: 11 },
                    color: '#94a3b8',
                    stepSize: 10
                },
                border: { display: false }
            }
        }
    }
});

Livewire.on('ubahBulanTahun', (count, tanggal_pengembalian) => {
    myChart.data.labels = tanggal_pengembalian;
    myChart.data.datasets[0].data = count;
    myChart.update();
});
</script>
