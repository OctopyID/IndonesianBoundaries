import L from 'leaflet';
import query from 'querystring';
import config from './config';

window.boundary = new class Boundary {

    /**
     * @returns {Boundary}
     */
    render() {

        this.map = L.map(config.getRootElement(), config.getInitialConfig());

        if (config.withBackgroundLayer()) {
            this.backgroundLayer();
        }

        return this;
    }

    backgroundLayer() {
        new L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
            attribution: '<a href="https://bit.ly/IndonesianBoundaries">Octopy ID</a> | <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(this.map);
    }


    fetch(data) {
        let self = this;

        fetch('/indonesia/boundaries?' + query.stringify(data), {
            headers: {
                'Accept': 'application/json'
            },
        })
            .then(response => response.json())
            .then(json => {

                Object.entries(json).forEach(([index, row]) => {
                    let geoJSON = {
                        type: 'Feature',
                        geometry: row.geometry,
                        properties: row.properties,
                    };

                    window.geoJsonLayer = L.geoJSON(geoJSON, {
                        style: config.getLayerStyle(),
                        onEachFeature: function (feature, layer) {

                            layer.on(config.getMouseEvent());

                            if (config.isMarkerActive()) {
                                let marker = L.marker([row.geometry.center.lat, row.geometry.center.lng], {
                                    icon: new L.Icon(config.getMarker())
                                }).addTo(self.map);

                                if (config.isLabelActive()) {
                                    marker.bindPopup(feature.properties.name);
                                }
                            }
                        }
                    }).addTo(self.map);
                })
            });
    }

    all() {
        Object.entries(config.getRenderData()).forEach(([type, items]) => {
            if (config.isRenderType('part')) {
                Object.entries(items).forEach(([index, item]) => {
                    this.fetch({
                        type: type,
                        render: item
                    });
                })
            } else if (config.isRenderType('once')) {
                if (items.length !== 0) {
                    this.fetch({
                        type: type,
                        render: items.join(',')
                    });
                }
            } else {
                console.log('Invalid Render Type.');
            }
        });
    }

    province() {
        if (config.isRenderType('part')) {
            Object.entries(config.getRenderData().province).forEach(([index, item]) => {
                this.fetch({
                    type: 'province',
                    render: item
                });
            })
        } else if (config.isRenderType('once')) {
            if (items.length !== 0) {
                this.fetch({
                    type: 'province',
                    render: config.getRenderData().province.join(',')
                });
            }
        } else {
            console.log('Invalid Render Type.');
        }
    }

    city() {
        if (config.isRenderType('part')) {
            Object.entries(config.getRenderData().city).forEach(([index, item]) => {
                this.fetch({
                    type: 'city',
                    render: item
                });
            })
        } else if (config.isRenderType('once')) {
            if (items.length !== 0) {
                this.fetch({
                    type: 'city',
                    render: config.getRenderData().city.join(',')
                });
            }
        } else {
            console.log('Invalid Render Type.');
        }
    }

};

function highlightFeature(e) {
    style(e);
    e.target.setStyle({
        weight: 1.5,
        color: 'black',
        fillOpacity: 1
    });
}

function resetHighlight(e) {
    geoJsonLayer.setStyle({
        weight: 1.5,
        color: 'black',
        fillOpacity: 1
    });
}