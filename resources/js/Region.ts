// @ts-ignore
import { GeoJSON } from "leaflet";
import BaseMap from "./BaseMap";
import { stringify } from "querystring";

export default class Region {
    /**
     * @param name
     * @param item
     */
    constructor(private name : string, private item : any) {
    }

    /**
     * @protected
     */
    protected getLayerStyle() : object {
        return this.item.conf.layer;
    }

    draw(map : BaseMap) {
        fetch('/indonesia/boundaries?' + stringify({
            type: this.name,
            data: Object.values(this.item.data).map(row => {
                // @ts-ignore
                return row.region;
            }).join(',')
        })).then(r => r.json()).then(json => {
            // @ts-ignore
            Object.entries(json).forEach(([index, {properties, geometry}]) => {
                let geojson = {
                    type: 'Feature', geometry, properties
                };

                // @ts-ignore
                new GeoJSON(geojson, {
                    style: this.getLayerStyle()
                }).addTo(map.getLeafletInstance());
            });
        });
    }
}