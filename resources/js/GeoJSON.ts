import { stringify } from "querystring";
import Collection from "./Collection";
import Map from "./Map";
import Region from "./Region";

export default class GeoJSON {
    protected data : any;

    protected conf : Collection

    constructor(item) {
        this.data = item.get('data');
        this.conf = item.get('conf');
    }

    public render(map : Map) {
        return this.data.map(async row => {
            let region = row.get('region');

            let endpoint = 'https://boundary.octopy.id/indonesian/boundaries?' + stringify({
                code: region
            });

            let json = await fetch(endpoint, {
                headers: {
                    'Accept': 'application/json'
                }
            }).then(response => response.json());

            if (json.message !== undefined) {
                console.log(json.message);
            } else {
                let geojson = {
                    type: 'Feature' as const,
                    geometry: json.geometry,
                    properties: json.properties,
                };

                return new Region(geojson, {
                    style: this.conf.get('layer').reverse()
                }, map).addTo(map.leaflet());
            }
        });
    }
}