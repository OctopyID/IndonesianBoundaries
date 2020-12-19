// @ts-ignore
import { GeoJSON, Map } from "leaflet";
import BaseMap from "./BaseMap";
import { stringify } from "querystring";

export default class Region {
    /**
     * @param name
     * @param item
     */
    constructor(private name : string, private item : any) {
        //
    }

    /**
     * @return string
     */
    public getName() : string {
        return this.name;
    }

    /**
     * @param  map : BaseMap
     * @return object
     */
    public async draw(map : BaseMap) : Promise<object> {
        let container = {};

        for (const row of this.item.data) {
            let endpoint = 'https://boundary.octopy.id/indonesian/boundaries?' + stringify({
                code: row.region
            });

            let json = await fetch(endpoint, {
                headers: {
                    'Accept': 'application/json',
                }
            }).then(response => {
                return response.json();
            });

            if (json.message !== undefined) {
                console.log(json.message);
            } else {
                let geojson = {
                    type: 'Feature',
                    geometry: json.geometry,
                    properties: json.properties,
                };

                // @ts-ignore
                container[row.region] = new GeoJSON(geojson, {
                    style: this.getLayerStyle()
                }).addTo(map.getLeafletInstance());
            }
        }

        return container;
    }

    /**
     * @return object
     */
    protected getLayerStyle() : object {
        return this.item.conf.layer;
    }
}