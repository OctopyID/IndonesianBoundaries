import { GeoJSON } from "leaflet";
import Map from "./Map";

export default class Region extends GeoJSON<any> {
    public parent : Map;

    constructor(data, options, map : Map) {
        super(data, options);
        this.parent = map;
    }

    public regionCode() {
        return this.getProperties().code;
    }

    public regionName() {
        return this.getProperties().name;
    }

    public getProperties(id : number = null) {
        return this.getFeature(id).properties;
    }

    public getFeature(id : number = null) {
        return this.getLayer(id).feature;
    }

    public getLayer(id : number = null) : any {
        if (id) {
            return super.getLayer(id);
        }

        return super.getLayers()[0];
    }
}