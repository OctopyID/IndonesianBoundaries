export default new (class BoundaryConfig {
    constructor(config) {
        this.config = config;
    }

    isRenderType(type) {
        return this.getRenderType() === type;
    }

    isMarkerActive() {
        return this.getMarker().iconUrl !== null || this.getMarker().iconUrl !== false;
    }

    isLabelActive() {
        return this.getMarker().withLabel;
    }

    withBackgroundLayer() {
        return this.config.layer.background;
    }

    getInitialConfig() {
        return {
            center: this.getCenter(),
            zoom: this.getZoom().zoom,
            zoomControl: this.getZoom().zoomControl,
            scrollWheelZoom: this.getZoom().scrollWheelZoom,
        };
    }

    getZoom() {
        return this.config.zoom;
    }

    getCenter() {
        return [
            this.config.render.center.lat,
            this.config.render.center.lng,
        ];
    }

    getMarker() {
        return this.config.marker;
    }

    getLayerStyle() {
        return this.config.layer.style;
    }

    getMouseEvent() {
        return this.config.layer.event;
    }

    getRenderType() {
        return this.config.render.type;
    }

    getRenderData() {
        return this.config.render.data;
    }

    getRootElement() {
        return this.config.element;
    }

})(boundaryConfig);