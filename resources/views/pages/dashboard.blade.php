@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <!-- Gas Sensor Monitoring -->
        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Gas</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor gas 3 menit terakhir.</p>
                    <div id="monitoringGas"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>
        <div class="col-sm-10 col-md-5">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Gas</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor gas 3 menit terakhir.</p>
                    <div id="gaugeGas"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>

        <!-- DHT11 Sensor Monitoring (Humidity) -->
        <div class="col-sm-10 col-md-4">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Kelembaban (DHT11)</h4>
                    <p class="card-text">Grafik berikut adalah monitoring kelembaban sensor DHT11 3 menit terakhir.</p>
                    <div id="gaugeHumidity"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>

        <!-- DHT11 Sensor Monitoring (Temperature) -->
        <div class="col-sm-10 col-md-4">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Suhu (DHT11)</h4>
                    <p class="card-text">Grafik berikut adalah monitoring suhu sensor DHT11 3 menit terakhir.</p>
                    <div id="gaugeTemperature"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>

        <!-- Rain sensor -->
        <div class="col-sm-10 col-md-4">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Hujan</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor hujan 3 menit terakhir.</p>
                    <div id="gaugeRain"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        Highcharts.setOptions({
            chart: {
                backgroundColor: '#2a2a2b',
                style: {
                    fontFamily: 'Arial, sans-serif'
                },
                plotBorderColor: '#606063'
            },
            title: {
                style: {
                    color: '#E0E0E3',
                    textTransform: 'uppercase',
                    fontSize: '20px'
                }
            },
            subtitle: {
                style: {
                    color: '#E0E0E3',
                    textTransform: 'uppercase'
                }
            },
            xAxis: {
                gridLineColor: '#707073',
                labels: {
                    style: {
                        color: '#E0E0E3'
                    }
                },
                lineColor: '#707073',
                minorGridLineColor: '#505053',
                tickColor: '#707073',
                title: {
                    style: {
                        color: '#A0A0A3'
                    }
                }
            },
            yAxis: {
                gridLineColor: '#707073',
                labels: {
                    style: {
                        color: '#E0E0E3'
                    }
                },
                lineColor: '#707073',
                minorGridLineColor: '#505053',
                tickColor: '#707073',
                tickWidth: 1,
                title: {
                    style: {
                        color: '#A0A0A3'
                    }
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.85)',
                style: {
                    color: '#F0F0F0'
                }
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        color: '#F0F0F3',
                        style: {
                            fontSize: '13px'
                        }
                    },
                    marker: {
                        lineColor: '#333'
                    }
                },
                boxplot: {
                    fillColor: '#505053'
                },
                candlestick: {
                    lineColor: 'white'
                },
                errorbar: {
                    color: 'white'
                }
            },
            legend: {
                backgroundColor: 'rgba(0, 0, 0, 0.5)',
                itemStyle: {
                    color: '#E0E0E3'
                },
                itemHoverStyle: {
                    color: '#FFF'
                },
                itemHiddenStyle: {
                    color: '#606063'
                },
                title: {
                    style: {
                        color: '#C0C0C0'
                    }
                }
            },
            credits: {
                style: {
                    color: '#666'
                }
            },
            labels: {
                style: {
                    color: '#707073'
                }
            },
            drilldown: {
                activeAxisLabelStyle: {
                    color: '#F0F0F3'
                },
                activeDataLabelStyle: {
                    color: '#F0F0F3'
                }
            },
            navigation: {
                buttonOptions: {
                    symbolStroke: '#DDDDDD',
                    theme: {
                        fill: '#505053'
                    }
                }
            },
            // Scroll charts
            rangeSelector: {
                buttonTheme: {
                    fill: '#505053',
                    stroke: '#000000',
                    style: {
                        color: '#CCC'
                    },
                    states: {
                        hover: {
                            fill: '#707073',
                            stroke: '#000000',
                            style: {
                                color: 'white'
                            }
                        },
                        select: {
                            fill: '#000003',
                            stroke: '#000000',
                            style: {
                                color: 'white'
                            }
                        }
                    }
                },
                inputBoxBorderColor: '#505053',
                inputStyle: {
                    backgroundColor: '#333',
                    color: 'silver'
                },
                labelStyle: {
                    color: 'silver'
                }
            },
            navigator: {
                handles: {
                    backgroundColor: '#666',
                    borderColor: '#AAA'
                },
                outlineColor: '#CCC',
                maskFill: 'rgba(255,255,255,0.1)',
                series: {
                    color: '#7798BF',
                    lineColor: '#A6C7ED'
                },
                xAxis: {
                    gridLineColor: '#505053'
                }
            },
            scrollbar: {
                barBackgroundColor: '#808083',
                barBorderColor: '#808083',
                buttonArrowColor: '#CCC',
                buttonBackgroundColor: '#606063',
                buttonBorderColor: '#606063',
                rifleColor: '#FFF',
                trackBackgroundColor: '#404043',
                trackBorderColor: '#404043'
            }
        });

        let chartGas, gaugeGas, gaugeHumidity, gaugeTemperature, gaugeRain;

        async function requestData() {
            const result = await fetch("{{ route('api.sensors.mq.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const date = sensorData[0].created_at;
                const value = sensorData[0].value;

                const point = [new Date(date).getTime(), Number(value)];
                const series = chartGas.series[0],
                    shift = series.data.length > 20;

                chartGas.series[0].addPoint(point, true, shift);
                setTimeout(requestData, 3000);
            }
        }

        async function requestGaugeGas() {
            const result = await fetch("{{ route('api.sensors.mq.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const value = sensorData[0].value;

                if (gaugeGas) {
                    gaugeGas.series[0].setData([Number(value)], true, true, true);
                }

                setTimeout(requestGaugeGas, 3000);
            }
        }

        async function requestGaugeHumidity() {
            const result = await fetch("{{ route('api.sensors.dht11.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const value = sensorData.humidity;

                if (gaugeHumidity) {
                    gaugeHumidity.series[0].setData([Number(value)], true, true, true);
                }

                setTimeout(requestGaugeHumidity, 3000);
            }
        }

        async function requestGaugeTemperature() {
            const result = await fetch("{{ route('api.sensors.dht11.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const value = sensorData.temperature;

                if (gaugeTemperature) {
                    gaugeTemperature.series[0].setData([Number(value)], true, true, true);
                }

                setTimeout(requestGaugeTemperature, 3000);
            }
        }

        async function requestGaugeRain() {
            const result = await fetch("{{ route('api.sensors.rain.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const value = sensorData.value;

                if (gaugeRain) {
                    gaugeRain.series[0].setData([Number(value)], true, true, true);
                }

                setTimeout(requestGaugeRain, 3000);
            }
        }

        window.addEventListener('load', function() {
            chartGas = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringGas',
                    defaultSeriesType: 'spline',
                    events: {
                        load: requestData
                    }
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000,
                    labels: {
                        style: {
                            color: '#E0E0E3'
                        }
                    }
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value',
                        margin: 80,
                        style: {
                            color: '#A0A0A3'
                        }
                    },
                    labels: {
                        style: {
                            color: '#E0E0E3'
                        }
                    }
                },
                series: [{
                    name: 'Gas',
                    data: [],
                    color: '#7798BF'
                }]
            });

            gaugeGas = new Highcharts.Chart({
                chart: {
                    renderTo: 'gaugeGas',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestGaugeGas
                    }
                },
                title: {
                    text: 'Gas'
                },
                pane: {
                    startAngle: -150,
                    endAngle: 150
                },
                yAxis: {
                    min: 0,
                    max: 1023,
                    minorTickInterval: 'auto',
                    minorTickWidth: 1,
                    minorTickLength: 10,
                    minorTickPosition: 'inside',
                    minorTickColor: '#666',
                    tickPixelInterval: 30,
                    tickWidth: 2,
                    tickPosition: 'inside',
                    tickLength: 10,
                    tickColor: '#666',
                    labels: {
                        step: 2,
                        rotation: 'auto',
                        style: {
                            color: '#E0E0E3'
                        }
                    },
                    title: {
                        text: 'Value',
                        style: {
                            color: '#A0A0A3'
                        }
                    },
                    plotBands: [{
                        from: 0,
                        to: 199,
                        color: '#55BF3B' // green
                    }, {
                        from: 200,
                        to: 299,
                        color: '#DDDF0D' // yellow
                    }, {
                        from: 300,
                        to: 1000,
                        color: '#DF5353' // red
                    }]
                },
                series: [{
                    name: 'Value',
                    data: [0],
                    tooltip: {
                        valueSuffix: ''
                    }
                }]
            });

            gaugeHumidity = new Highcharts.Chart({
                chart: {
                    renderTo: 'gaugeHumidity',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestGaugeHumidity
                    }
                },
                title: {
                    text: 'Humidity'
                },
                pane: {
                    startAngle: -150,
                    endAngle: 150
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    minorTickInterval: 'auto',
                    minorTickWidth: 1,
                    minorTickLength: 10,
                    minorTickPosition: 'inside',
                    minorTickColor: '#666',
                    tickPixelInterval: 30,
                    tickWidth: 2,
                    tickPosition: 'inside',
                    tickLength: 10,
                    tickColor: '#666',
                    labels: {
                        step: 2,
                        rotation: 'auto',
                        style: {
                            color: '#E0E0E3'
                        }
                    },
                    title: {
                        text: 'Value',
                        style: {
                            color: '#A0A0A3'
                        }
                    },
                    plotBands: [{
                        from: 0,
                        to: 30,
                        color: '#DF5353' // red
                    }, {
                        from: 30,
                        to: 60,
                        color: '#DDDF0D' // yellow
                    }, {
                        from: 60,
                        to: 100,
                        color: '#55BF3B' // green
                    }]
                },
                series: [{
                    name: 'Value',
                    data: [0],
                    tooltip: {
                        valueSuffix: '%'
                    }
                }]
            });

            gaugeTemperature = new Highcharts.Chart({
                chart: {
                    renderTo: 'gaugeTemperature',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestGaugeTemperature
                    }
                },
                title: {
                    text: 'Temperature'
                },
                pane: {
                    startAngle: -150,
                    endAngle: 150
                },
                yAxis: {
                    min: 0,
                    max: 50,
                    minorTickInterval: 'auto',
                    minorTickWidth: 1,
                    minorTickLength: 10,
                    minorTickPosition: 'inside',
                    minorTickColor: '#666',
                    tickPixelInterval: 30,
                    tickWidth: 2,
                    tickPosition: 'inside',
                    tickLength: 10,
                    tickColor: '#666',
                    labels: {
                        step: 2,
                        rotation: 'auto',
                        style: {
                            color: '#E0E0E3'
                        }
                    },
                    title: {
                        text: 'Value',
                        style: {
                            color: '#A0A0A3'
                        }
                    },
                    plotBands: [{
                        from: 0,
                        to: 15,
                        color: '#DF5353' // red
                    }, {
                        from: 15,
                        to: 30,
                        color: '#DDDF0D' // yellow
                    }, {
                        from: 30,
                        to: 50,
                        color: '#55BF3B' // green
                    }]
                },
                series: [{
                    name: 'Value',
                    data: [0],
                    tooltip: {
                        valueSuffix: '°C'
                    }
                }]
            });

            gaugeRain = new Highcharts.Chart({
                chart: {
                    renderTo: 'gaugeRain',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestGaugeRain
                    }
                },
                title: {
                    text: 'Rain'
                },
                pane: {
                    startAngle: -150,
                    endAngle: 150
                },
                yAxis: {
                    min: 0,
                    max: 1023,
                    minorTickInterval: 'auto',
                    minorTickWidth: 1,
                    minorTickLength: 10,
                    minorTickPosition: 'inside',
                    minorTickColor: '#666',
                    tickPixelInterval: 30,
                    tickWidth: 2,
                    tickPosition: 'inside',
                    tickLength: 10,
                    tickColor: '#666',
                    labels: {
                        step: 2,
                        rotation: 'auto',
                        style: {
                            color: '#E0E0E3'
                        }
                    },
                    title: {
                        text: 'Value',
                        style: {
                            color: '#A0A0A3'
                        }
                    },
                    plotBands: [{
                        from: 0,
                        to: 500,
                        color: '#55BF3B' // green
                    }, {
                        from: 500,
                        to: 800,
                        color: '#DDDF0D' // yellow
                    }, {
                        from: 800,
                        to: 1023,
                        color: '#DF5353' // red
                    }]
                },
                series: [{
                    name: 'Value',
                    data: [0],
                    tooltip: {
                        valueSuffix: ''
                    }
                }]
            });
        });
    </script>
@endpush

