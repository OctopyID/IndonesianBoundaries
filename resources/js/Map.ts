import { Map as LeafletMap } from 'leaflet';
import "reflect-metadata";
import { container } from "tsyringe";
import Collection from "./Collection";
import Config from "./Config";
import GeoJSON from "./GeoJSON";
import TileLayer from "./TileLayer";

export default class Map {

    protected conf : Config;

    protected regions : Collection;

    protected instance : LeafletMap;

    constructor(config : Config) {
        this.conf = config;
    }

    public render() {
        this.instance = new LeafletMap(
            this.conf.getRootElement(), this.conf.getMapOptions()
        );

        if (this.tileLayer().enabled()) {
            this.tileLayer().render();
        }

        this.regions = this.assignMapRegion().map((region : GeoJSON) => {
            return region.render(this);
        });

        return this;
    }

    public prov() {
        return this.region().get('prov');
    }

    public region() {
        return this.regions;
    }

    public leaflet() : LeafletMap {
        return this.instance;
    }

    public tileLayer() {
        container.register('map', {
            useValue: this
        });

        return container.resolve(TileLayer);
    }

    public config(key : string | null = null, value : any = null) {
        return this.conf.config(key, value);
    }

    public hasElement(root : string) : boolean {
        return this.conf.getRootElement() === root;
    }

    private assignMapRegion() {
        return this.config('data').map(item => {
            return new GeoJSON(item);
        });
    }
}